<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
        Group::create(['name' => 'Alpha Solutions Group']);
    }
}
