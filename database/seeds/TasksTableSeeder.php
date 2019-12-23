<?php

use App\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    const TOTAL_COUNT = 3;

    const NEW_ID = 4;

    private $table = 'tasks';

    /**
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->delete();

        DB::table($this->table)->insert([
            'id' => 1,
            'url' => 'https://www.cashber.kz/images/logo_main.png?seed=1',
            'local_path' => '',
            'status' => Task::STATUS_PENDING,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table($this->table)->insert([
            'id' => 2,
            'url' => 'https://www.cashber.kz/images/logo_main.png?seed=2',
            'local_path' => '',
            'status' => Task::STATUS_PENDING,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table($this->table)->insert([
            'id' => 3,
            'url' => 'https://www.cashber.kz/images/logo_main.png?seed=3',
            'local_path' => '',
            'status' => Task::STATUS_PENDING,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
