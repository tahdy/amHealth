<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = User::class;

    public function definition()
    {
        $name=$this->faker->unique()->numberBetween($min = 100, $max = 9000);
        $gender = $this->faker->randomElement(['male', 'female']);
        $date_of_birth=$this->faker->dateTimeBetween($startDate = '-54 years', $endDate = '-24 years', $timezone = null)->format('Y-m-d');
        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'fullname' =>$this->faker->name($gender) ,
            'fathername' =>$this->faker->lastName,
            'gender' =>$gender,
            'religion'=> $this->faker->randomElement($array = array ('Muslim','Christian')),
            'image' =>'/images/users/1661826738.jpeg',
            'role' =>$this->faker->randomElement($array = array ('visitor','doctor','patient')),
            'ss_id' =>Str::random(7),
            'date_of_birth'=> $date_of_birth,
            'address' =>$this->faker->address,
            'age' =>floor((time() - strtotime($date_of_birth)) / 32556926),
            'phone' =>$this->faker->phoneNumber,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
