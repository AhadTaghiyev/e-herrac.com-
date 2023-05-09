<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Menu::$locations as $location) {
            Menu::create(['name' => $location['name'], 'location' => $location['location'], 'has_dropdown' => $location['has_dropdown'], 'is_active' => true]);
        }
    }
}
