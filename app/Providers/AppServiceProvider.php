<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Support\Facades\Schema;
use App\Model\Bank;
use App\Model\CurrencyName;
use App\Model\Gold;
use App\Model\Oil;
use App\Model\ExchangeRate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('*', function($view){
            $banks = Bank::all();
            $currencies = CurrencyName::all();
            $golds = Gold::all();
            $oil = Oil::orderBy('date', 'desc')->take(1)->first();
            $oils = Oil::where('date', $oil->date)->get();
            $reccent_day_sidebar = ExchangeRate::where('currency_name_id', config('config.currency.usd'))->orderBy('date', 'desc')->first();
            $usds = ExchangeRate::where('currency_name_id', config('config.currency.usd'))
                                ->where('date', $reccent_day_sidebar->date)
                                ->get();

            $data = [
                'dateOil' => $oil->updated_at,
                'oils' => $oils,
                'golds' => $golds,
                'banks' => $banks,
                'currencies' => $currencies,
                'usds' => $usds,
                'reccent_day_sidebar' => $reccent_day_sidebar,
            ];
            
            $view->with($data);
        });
    }
}
