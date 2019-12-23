<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebUiTest extends TestCase
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
    public function testMain()
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $tableExists = strpos($content, '<h1 class="mt-4">Tasks</h1>') !== false;
        $formExists = strpos($content, '<h5 class="card-header">Enqueue task:</h5>') !== false;

        $response->assertStatus(200);
        $this->assertTrue($tableExists);
        $this->assertTrue($formExists);
    }

    public function testForm(){
        $url = 'https://www.cashber.kz/images/logo_main.png?time=' . time();
        $response = $this->post('/', [
            'url' => $url,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', ['url' => $url]);
    }
}
