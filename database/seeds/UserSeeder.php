<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Kaspar Martin Suursalu',
            'email' => 'kasparsu@gmail.com',
            'password' => bcrypt("pass1234")]
        );
        factory(App\User::class, 10)->create();
    }
}
