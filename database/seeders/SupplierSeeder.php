<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Supplier = Supplier::create([
            'name' => 'VinHome',
            'phone' => '03452139',
            'email' => 'VinHome@gmail.com',
            'address' => 'việt nam',
        ]);
        $sup = Supplier::create([
            'name' => 'VinMart',
            'phone' => '03452139',
            'email' => 'VinMart@gmail.com',
            'address' => 'việt nam',
        ]);
        $sup = Supplier::create([
            'name' => 'CoopMart',
            'phone' => '03452139',
            'email' => 'CoopMart@gmail.com',
            'address' => 'việt nam',
        ]);
        $sup = Supplier::create([
            'name' => 'BigC',
            'phone' => '03452139',
            'email' => 'BigC@gmail.com',
            'address' => 'việt nam',
        ]);
    }
}
