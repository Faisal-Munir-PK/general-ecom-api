<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use App\Models\CountryHead;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitialSeeder extends Seeder
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
        // $company = Company::factory()->create(['title' => 'Abra Soft']);

        // Permissions
        // $userPermissions = [
        //     'access',
        // ];

        // $operatorPermissions = [
        //     'create',
        //     'edit',
        //     'show',
        //     'delete'
        // ];

        // $adminPermissions = [
        //     'approve',
        //     'page_access',
        //     'page_create',
        //     'page_edit',
        //     'page_show',
        //     'page_delete',
        //     'user_show',
        //     'user_ban',
        // ];

        // // Inserting Permissions
        // foreach(array_merge(array_merge($userPermissions,$adminPermissions),$operatorPermissions) as $permission){
        //     Permission::create([
        //         'name'=>$permission
        //     ]);
        // }

        // // Roles
        // $userRole = Role::create(['name' => 'user']);
        // $operatorRole = Role::create(['name' => 'operator']);
        // $adminRole = Role::create(['name' => 'admin']);
        // $superAdminRole = Role::create(['name' => 'super_admin']);

        // // Assigning Permissions to Roles
        // foreach($userPermissions as $permission){
        //     $userRole->givePermissionTo($permission);
        // }

        // foreach($operatorPermissions as $permission){
        //     $operatorRole->givePermissionTo($permission);
        // }

        // foreach($adminPermissions as $permission){
        //     $adminRole->givePermissionTo($permission);
        // }


        $user1 = User::factory()->create([
            'company_id' => "6da1b687-e230-4680-b319-f6bd71d95b02",
            'email' => 'admin@ecom.com',
        ]);

        $user2 = User::factory()->create([
            'company_id' => "6da1b687-e230-4680-b319-f6bd71d95b02",
            'email' => 'user2@ecom.com'
        ]);

        $user3 = User::factory()->create([
            'company_id' => "6da1b687-e230-4680-b319-f6bd71d95b02",
            'email' => 'user3@ecom.com'
        ]);

        $user4 = User::factory()->create([
            'company_id' => "6da1b687-e230-4680-b319-f6bd71d95b02",
            'email' => 'user4@ecom.com'
        ]);

        $user1->assignRole('super_admin');
        $user2->assignRole('admin');
        $user3->assignRole('user');
        $user4->assignRole('user');

        // $addresses = Address::factory()->count(5)->create(['company_id' => "6da1b687-e230-4680-b319-f6bd71d95b02", 'created_by' => $user1->id]);
        // $address = $addresses[0];
        // $address->update(['is_default' => true]);
    }
}
