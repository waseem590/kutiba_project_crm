<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Management'
            ],
            [
                'name' => 'Counsellor'
            ],
            [
                'name' => 'Admissions'
            ],
            [
                'name' => 'Visa'
            ],
            [
                'name' => 'Finance'
            ],
            [
                'name' => 'Master User'
            ],
            [
                'name' => 'Admin'
            ],
        ];
        foreach($roles as $val){
            Role::create($val);
        }
    }
}
