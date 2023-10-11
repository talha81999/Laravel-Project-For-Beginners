<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\tbl_UserModel;
use Faker\Factory as Faker;

class tbl_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user = new tbl_UserModel();
        $user->user_name = $faker->name;
        $user->user_email = $faker->email;
        $user->user_phone = $faker->phoneNumber;
        $user->user_gender = "M";
        $user->user_address = $faker->address;
        $user->user_dob = $faker->date;
        $user->user_password = $faker->password;
        $user->user_temporary_password = "123";
        $user->user_type = "1";
        $user->user_role = "teamlead";
        $user->user_team = "PHP";
        $user->user_status = "1";
        $user->user_joining_date = $faker->date;
        $user->user_created_by = "0";
        $user->user_updated_by = "0";
        // $user->user_created_at = $faker->date;
        // $user->user_updated_at = $faker->date;
        $user->save();

    }
}
