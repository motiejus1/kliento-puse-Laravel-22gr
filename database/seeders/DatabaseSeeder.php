<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Company::factory(10)->create();
        $test_data = ['Profit-focused foreground neural-net','Virtual foreground opensystem','Balanced stable attitude'];

        for ($i=0; $i<3; $i++) {
            DB::table('companies')->insert([
                'title' => $test_data[$i],
                'contact' => 'contact'.$i
            ]);
        }
        
    }
}
