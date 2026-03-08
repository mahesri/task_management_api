<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Traits\Date;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            'title' => 'Learn deeply PHP Unit Test',
            'description' => 'Learn what matters from unit test',
            'status' => 'todo',
            'due_date' => \Illuminate\Support\now()
        ]);
    }
}
