<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class StoreTableSeeder extends Seeder
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
        // $company = Company::whereTitle('WBB-Boxing')->get()->first();
        // $user = User::factory()->create();
        $company = Company::get()->first();


        Store::factory()->create([
            'company_id' => $company->id,
        ]);
    }
}
