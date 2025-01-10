<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $works = ['Accounting', 'Writer', 'Cyber Security', 'Data Science', 'Software Engineering', 'AI Engineering', 'Management'];

        foreach($works as $work){
            Work::create(['name' => $work]);
        }
    }
}
