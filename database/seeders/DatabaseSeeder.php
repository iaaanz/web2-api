<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Company::factory(3)
            ->has(User::factory(3)
                ->has(Product::factory(10)))
            ->create();
    }
}
