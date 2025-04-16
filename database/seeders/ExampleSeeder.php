<?php

namespace Database\Seeders;

use App\Models\FamilyMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $grandfather = FamilyMember::create([
            'name' => 'Kakek 1',
            'gender' => 'male',
            'from' => 'int',
            'partner_id' => null,
            'parent_id' => null,
            'dob' => '1950-01-01',
            'description' => 'Kepala keluarga generasi pertama.'
        ]);

        $grandmother = FamilyMember::create([
            'name' => 'Nenek',
            'gender' => 'female',
            'from' => 'eks',
            'partner_id' => $grandfather->id,
            'parent_id' => null,
            'dob' => '1955-03-12',
            'description' => 'Istri dari Kakek A, seorang ibu rumah tangga.'
        ]);

        // ------------------------------------------

        $admin = User::create([
            'name' => 'Kakek',
            'phone' => '082336546903',
            'password' => Hash::make('111111'),
            'level' => 'admin'
        ]);

        $user = User::create([
            'name' => 'Nenek',
            'phone' => '082336546904',
            'password' => Hash::make('111111'),
            'level' => 'user'
        ]);

        $grandfather->update([
            'partner_id' => $grandmother->id,
            'user_id' => $admin->id,
        ]);

        $grandmother->update([
            'user_id' => $user->id,
        ]);
    }

}
