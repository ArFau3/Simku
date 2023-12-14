<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
        ],
        'petugas' => [
            'petani' => 'c,r,u,d',
            'hasil_panen' => 'c,r,u,d',
            'harga_sawit' => 'c,r,u,d',
            'angkutan' => 'c,r,u,d',
            'jenis_varietas' => 'c,r,u,d',
            'jenis_pupuk' => 'c,r,u,d',
            'surat_jalan' => 'c,r,u,d',  
        ],
        'akuntan' => [
            'rekening' => 'c,r,u,d',
            'transaksi' => 'c,r,u,d',
            'tutup_buku' => 'c,r,u,d',
        ],
        'pengurus' => [
            'rekening' => 'r',
            'transaksi' => 'r',
            'tutup_buku' => 'r',
            'petani' => 'r',
            'hasil_panen' => 'r',
            'harga_sawit' => 'r',
            'angkutan' => 'r',
            'jenis_varietas' => 'r',
            'jenis_pupuk' => 'r',
            'surat_jalan' => 'r',  
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
