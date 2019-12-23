<?php

namespace App\Repositories;

use App\Task;

/**
 * Class TaskRepository
 * @package App\Repositories
 */
class UrlTaskRepository extends BaseRepository
{
    /**
     * @param $url
     * @return Task
     */
    public function createFromUrl($url)
    {
        $model = new Task();
        $model->url = $url;
        $model->status = Task::STATUS_PENDING;
        $model->local_path = '';
        $model->save();
        return $model;
    }
}