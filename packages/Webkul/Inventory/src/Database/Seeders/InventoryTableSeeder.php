<?php

namespace Webkul\Inventory\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class InventoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('inventory_sources')->delete();

        DB::table('inventory_sources')->insert([
            'id'             => 1,
            'code'           => 'default',
            'name'           => 'Bodega Principal',
            'contact_name'   => '',
            'contact_email'  => '',
            'contact_number' => 0,
            'status'         => 1,
            'country'        => 'MX',
            'state'          => '',
            'street'         => '',
            'city'           => '',
            'postcode'       => '',
        ]);
    }
}

