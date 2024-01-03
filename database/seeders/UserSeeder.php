<?php

namespace Database\Seeders;

use App\Models\User;
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
            'username' => 'Arr',
            'password' => bcrypt('12345678'),
            'nama_lengkap' => 'Arib Fauzan',
            'foto' => "Arr.jpg",
            'no_hp' => '08198563768',
        ]);
        $arib->addRole(3);

        $ridwan = User::create([
            'username' => 'ridwan',
            'password' => bcrypt('12345678'),
            'nama_lengkap' => 'Ridwan Firdaus',
            'foto' => "Arr.jpg",
            'no_hp' => '08198563768',
        ]);
        $ridwan->addRole(2);

        $maya = User::create([
            'username' => 'Mayy',
            'password' => bcrypt('12345678'),
            'nama_lengkap' => 'May May',
            'foto' => "mayy.jpg",
            'no_hp' => '08198563768',
        ]);
        $maya->addRole(4);

        $untan = User::create([
            'username' => 'Untan',
            'password' => bcrypt('12345678'),
            'nama_lengkap' => 'Sistem Informasi Untan',
            'foto' => "untan.jpg",
            'no_hp' => '08198563768',
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
