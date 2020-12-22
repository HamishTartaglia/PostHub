<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prof1 = new Profile();
        $prof1->username = "username";
        $prof1->bio = "Check out my profile!";
        $prof1->user_id=1;
        $prof1->save();
        
        factory(App\Profile::class, 5)->create();
    }
}
