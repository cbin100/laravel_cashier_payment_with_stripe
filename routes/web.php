<?php

/*
if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}

//*/
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AjaxContactController;
use App\Http\Controllers\AjaxUploadMultipleImageController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\StripePaymentController;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//ROUTE FOR AUTHENTICATE***********Scaffolding******************
Auth::routes();

//ROUTE TO ADMIN DASHBORD*****************

Route::get('/dashboard', function() {
    return view('view_admin.dashboard');
})->middleware('auth')->name('dashboard');
//

//ROUTE TO USER PROFILE*****************

Route::get('profile', function ()
{
    return view('view_admin.profile');
});

// ROUTE TO CRUD FOR CATEGORIES
//Route::resource('category', CategoriesController::class)->middleware('auth');
Route::resource('posts', PostController::class);



//***************** CATEGORY CRUD *********************
Route::get('category', [\App\Http\Controllers\PostController::class, 'categoryindex'])->name('category.index');
Route::get('category/create', [\App\Http\Controllers\PostController::class, 'categorycreate'])->name('category.create');
Route::post('category', [\App\Http\Controllers\PostController::class, 'categorystore'])->name('category.store');
Route::put('category/{post}', [\App\Http\Controllers\PostController::class, 'categoryupdate'])->name('category.update');
Route::get('category/{post}', [\App\Http\Controllers\PostController::class, 'categoryshow'])->name('category.show');
Route::get('category/{post}/edit', [\App\Http\Controllers\PostController::class, 'categoryedit'])->name('category.edit');
// END ***************** CATEGORY CRUD *********************



// ***************** FILE UPLOADER *********************
Route::get('files/create', [\App\Http\Controllers\UploaderController::class, 'create'])->name('files.create');
Route::post('files', [\App\Http\Controllers\UploaderController::class, 'store'])->name('files.store');
Route::get('files', [\App\Http\Controllers\UploaderController::class, 'index'])->name('files.index');
// END***************** FILE UPLOADER *********************
//
//***************** PAGE CRUD *********************
Route::get('pages/create', [\App\Http\Controllers\PostController::class, 'pagecreate'])->name('pages.create');
Route::post('pages', [\App\Http\Controllers\PostController::class, 'pagestore'])->name('pages.store');
Route::get('pages', [\App\Http\Controllers\PostController::class, 'pageindex'])->name('pages.index');
//Route::delete('pages/{post}', [\App\Http\Controllers\PostController::class, 'pagedestroy'])->name('pages.destroy');
Route::put('pages/{post}', [\App\Http\Controllers\PostController::class, 'pageupdate'])->name('pages.update');
Route::get('pages/{post}', [\App\Http\Controllers\PostController::class, 'pageshow'])->name('pages.show');
Route::get('pages/{post}/edit', [\App\Http\Controllers\PostController::class, 'pageedit'])->name('pages.edit');
// END ***************** PAGE CRUD *********************

//***************** MENU CRUD *********************
Route::get('menus/create', [\App\Http\Controllers\PostController::class, 'menucreate'])->name('menus.create');
Route::post('menus', [\App\Http\Controllers\PostController::class, 'menustore'])->name('menus.store');
Route::get('menus', [\App\Http\Controllers\PostController::class, 'menuindex'])->name('menus.index');
Route::put('menus/{post}', [\App\Http\Controllers\PostController::class, 'menuupdate'])->name('menus.update');
Route::get('menus/{post}/edit', [\App\Http\Controllers\PostController::class, 'menuedit'])->name('menus.edit');
// END ***************** PAGE CRUD *********************


//***************** SLIDERSHOW CRUD *********************
Route::get('slider/create', [\App\Http\Controllers\PostController::class, 'slidercreate'])->name('slider.create');
Route::post('slider', [\App\Http\Controllers\PostController::class, 'sliderstore'])->name('slider.store');
Route::get('slider', [\App\Http\Controllers\PostController::class, 'sliderindex'])->name('slider.index');
Route::put('slider/{post}', [\App\Http\Controllers\PostController::class, 'sliderupdate'])->name('slider.update');
Route::get('slider/{post}/edit', [\App\Http\Controllers\PostController::class, 'slideredit'])->name('slider.edit');

Route::delete('slider/{myslider}', [\App\Http\Controllers\PostController::class, 'sliderdestroy'])->name('slider.destroy');


//***************** MESSAGE MAIL *********************
Route::get('messages/create', [\App\Http\Controllers\PostController::class, 'messages_create'])->name('messages.create');
Route::post('messages', [\App\Http\Controllers\PostController::class, 'messages_store'])->name('messages.store');
Route::get('messages', [\App\Http\Controllers\PostController::class, 'messages_index'])->name('messages.index');
//Route::put('messages/{message}', [\App\Http\Controllers\PostController::class, 'messages_update'])->name('messages.update');
Route::get('messages/{message}/edit', [\App\Http\Controllers\PostController::class, 'messages_edit'])->name('messages.edit');
Route::get('messages/{message}', [\App\Http\Controllers\PostController::class, 'messages_show'])->name('messages.show');
Route::delete('messages/{message}', [\App\Http\Controllers\PostController::class, 'messages_destroy'])->name('messages.destroy');

//***************** END MESSAGE MAIL *********************


//Route::redirect('/',  [\App\Http\Controllers\VisitorController::class, 'index'])->name('slider.edit');

//*************HOME ROUTES*******************
Route::get('/', function () {
    $title = 'PELO GROUP';
    $title_header = 'Pelo Group Limited, Web, E-commerce, Mobile App, SEO, Data Science';

    return view('view_visitor.visitor_index', compact('title', 'title_header'));
})->name('index');

Route::get('/index.html', function () {
    return view('view_visitor.visitor_index', compact('title', 'title_header'));
})->name('index');


Route::get('/contact', function () {
    $title = 'Contact us';
    $title_header = 'Contact us - Pelo Group Limited | Web, E-commerce, Mobile App, SEO, Data Science';
    return view('view_visitor.visitor_contact', compact('title', 'title_header'));
})->name('contact');


Route::get('{slug}', [\App\Http\Controllers\VisitorController::class, 'viewindex'])->name('view.index');

Route::get('/views', function () {
    return view('view_visitor.visitor_view');
})->name('view');

Route::get('/{slugs}', [\App\Http\Controllers\VisitorController::class, 'viewoption'])->name('view.option');
//Route::get('/home', [\App\Http\Controllers\VisitorController::class, 'viewoption'])->name('view.option');

Route::get('/{home}', [\App\Http\Controllers\VisitorController::class, 'home'])->name('view.home')
        ->where('home', 'index.pelo', 'watchiba');
//Route::get('/{home}', [\App\Http\Controllers\VisitorController::class, 'home']);


Route::get('articles/{n}', function($n) {
    return view('articles')->with('numero', $n);
})->where('n', '[0-9]+');


Route::get('/page', function() {
    return view('view_visitor.visitor_index');
});

Route::get('/watch', [\App\Http\Controllers\VisitorController::class, 'watch'])->name('watch');


Route::get('/watch', function () {
    return view('view_visitor.visitor_index');
})->name('watch');
//
Route::post('contact-us', [\App\Http\Controllers\VisitorController::class, 'contactstore'])->name('contact.store');

//****************ROUTE FOR CASHIER / STRIPE GATEWAY PAYMENT ********************
//PRICING ROUTE
Route::get('/pricing/{slug}', [\App\Http\Controllers\VisitorController::class, 'pricing'])->name('pricing');
Route::get('/order/{slug}', [\App\Http\Controllers\VisitorController::class, 'billing'])->name('billing');
//Route::get('/pricing/{slug}', [\App\Http\Controllers\VisitorController::class, 'pricing'])->name('pricing');
Route::post('/order/{slug}', [\App\Http\Controllers\VisitorController::class, 'createOrder'])->name('createOrder');

//Route::get('/payment/{payment_Intent_Id}', [\App\Http\Controllers\VisitorController::class, 'chargeCustomer'])->name('chargeCustomer');
Route::get('/payment/{payment_Intent_Id}', [\App\Http\Controllers\VisitorController::class, 'paymentSuccess'])->name('paymentSuccess');




//****************ROUTE FOR STRIPE GATEWAY PAYMENT ********************
Route::get('/api/stripe', [StripePaymentController::class, 'stripe']);
Route::post('/api/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

// FOR CASHIER / STRIPE
Route::get('customers/create', [\App\Http\Controllers\EcommerceController::class, 'customers_create'])->name('customers.create');
//
Route::get('/billing-portal/bill', function (Request $request) {
    return $request->user()->redirectToBillingPortal();
});
//
//
Route::group(['middleware' => 'web'], function () {
// Put routes in here
Route::post('customers/payment', [\App\Http\Controllers\EcommerceController::class, 'create_checkout_session'])->name('create_checkout_session');
Route::post('/payment/create', [\App\Http\Controllers\EcommerceController::class, 'customerCreatePayment'])->name('customerCreatePayment');
});
//
//
//***************** PRODUCT CATEGORY CRUD *********************
Route::get('/product_category/index', [\App\Http\Controllers\EcommerceController::class, 'categoryProductIndex'])->name('categoryProductIndex');
Route::get('product_category/create', [\App\Http\Controllers\EcommerceController::class, 'categoryProductCreate'])->name('categoryProductCreate');
Route::post('product_category', [\App\Http\Controllers\EcommerceController::class, 'categoryProductStore'])->name('categoryProductStore');
Route::put('product_category/{category}', [\App\Http\Controllers\EcommerceController::class, 'categoryProductUpdate'])->name('categoryProductUpdate');
Route::get('product_category/{category}', [\App\Http\Controllers\EcommerceController::class, 'categoryProductShow'])->name('categoryProductShow');
Route::get('user/product_category/{category}/edit', [\App\Http\Controllers\EcommerceController::class, 'categoryProductEdit'])->name('categoryProductEdit');
Route::delete('product_category/{category}', [\App\Http\Controllers\EcommerceController::class, 'categoryProductDestroy'])->name('categoryProductDestroy');
// END ***************** PRODUCT CATEGORY CRUD *********************

//***************** PRODUCT CRUD *********************
Route::get('/user/product/index', [\App\Http\Controllers\EcommerceController::class, 'productIndex'])->name('productIndex');
Route::get('/user/product/create', [\App\Http\Controllers\EcommerceController::class, 'productCreate'])->name('productCreate');
Route::post('/user/product', [\App\Http\Controllers\EcommerceController::class, 'productStore'])->name('productStore');
Route::put('/user/product/{product}', [\App\Http\Controllers\EcommerceController::class, 'productUpdate'])->name('productUpdate');
Route::get('/user/product/{product}', [\App\Http\Controllers\EcommerceController::class, 'productShow'])->name('productShow');
Route::get('/user/user/product/{product}/edit', [\App\Http\Controllers\EcommerceController::class, 'productEdit'])->name('productEdit');
Route::delete('/user/product/{product}', [\App\Http\Controllers\EcommerceController::class, 'productDestroy'])->name('productDestroy');
// END ***************** PRODUCT CRUD *********************

