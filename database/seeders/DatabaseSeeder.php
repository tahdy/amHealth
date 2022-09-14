<?php

namespace Database\Seeders;


use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //\App\Models\User::factory()->count(100)->create();
        //factory(App\Models\User::class, 50)->create();
        $users=User::factory()
            ->count(100)
            ->create();
        foreach( $users as $user)
        {
            if ($user->role=='doctor'){
                Doctor::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
            if ($user->role=='patient'){
                Patient::factory()->create([
                    'user_id' => $user->id,
                ]);
            }


        }
    }
}
