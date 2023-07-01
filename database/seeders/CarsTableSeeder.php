<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i=0; $i < 50 ; $i++) {
            $data[] = [
                "name" => "Avanza AZ",
                "description"=> "Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak",
                "brand_id"=> "1",
            ];
        }
        Car::insert($data);
    }
}
