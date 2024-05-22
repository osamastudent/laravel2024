<?php

namespace Database\Seeders;

use App\Models\post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class postSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();

      for($i=1; $i<5; $i++){
        $obj=new post();
        $obj->post_category_id=$faker->numberBetween(2,4);
        $obj->user_id=31;
        $obj->post_name=$faker->name;
        $obj->post_desc=$faker->paragraph();
        $obj->post_image=$faker->imageUrl();

    }
        

    }
}


// $obj->post_category_id=31;
//         $obj->image=$faker->imageUrl();
//         $obj->mime_type=$faker->mimeType();
//         $obj->size=$faker->numberBetween(1000,10000);

