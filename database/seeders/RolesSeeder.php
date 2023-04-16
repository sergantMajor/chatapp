<?php
namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::upsert([
            [
                'name' => 'admin',

                'description' => 'Owner and could manage all data related to the inventory',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'customer',

                'description' => 'User who registered just for purchasing the services',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ], ['name'], ['description','updated_at']);

    }
}
