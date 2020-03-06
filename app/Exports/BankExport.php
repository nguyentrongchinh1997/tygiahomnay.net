<?php

namespace App\Exports;

use App\Model\ExchangeRate;
use App\Model\Bank;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BankExport implements FromView
{
	protected $date, $bankId;

	public function __construct(string $date, int $bankId)
	{
		$this->date = $date;
		$this->bankId = $bankId;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$exchangeRate = ExchangeRate::where('bank_id', $this->bankId)
    								->where('date', $this->date)
    								->get();
        $bank = Bank::findOrFail($this->bankId);
        $data = [
            'bank' => $bank,
            'exchangeRate' => $exchangeRate
        ];

        return view('client.exports.bank', $data);
    }
}
