<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Board;
use App\Models\Task;


/**
 * Class TestSeeder
 *
 * @package Database\Seeders
 */
 
class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        User::factory()

            ->count(10)
            ->has(

                Board::factory()
                    ->count(6),
                'boards'
            )
            ->create();
    }
}
