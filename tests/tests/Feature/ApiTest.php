<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use TasksTableSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testGetTasks()
    {
        $response = $this->json('GET', '/api/tasks');

        $content = $response->getContent();
        $content = json_decode($content, true);

        $response->assertStatus(200);
        $this->assertEquals(TasksTableSeeder::TOTAL_COUNT, count($content));
        $this->assertEquals(1, $content[0]['id']);
    }

    /**
     * @return void
     */
    public function testCreateTask()
    {
        $url = 'https://www.cashber.kz/images/logo_main.png?time=' . time();
        $response = $this->json('POST', '/api/tasks', ['url' => $url]);
        $response
            ->assertStatus(201)
            ->assertJson([
                'url' => $url,
                'status' => 'pending',
            ]);
    }
}
