<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use TasksTableSeeder;
use Tests\TestCase;

class ConsoleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @return void
     */
    public function testCreateTask()
    {
        $url = 'https://www.cashber.kz/images/logo_main.png?time=' . time();
        $this->artisan('task:create', ['url' => $url])
            ->expectsOutput('Created task #' . TasksTableSeeder::NEW_ID)
            ->assertExitCode(0);
    }

    /**
     * @return void
     */
    public function testGetTasks()
    {
        $test = $this->artisan('task:list');

        for ($i = 1; $i <= TasksTableSeeder::TOTAL_COUNT; $i++){
            $test->expectsOutput("Task #$i - pending - http://demo.antonshell.me/files/sardegna.gpx?seed=$i");
        }

        $test->assertExitCode(0);
    }
}
