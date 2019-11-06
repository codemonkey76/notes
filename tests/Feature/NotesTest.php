<?php

namespace Tests\Feature;

use App\Note;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class NotesTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
        $this->user = factory('App\User')->create();
    }

    /** @test */
    public function an_unauthenticated_user_should_be_redirected_to_login()
    {
        $this->withExceptionHandling();
        $this->post('/api/notes', $this->validData())
            ->assertRedirect('/login');
        $this->assertCount(0, Note::all());
    }

    /** @test */
    function a_list_of_notes_can_be_fetched_for_the_authenticated_user()
    {
        $user        = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $this->actingAs($anotherUser, 'api');
        $anotherNote = factory(Note::class)->create(['user_id' => $anotherUser->id]);

        $this->actingAs($user, 'api');
        $note = factory(Note::class)->create(['user_id' => $user->id]);


        $this->get('/api/notes')
            ->assertJsonCount(1)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'note_id' => $note->id
                        ]
                    ]
                ]
            ]);
    }

    private function checkData(Note $note, $data): void
    {
        $this->assertNotNull($note);
        $this->assertEquals($data['company'], $note->company);
        $this->assertEquals($data['contact'], $note->contact);
        $this->assertEquals($data['issue'], $note->issue);
        $this->assertEquals($data['details'], $note->details);
        $this->assertEquals($data['time'], $note->time);
        $this->assertEquals($data['status'], $note->status);
    }

    /** @test */
    public function an_authenticated_user_can_add_a_note()
    {
        $data = $this->validData();
        $this->actingAs($this->user, 'api');
        $response = $this->post('/api/notes', $data);

        $note = Note::first();

        $this->checkData($note, $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'data'  => [
                    'note_id' => $note->id
                ],
                'links' => [
                    'self' => $note->path()
                ]
            ]);
    }

    /** @test */
    function fields_are_required_on_create()
    {
        $this->withExceptionHandling();
        $this->actingAs($this->user, 'api');
        collect(['company', 'issue'])
            ->each(function ($field) {
                $this->post('/api/notes', array_merge($this->validData(), [$field => '']))
                    ->assertSessionHasErrors($field);
                $this->assertCount(0, Note::all());
            });
    }

    /** @test */
    function fields_are_required_on_update()
    {
        $this->withExceptionHandling();
        $this->actingAs($this->user, 'api');
        $this->post('/api/notes', $this->validData());
        $note = Note::first();

        collect(['company', 'issue'])
            ->each(function ($field) use ($note) {
                $this->patch('/api/notes/' . $note->id, array_merge($this->validData(), [$field => '']))
                    ->assertSessionHasErrors($field);
                $this->assertNotEquals('', $note[$field]);
            });
    }

    /** @test */
    function an_authorized_user_can_update_a_note()
    {
        $note = factory(Note::class)->create(['user_id' => $this->user->id]);
        $data = $this->validData();

        $this->actingAs($this->user, 'api');
        $this->patch('/api/notes/' . $note->id, $data);

        $note->refresh();

        $this->checkData($note, $data);
    }

    /** @test */
    function an_authorized_user_can_retrieve_a_note()
    {
        $note = factory(Note::class)->create(['user_id' => $this->user->id]);

        $this->actingAs($this->user, 'api');
        $this->get('/api/notes/' . $note->id)
            ->assertJson([
                'data' => [
                    'note_id' => $note->id,
                    'company' => $note->company,
                    'contact' => $note->contact,
                    'issue'   => $note->issue,
                    'details' => $note->details,
                    'time'    => $note->time . ' minutes',
                    'created' => $note->created_at->diffForHumans()
                ]
            ]);
    }

    /** @test * */
    public function an_authorized_user_can_delete_a_note()
    {
        $note = factory(Note::class)->create(['user_id' => $this->user->id]);
        $this->actingAs($this->user, 'api');

        $this->delete('/api/notes/' . $note->id)
            ->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertCount(0, Note::all());
    }

    /** @test **/
    public function a_user_cannot_delete_another_users_note()
    {
        $this->withExceptionHandling();

        $anotherUser = factory(User::class)->create();
        $note = factory(Note::class)->create(['user_id' => $anotherUser->id]);

        $this->actingAs($this->user, 'api');

        $this->delete('/api/notes/' . $note->id)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    private function validData()
    {
        return [
            'company' => $this->faker->company,
            'contact' => $this->faker->name,
            'issue'   => $this->faker->words(4, true),
            'details' => $this->faker->paragraph,
            'time'    => $this->faker->numberBetween(1, 120),
            'status'  => 1
        ];
    }
}
