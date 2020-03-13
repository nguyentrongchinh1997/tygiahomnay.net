<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Client\NewsService;

class NewsController extends Controller
{
	protected $newsService;

    public function __construct(NewsService $newsService)
    {
    	$this->newsService = $newsService;
    }

    public function news()
    {
    	$data = $this->newsService->news();

    	return view('client.pages.news.list', $data);
    }

    public function detail($slug, $id)
    {
    	$data = $this->newsService->detail($slug, $id);

    	return view('client.pages.news.detail', $data);
    }
}

