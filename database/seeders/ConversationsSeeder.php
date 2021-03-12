<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConversationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Conversation::factory(5)->create();
        Reply::factory(15)->create();
    }
}
