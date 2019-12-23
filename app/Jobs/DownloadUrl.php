<?php

namespace App\Jobs;

use App\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

/**
 * Class DownloadUrl
 * @package App\Jobs
 */
class DownloadUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const MAX_ATTEMPTS = 1;

    /**
     * @var Task
     */
    private $task;

    /**
     * Create a new job instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $task = $this->task;
        $task->status = Task::STATUS_DOWNLOADING;
        $task->save();

        try{
            $filePath = $this->downloadFile($task);

            $task->local_path = Storage::url($filePath);
            $task->status = Task::STATUS_COMPLETE;
            $task->save();
        }
        catch (\Throwable $t){
            $task->status = Task::STATUS_ERROR;
            $task->save();

            $this->fail();
        }
    }

    /**
     * @param Task $task
     * @return string
     */
    private function downloadFile(Task $task){
        $url = $task->url;
        $id = $task->id;
        $pathInfo = pathinfo($url);
        $extension = $pathInfo['extension'];
        $fileName = 'task_' . $id;
        if($extension){
            $fileName .= '.' . $extension;
        }

        $content = file_get_contents($url);
        $filePath = 'downloads/' . $fileName;
        Storage::disk('public')->put($filePath, $content);
        return $filePath;
    }
}
