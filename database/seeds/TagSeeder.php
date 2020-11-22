<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag1 = new Tag();
        $tag1->name="weird";
        $tag1->save();

        $tag2 = new Tag();
        $tag2->name="wholesome";
        $tag2->save();

    }
}
