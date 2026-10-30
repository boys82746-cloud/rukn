<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo users + listings so the platform looks alive (run with --seed)
        $this->call(DemoSeeder::class);
    }
}
