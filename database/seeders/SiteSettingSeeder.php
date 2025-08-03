<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('site_settings')->insert([
            'phone_one' => '+1 (555) 123-4567',
            'phone_two' => '+1 (555) 987-6543',
            'email' => 'contact@innovatesolutions.com',
            'company_name' => 'Innovate Solutions Inc.',
            'company_address' => '123 Tech Avenue, Silicon Valley, CA 94043',
            'facebook' => 'https://www.facebook.com/InnovateSolutions',
            'twitter' => 'https://twitter.com/InnovateInc',
            'linkedin' => 'https://www.linkedin.com/company/innovate-solutions',
            'youtube' => 'https://www.youtube.com/c/InnovateSolutions',
            'instagram' => 'https://instagram.com/InnovateSolutions',
            'logo' => 'logo.png'
        ]);
    }
}
