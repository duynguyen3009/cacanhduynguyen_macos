<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            [
                'name'          => 'slider01',
                'image'         => 'slider01.jpg',
                'url'           => 'google.com',
                'description'   => 'this is a description',
                'start_date'    => '20230713',
                'end_date'      => '20230713',
                'status'        => 1,
                'sequence'      => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'slider02',
                'image'         => 'slider02.jpg',
                'url'           => 'google.com',
                'description'   => 'this is a description',
                'start_date'    => '20230713',
                'end_date'      => '20230713',
                'status'        => 1,
                'sequence'      => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'slider03',
                'image'         => 'slider03.jpg',
                'url'           => 'google.com',
                'description'   => 'this is a description',
                'start_date'    => '20230713',
                'end_date'      => '20230713',
                'status'        => 1,
                'sequence'      => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'slider04',
                'image'         => 'slider04.jpg',
                'url'           => 'google.com',
                'description'   => 'this is a description',
                'start_date'    => '20230713',
                'end_date'      => '20230713',
                'status'        => 1,
                'sequence'      => 4,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'slider05',
                'image'         => 'slider05.jpg',
                'url'           => 'google.com',
                'description'   => 'this is a description',
                'start_date'    => '20230713',
                'end_date'      => '20230713',
                'status'        => 1,
                'sequence'      => 5,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'slider06',
                'image'         => 'slider06.jpg',
                'url'           => 'google.com',
                'description'   => 'this is a description',
                'start_date'    => '20230713',
                'end_date'      => '20230713',
                'status'        => 1,
                'sequence'      => 6,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'slider07',
                'image'         => 'slider07.jpg',
                'url'           => 'google.com',
                'description'   => 'this is a description',
                'start_date'    => '20230713',
                'end_date'      => '20230713',
                'status'        => 1,
                'sequence'      => 7,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'slider08',
                'image'         => 'slider08.jpg',
                'url'           => 'google.com',
                'description'   => 'this is a description',
                'start_date'    => '20230713',
                'end_date'      => '20230713',
                'status'        => 1,
                'sequence'      => 8,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];
        DB::table('sliders')->insert($values);
    }
}
