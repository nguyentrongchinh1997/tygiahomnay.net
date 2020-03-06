<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Client\BankService;
use App\Exports\BankExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\Bank;

class BankController extends Controller
{
	protected $bankService;

	public function __construct(BankService $bankService)
	{
		$this->bankService = $bankService;
	}

    public function bankView($bankName, Request $request)
    {
    	$bank = $this->bankService->bankView($bankName);

    	if (!empty($bank)) {
    		$data = $this->bankService->exchangeRate($bank->id, $request, $bankName);
            $data['bank'] = $bank;

			return view('client.pages.bank', $data);
    	} else {
    		return redirect()->route('client.home');
    	}
    	
    }

    public function test(Request $request)
    {
    	dd($request->date);
    }

    public function export($date, $bankId)
    {
        $bank = Bank::findOrFail($bankId);

        return Excel::download(new BankExport($date, $bankId), $bank->name . '.xlsx');
    }
}
