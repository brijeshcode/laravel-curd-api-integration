<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\Properties\PropertyType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if (!User::exists()) {
            User::insert(
                [
                    'name' => "brijesh",
                    'email' => 'brijesh@test.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('test'),
                ],
            );
        }


        PropertyType::updateOrCreate(['id'=> 1, 'title' => 'Flat'], ['description' => 'rom studio flats, to maisonettes and 2-storey flats, a flat is a living area that is self-contained and in one part of a building. A building is usually split into individual flats and the communal areas are those that are shared e.g. lifts, stairwells, receptions etc']);
        PropertyType::updateOrCreate(['id'=> 2,'title' => 'Detatched'], ['description' => 'rom studio flats, to maisonettes and 2-storey flats, a flat is a living area that is self-contained']);
        PropertyType::updateOrCreate(['id'=> 3,'title' => 'Semi-detached'], ['description' => 'rom studio flats, to maisonettes and 2-storey flats, a flat is a living area that is self-contained and in one part of a building. A building is usually split into individual flats and the communal areas are those that are shared e.g. lifts, stairwells, receptions etc']);
        PropertyType::updateOrCreate(['id'=> 4,'title' => 'Terraced'], ['description' => 'rom studio flats, to maisonettes and 2-storey flats, a flat is a living area that is self-contained']);
        PropertyType::updateOrCreate(['id'=> 5,'title' => 'End of Terrace'], ['description' => 'rom studio flats, to maisonettes and 2-storey flats, a flat is a living area that is self-contained']);
        PropertyType::updateOrCreate(['id'=> 6,'title' => 'Cottage'], ['description' => 'rom studio flats, to maisonettes and 2-storey flats, a flat is a living area that is self-contained and in one part of a building. A building is usually split into individual flats and the communal areas are those that are shared e.g. lifts, stairwells, receptions etc']);
        PropertyType::updateOrCreate(['id'=> 7,'title' => 'Bungalow'], ['description' => 'rom studio flats, to maisonettes and 2-storey flats, a flat is a living area that is self-contained']);

    }
}
