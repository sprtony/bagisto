<?php

namespace Webkul\Customer\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CustomerGroupTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('customer_groups')->delete();

        DB::table('customer_groups')->insert([
            [
                'id'              => 1,
                'code'            => 'guest',
                'name'            => 'Invitados',
                'is_user_defined' => 0,
            ], [
                'id'              => 2,
                'code'            => 'general',
                'name'            => 'Registrados',
                'is_user_defined' => 0
            ]
        ]);
    }
}

