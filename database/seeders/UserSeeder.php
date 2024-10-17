<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Provider\ar_EG\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CREATE user utama
        $arib = User::create([
            'password' => bcrypt('12345678'),
            'nama_lengkap' => 'Arib Fauzan',
            'foto' => "Arr.jpg",
            'no_hp' => 'arr',
            'alamat' => fake()->address(),
            'koperasi_id' => 1,
        ]);
        $arib->addRole(3);

        $ridwan = User::create([
            'password' => bcrypt('12345678'),
            'nama_lengkap' => 'Ridwan Firdaus',
            'foto' => "Arr.jpg",
            'no_hp' => 'ridwan',
            'alamat' => fake()->address(),
            'koperasi_id' => 1,
        ]);
        $ridwan->addRole(2);

        $maya = User::create([
            'password' => bcrypt('12345678'),
            'nama_lengkap' => 'May May',
            'foto' => "mayy.jpg",
            'no_hp' => 'mayy',
            'alamat' => fake()->address(),
            'koperasi_id' => 1,
        ]);
        $maya->addRole(4);

        $untan = User::create([
            'password' => bcrypt('12345678'),
            'nama_lengkap' => 'Sistem Informasi Untan',
            'foto' => "untan.jpg",
            'no_hp' => 'untan',
            'alamat' => fake()->address(),
            'koperasi_id' => 1,
        ]);
        $untan->addRole(1);
        // CREATE faker 20 user
        User::factory(20)->create();
        // attach rolenya
        $total = User::whereDoesntHaveRoles()->get();
    
        for($i=0;$i < $total->count();$i++){
            $user = User::whereDoesntHaveRoles()->get();
                $user->random()->addRole(rand(1,4));
        }
    }
}
