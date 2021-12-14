# Complete Laravel Project: E-Commerce - Online Payment Using Laravel Cashier with Stripe API

Hi, 
My name is Watchiba, Here is my latest E-Commerce web development.

## Disclamer
Your access to this project is only for employment purposes and skills check, so you don't need to copy or reproduce one of the content of this as it's personal intellectual property.


This is my latest Laravel 8.x project developped in 2021. It's a complete E-Commerce web app. I used Laravel 8.x with Cashier and Stripe.
There's a lot of files and yes millions of codes, right, but just look at payment features.

## Important files that I created and are independant from Laravel App but communicate with the Laravel App.


/public/create.php // This file creates a session for the customer and retrieves the order made by the customer then sends the order details to Stripe.


/public/js/client.js // This is a Stripe based file that create an instance for a new order


## Payment migrations:

/database/migrations/2019_05_03_000001_create_customer_columns.php

/database/migrations/2021_04_04_165409_create_product_metas_table.php

/database/migrations/2019_05_03_000002_create_subscriptions_table.php

/database/migrations/2019_05_03_000003_create_subscription_items_table.php

/database/migrations/2021_03_28_133957_create_customers_table.php

/database/migrations/2021_03_28_200529_create_orders_table.php

/database/migrations/2021_03_31_210148_create_products_table.php

/database/migrations/2021_03_31_210218_create_product_categories_table.php

/database/migrations/2021_04_01_213441_create_sessions_table.php

/database/migrations/2021_04_04_165409_create_product_metas_table.php

## Payment's features routes:
/routes/web:
//****************ROUTE FOR CASHIER / STRIPE GATEWAY PAYMENT ********************
//PRICING ROUTE


Route::get('/pricing/{slug}', [\App\Http\Controllers\VisitorController::class, 'pricing'])->name('pricing');

Route::get('/order/{slug}', [\App\Http\Controllers\VisitorController::class, 'billing'])->name('billing');

Route::post('/order/{slug}', [\App\Http\Controllers\VisitorController::class, 'createOrder'])->name('createOrder');

Route::get('/payment/{payment_Intent_Id}', [\App\Http\Controllers\VisitorController::class, 'paymentSuccess'])->name('paymentSuccess');


## Payment Controllers: /app/Http/Controllers/VisitorController.php


### Payment functions:


 public function pricing(Request $request, ProductCategory $productCategory)
    {
    //This function retrieve details of a selected Item
    }
    
    
public function billing(Request $request, \App\Models\Order $order)
{
//This function retrieve billing details of a correspondant Item
}



public function createOrder(Request $request).
{
//This function creates an order for the customer: It charges the customer, save into database, send details to Stripe and send confirmation email to customer.

}



## Full comment details are provides within codes

So, for any clarifications, or suggestions, please, email me via info@pelogroup.net or directly via my private email address charlesjasho@gmail.com.

## Thank you



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
