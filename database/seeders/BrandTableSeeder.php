<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use App\Models\Store;
use Faker\Generator;
use Illuminate\Container\Container;

class BrandTableSeeder extends Seeder
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


        Brand::factory()->create([
            'store_id' => $store->id,
        ]);
    }
}
