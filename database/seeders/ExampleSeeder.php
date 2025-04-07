<?php

namespace Database\Seeders;

use App\Models\FamilyMember;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $grandfather = FamilyMember::create([
            'name' => 'lroem in s isdgj',
            'gender' => 'male',
            'from' => 'int',
            'partner_id' => null,
            'parent_id' => null,
            'dob' => '1950-01-01',
            'description' => 'Kepala keluarga generasi pertama.'
        ]);

        $grandmother = FamilyMember::create([
            'name' => 'bha foajsb ggoasb',
            'gender' => 'female',
            'from' => 'eks',
            'partner_id' => $grandfather->id,
            'parent_id' => null,
            'dob' => '1955-03-12',
            'description' => 'Istri dari Kakek A, seorang ibu rumah tangga.'
        ]);

        $grandfather->update(['partner_id' => $grandmother->id]);

        $father = FamilyMember::create([
            'name' => 'nugb isubgb',
            'gender' => 'male',
            'from' => 'int',
            'partner_id' => null,
            'parent_id' => $grandfather->id,
            'dob' => '1978-06-15',
            'description' => 'Anak pertama dari Kakek A dan Nenek A.'
        ]);

        $mother = FamilyMember::create([
            'name' => 'nngisbn sfig sigjsio',
            'gender' => 'female',
            'from' => 'eks',
            'partner_id' => $father->id,
            'parent_id' => null,
            'dob' => '1980-09-20',
            'description' => 'Istri dari Ayah B, berasal dari luar keluarga inti.'
        ]);

        $father->update(['partner_id' => $mother->id]);

        $uncle = FamilyMember::create([
            'name' => 'nsdhbgsid  igbisubg esuigbsiugb dsgibsiugbsdiud',
            'gender' => 'male',
            'from' => 'int',
            'partner_id' => null,
            'parent_id' => $grandfather->id,
            'dob' => '1982-11-02',
            'description' => 'Anak kedua, adik dari Ayah B.'
        ]);

        $auntInLaw = FamilyMember::create([
            'name' => 'Tante C',
            'gender' => 'female',
            'from' => 'eks',
            'partner_id' => $uncle->id,
            'parent_id' => null,
            'dob' => '1985-02-10',
            'description' => 'Istri dari Om C.'
        ]);

        $uncle->update(['partner_id' => $auntInLaw->id]);

        FamilyMember::create([
            'name' => 'Anak D',
            'gender' => 'female',
            'from' => 'int',
            'partner_id' => null,
            'parent_id' => $father->id,
            'dob' => '2005-07-25',
            'description' => 'Anak perempuan pertama dari Ayah B dan Ibu B.'
        ]);

        FamilyMember::create([
            'name' => 'Anak E',
            'gender' => 'male',
            'from' => 'int',
            'partner_id' => null,
            'parent_id' => $father->id,
            'dob' => '2008-03-17',
            'description' => 'Anak laki-laki kedua dari Ayah B dan Ibu B.'
        ]);
    }

}
