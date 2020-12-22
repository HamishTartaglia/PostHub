<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat1 = new Category();
        $cat1->name = "Animals";
        $cat1->save();

        $cat2 = new Category();
        $cat2->name = "Funny";
        $cat2->save();

        $cat3 = new Category();
        $cat3->name = "Gaming";
        $cat3->save();

        $cat4 = new Category();
        $cat4->name = "AskAnything";
        $cat4->save();

        $cat5 = new Category();
        $cat5->name = "Misc";
        $cat5->save();
    }
}
