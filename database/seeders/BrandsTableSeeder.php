<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Toyota',
                'logo' => ''
            ],
            [
                'name' => 'Daihatsu',
                'logo' => ''
            ],
            [
                'name' => 'Suzuki',
                'logo' => ''
            ],
            [
                'name' => 'Mercedes Benz',
                'logo' => ''
            ],
        ];
        $users = Brand::insert($data);
    }
}
