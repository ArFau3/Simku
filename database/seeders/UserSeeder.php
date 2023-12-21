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
    // CREATE faker 20 user
    User::factory(20)->create();
    // attach rolenya
    $total = User::whereDoesntHaveRoles()->get();
   
    for($i=0;$total->count();$i++){
        $user = User::whereDoesntHaveRoles()->get();
            $user->random()->addRole(rand(1,4));
    }
    }
}
