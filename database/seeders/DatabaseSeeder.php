<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'mobile' => '1 234 567',
            'utype' => 'ADM',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'mobile' => '+386 2 234 567',
            'utype' => 'USR',
            'password' => Hash::make('password'),
        ]);



        $this->call([
            SiteSettingSeeder::class,
            MonthSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            SlideSeeder::class
        ]);
    }
}
