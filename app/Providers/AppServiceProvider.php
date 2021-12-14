<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// ADD THIS LINE
use Illuminate\Support\Facades\Schema;
// Use this line for Cashier
use Laravel\Cashier\Cashier;

// use the custom Cashier model
use App\Models\Cashier\Subscription;
use App\Models\Cashier\SubscriptionItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Use this line for Cashier
        // If you would like to prevent Cashier's migrations from running entirely
        //Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

     //*
    /*
     After defining your model, you may instruct Cashier to use your custom model via the
     Laravel\Cashier\Cashier class.
    Typically, you should inform Cashier about your custom models in the boot method of your application's
     App\Providers\AppServiceProvider class:
    */
    public function boot()
    {
        // FOR LARAVEL 8, Before we run our migration command, we need to specify the default string length, else, we are going to run into errors
        // add Schema::defaultstringLength(191); to the boot function, also add use Illuminate\Support\Facades\Schema; TO THE TOP
        Schema::defaultstringLength(191);

        /*
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        */
        Cashier::useSubscriptionModel(Subscription::class);
        Cashier::useSubscriptionItemModel(SubscriptionItem::class);
    }
    //*/


    /*
    public function boot(UrlGenerator $url)
      {
              if (env('APP_ENV') !== 'local') {
                    $url->forceScheme('https');
              }
       }
       */
}
