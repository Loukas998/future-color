<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('homes')->insert([
            'whatsapp_link' => 'https://wa.me/0534728561',
            'printed_projects' => 5000,
            'printing_services' => 10,
            'clients' => 3000,
            'phone_number' => '0534728561',
            'email' => 'khaldalshryf4@gmail.com',
            'location' => 'الرياض، المملكة العربية السعودية',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
