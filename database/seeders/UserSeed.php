<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
            $nit = $faker->ean13();
            DB::table('people')->insert([
                'name'=> "admin",
                'last_name'=>$faker->lastName(),
                'nit'=>$nit,
                'date_of_birth'=>$faker->date($format = 'Y-m-d', $max = 'now')
            ]);

            $person= DB::table('people')->where('nit',$nit)->value('id');
            DB::table('emails')->insert([
                'email'=>"admin@admin.con",
                'is_primary'=>true,
                'person_id'=>$person
            ]);

            DB::table('users')->insert([
                'username'=>"admin",
                'password'=>bcrypt('password'),
                'person_id'=>$person
            ]);
            $rol = 1;
            var_dump($rol);
            DB::table('user_roles')->insert([
                'user_id'=>$person,
                'rol_id'=>$rol
            ]);
        for ($i =0;$i < 3; $i++)
        {

            $nit = $faker->ean13();
            DB::table('people')->insert([
                'name'=> $faker->firstName(),
                'last_name'=>$faker->lastName(),
                'nit'=>$nit,
                'date_of_birth'=>$faker->date($format = 'Y-m-d', $max = 'now')
            ]);

            $person= DB::table('people')->where('nit',$nit)->value('id');
            DB::table('emails')->insert([
                'email'=>$faker->safeEmail(),
                'is_primary'=>true,
                'person_id'=>$person
            ]);

            DB::table('users')->insert([
                'username'=>$faker->userName(),
                'password'=>bcrypt('password'),
                'person_id'=>$person
            ]);
            $rol = $i+1;
            var_dump($rol);
            DB::table('user_roles')->insert([
                'user_id'=>$person,
                'rol_id'=>$rol
            ]);
        }


    }
}
