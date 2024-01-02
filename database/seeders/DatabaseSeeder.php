<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TutupBuku;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // UTAMA
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);

        // SEEDER AKUNTANSI
        $this->call(RekeningSeeder::class);
        $this->call(TransaksiInventarisSeeder::class);
        $this->call(TutupBukuSeeder::class);
        $this->call(JurnalUmumSeeder::class);
        $this->call(AktivitasSeeder::class);

        // SEEDER SUPLIER
        $this->call(VarietasSawitSeeder::class);
        $this->call(TahunSawitSeeder::class);
        $this->call(PupukSeeder::class);
        $this->call(PetaniSeeder::class);
    }
}