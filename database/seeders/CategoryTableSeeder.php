<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class CategoryTableSeeder extends Seeder
{
    protected $faker;

    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = Store::get()->first();
        Category::factory(4)->create([
            'store_id' => $store->id,
        ])->each(function ($category, $key) {
            Category::factory()->count(11)->create([
                'store_id' => $category->store_id,
                'category_id' => $category->id,
            ])->each(function ($category, $key) {
                Category::factory()->count(7)->create([
                    'store_id' => $category->store_id,
                    'category_id' => $category->id,
                ])->each(function ($category, $key) {
                    Category::factory()->count(3)->create([
                        'store_id' => $category->store_id,
                        'category_id' => $category->id,
                        'has_child' => false,
                    ]);
                });
            });
        });
    }
}
