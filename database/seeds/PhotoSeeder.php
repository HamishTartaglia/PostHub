<?php

use Illuminate\Database\Seeder;
use App\Photo;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photo = new Photo();
        $photo->filename = "public/images/iKBz47GxkvOIwd1F6b2ZcuRGDq5UZmHIL0gNzzII.jpeg";
        $photo->photoable_type = App\Post::class;
        $photo->photoable_id = 1;
        $photo->save();

        factory(App\Photo::class, 10)->create();
    }
}
