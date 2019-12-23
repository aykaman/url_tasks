<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\DownloadUrl;
use App\Repositories\UrlTaskRepository;
use App\Task;
use Illuminate\Http\Request;

/**
 * Class UrlController
 * @package App\Http\Controllers
 */
class UrlController extends Controller
{
    /**
     * @var UrlTaskRepository
     */
    private $urlTaskRepository;

    /**
     * UrlController constructor.
     * @param UrlTaskRepository $urlTaskRepository
     */
    public function __construct(
        UrlTaskRepository $urlTaskRepository
    )
    {
        $this->urlTaskRepository = $urlTaskRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $url = $request->get('url');
        $urlTask = $this->urlTaskRepository->createFromUrl($url);
        DownloadUrl::dispatch($urlTask);
        return $urlTask;
    }

}
