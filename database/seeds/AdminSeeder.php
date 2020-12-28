<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin1 = new Admin();
        $admin1->profile_id = 1;
        $admin1->save();

        $admin1->categories()->attach(1);
        $admin1->categories()->attach(2);

        factory(App\Admin::class, 3)->create();
        
        //assigns each admin between 1-3 categories
        foreach(App\Admin::all() as $admin)
        {
            $categories = App\Category::inRandomOrder()->take(rand(1,3))->pluck('id');
            $admin->categories()->sync($categories);
        }
    }
}
