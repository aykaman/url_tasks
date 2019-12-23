<?php

namespace App\Http\Controllers;

use App\Jobs\DownloadUrl;
use App\Repositories\UrlTaskRepository;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * TaskController constructor.
     * @param UrlTaskRepository $urlTaskRepository
     */
    public function __construct(
        UrlTaskRepository $urlTaskRepository
    )
    {
        $this->urlTaskRepository = $urlTaskRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main(Request $request)
    {
        if($request->method() == "POST"){
            $url = $request->get('url');
            $urlTask = $this->urlTaskRepository->createFromUrl($url);
            DownloadUrl::dispatch($urlTask);
            return redirect('/');
        }

        $urlTasks = Task::all();
        return view('main',[
            'urlTasks' => $urlTasks
        ]);
    }
}
