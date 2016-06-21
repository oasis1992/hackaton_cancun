<?php

namespace App\Http\Controllers;

use App\FackerModel;
use Faker\Factory;
use Illuminate\Http\Request;

use App\Http\Requests;

class FakerController extends Controller
{
    public function faker(){
        
        //$faker = Faker\Factory::create();
        $faker = Factory::create();

        $limit = 20000;
        $min=1;
        $max=20000;

        $age_min = 10;
        $age_max = 14;

        $sex_min = 0;
        $sex_max = 1;

        $test_min = 1;
        $test_max  = 10;

        $num = 942;
        for ($i = 0; $i < $limit; $i++) {

            $longitude = (double) -2.708077;
            $latitude = (double) 53.754842;
            $radius = 20; // in miles

            $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
            $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
            $lat_min = $latitude - ($radius / 69);
            $lat_max = $latitude + ($radius / 69);

            $latitude = $lng_min . '/' . $lng_max . PHP_EOL;
            $longitude = $lat_min . '/' . $lat_max;

            $id_random = rand($min,$max);

            $object = new FackerModel();
            $object->name_school = $faker->name;
            $object->latitude = $latitude;
            $object->longitude = $longitude;

            $object->id_parent = $num;
            $object->name_parent = $faker->name;
            $object->id_school_parent = $id_random;

            $object->id_kid = $num;
            $object->id_kid_parent = $num;
            $object->name_kid = $faker->name;
            $object->age = rand($age_min, $age_max);
            if(rand($sex_min, $sex_max) == 1){
                $object->sex = "mujer";
            }else{
                $object->sex = "hombre";
            }

            $object->id_behavior = $num;
            $object->id_behavior_kid = $num;
            $object->result = rand($test_min, $test_max);
            $object->save();

            $num = $num + 1;
        }

        return "Termino";
    }
}
