<?php

namespace App\Policies;

use App\Note;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{

    use HandlesAuthorization;

    public function delete(User $user, Note $note)
    {
        return $user->id == $note->user_id;
    }

    public function update(User $user, Note $note)
    {
        return $user->id == $note->user_id;
    }

    public function create(User $user)
    {
        return true;
    }
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Note $contact)
    {
        return $user->id == $contact->user_id;
    }
}
