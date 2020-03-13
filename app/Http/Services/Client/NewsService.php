<?php

namespace App\Http\Services\Client;

use App\Model\News;
use App\Model\Bank;
use View;

class NewsService
{
	protected $newsModel, $bankModel;

	public function __construct(News $newsModel, Bank $bankModel)
	{
		$this->newsModel = $newsModel;
		$this->bankModel = $bankModel;
		// view()->share([
  //           'banks' => $this->bankModel->all(),
  //       ]);
	}

	public function news()
	{
		$newsList =  $this->newsModel->paginate(20);
		$banks = $this->bankModel->all();
		$data = [
			'newsList' => $newsList,
		];

		return $data;
	}

	public function detail($slug, $id)
	{
		$news = $this->newsModel->findOrFail($id);
		$news->increment('view');
		$newsRand = $this->newsModel->all()->random(3);
		$newsTopRand = $this->newsModel->where('id', '!=', $id)->latest('view')->limit(4)->get();
		$data = [
			'news' => $news,
			'newsRand' => $newsRand,
			'newsTopRand' => $newsTopRand
		];

		return $data;
	}
}