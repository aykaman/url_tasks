<?php

namespace Tests\Unit\Repositories;

use App\Repositories\UrlTaskRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use TasksTableSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UrlTaskRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $repository = new UrlTaskRepository();
        $url = 'https://www.cashber.kz/images/logo_main.png?time=' . time();
        $model = $repository->createFromUrl($url);
        $this->assertEquals(TasksTableSeeder::NEW_ID, $model->id);
        $this->assertEquals($url, $model->url);
    }
}
