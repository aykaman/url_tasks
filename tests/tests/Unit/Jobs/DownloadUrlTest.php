<?php

namespace Tests\Unit\Jobs;

use App\Jobs\DownloadUrl;
use App\Task;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DownloadUrlTest extends TestCase
{
    /**
     * @return void
     */
    public function testJobDispatched()
    {
        Queue::fake();
        Storage::fake();

        $task = new Task();
        $task->url = 'https://www.cashber.kz/images/logo_main.png';
        $task->status = Task::STATUS_PENDING;
        $job = (new DownloadUrl($task));

        dispatch($job);

        Queue::assertPushed(DownloadUrl::class, function (DownloadUrl $job) {
            //@todo implement correct test for checking job is dispatched
            return $job->attempts() == 1;
        });
    }
}
