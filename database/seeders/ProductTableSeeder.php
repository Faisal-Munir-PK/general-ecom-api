<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;
use App\Models\Store;
use App\Models\Company;
use Faker\Generator;

class ProductTableSeeder extends Seeder
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
        $brand = Brand::get()->first();
        $categories = Category::get();
        $company = Company::get()->first();
        foreach ($categories as $key => $category) {
            Product::factory(3)->create([
                'category_id' => $category->id,
                'store_id' => $store->id,
                'brand_id' => $brand->id,
                'company_id' => $company->id,
            ]);
        }
    }
}