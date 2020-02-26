<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Support\Facades\Schema;
use App\Model\Bank;
use App\Model\CurrencyName;
use App\Model\Gold;

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
            $data = [
                'golds' => $golds,
                'banks' => $banks,
                'currencies' => $currencies
            ];
            
            $view->with($data);
        });
    }
}
