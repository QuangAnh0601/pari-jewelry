<?php

use App\Http\Controllers\Customers\Auth\ResetPasswordController;
use App\Http\Controllers\Customers\Auth\VerificationController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return app()->call("App\\Http\\Controllers\\HomeController@index");
});

Route::prefix('admin')->group(function() {
    Auth::routes();
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/admin/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


    Route::get('/{controller}/{action?}', function ($controller, $action = 'index') {
        $currentController = str_replace('-', '', $controller);
        $upperCase = ucwords($currentController);
        if($action == 'store' || $action == 'update' || $action == 'delete'){
            return redirect('/');
        }
        if(method_exists("App\\Http\\Controllers\\Admins\\{$upperCase}Controller", "{$action}")){
            return app()->call("App\\Http\\Controllers\\Admins\\{$upperCase}Controller@{$action}");
        }else{
            return abort(404);
        }
    })->middleware(['auth', 'verified', 'role']);

    
    Route::get('/{controller}/{action?}/{params}/{param2?}', function ($controller, $action = 'index', $params = '', $param2 = '') {
        $currentController = str_replace('-', '', $controller);
        $upperCase = ucwords($currentController);
        if($action == 'store' || $action == 'update' || $action == 'delete'){
            return redirect('/');
        }
        if(method_exists("App\\Http\\Controllers\\Admins\\{$upperCase}Controller", "{$action}")){
            return app()->call("App\\Http\\Controllers\\Admins\\{$upperCase}Controller@{$action}", ['id' => $params, 'anotherId' => $param2]);
        }else{
            return abort(404);
        }
    })->middleware(['auth', 'verified']);
    Route::match(['post', 'put', 'patch'], '/{controller}/{action?}', function ($controller, $action = 'index') {
        $currentController = str_replace('-', '', $controller);
        $upperCase = ucwords($currentController);
        if(method_exists("App\\Http\\Controllers\\Admins\\{$upperCase}Controller", "{$action}")){
            return app()->call("App\\Http\\Controllers\\Admins\\{$upperCase}Controller@{$action}");
        }else{
            return abort(404);
        }
    })->middleware(['auth', 'verified']);

    Route::delete('/{controller}/{action?}/{params}', function ($controller, $action = 'index', $params='') {
        $currentController = str_replace('-', '', $controller);
        $upperCase = ucwords($currentController);
        if(method_exists("App\\Http\\Controllers\\Admins\\{$upperCase}Controller", "{$action}")){
            return app()->call("App\\Http\\Controllers\\Admins\\{$upperCase}Controller@{$action}", ['id' => $params]);
        }else{
            return abort(404);
        }
    })->middleware(['auth:web', 'verified']);
})->middleware('role');


Route::prefix('customer')->group(function() {
    Route::get('/login', [App\Http\Controllers\Customers\Auth\LoginController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/login', [App\Http\Controllers\Customers\Auth\LoginController::class, 'login'])->name('customer.login.submit');
    Route::post('/logout', [App\Http\Controllers\Customers\Auth\LoginController::class, 'logout'])->name('customer.logout');
    Route::get('/register', [App\Http\Controllers\Customers\Auth\RegisterController::class, 'showRegistrationForm'])->name('customer.register');
    Route::post('/register', [App\Http\Controllers\Customers\Auth\RegisterController::class, 'register'])->name('customer.register.submit');
    Route::get('/forgot-password', [App\Http\Controllers\Customers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('customer.password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Customers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('customer.password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Customers\Auth\ResetPasswordController::class, 'showResetForm'])->name('customer.password.reset');
    Route::post('/customer/password/reset', [App\Http\Controllers\Customers\Auth\ResetPasswordController::class, 'reset'])->name('customer.password.update');
    // Route::middleware(['customer.verified', 'auth:customer', 'signed'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('customer.verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('customer.verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->name('customer.verification.resend');
    // });

    Route::get('/{controller}/{action?}/{params?}', function ($controller, $action = 'index', $params = '') {
        $currentController = str_replace('-', ' ', $controller);
        $upperCase = ucwords($currentController);
        $result = str_replace(' ', '', $upperCase);
        if($action == 'store' || $action == 'update' || $action == 'delete'){
            return redirect('/dash-board/index');
        }
        if(method_exists("App\\Http\\Controllers\\Customers\\MyPage\\{$result}Controller", "{$action}")){
            return app()->call("App\\Http\\Controllers\\Customers\\MyPage\\{$result}Controller@{$action}", ['id' => $params]);
        }else{
            return abort(404);
        }
    })->middleware(['auth:customer', 'customer.verified']);
    
    route::get('/order-history/order/{orderId}/order-detail/{orderDetailId}', function ($orderId = '', $orderDetailId = ''){
        return app()->call("App\\Http\\Controllers\\Customers\\MyPage\\OrderHistoryController@editOrderDetail", ['orderId' => $orderId, 'orderDetailId' => $orderDetailId ]);
    })->middleware(['auth:customer', 'customer.verified']);

    Route::match(['post', 'put', 'patch'],'/{controller}/{action?}/{id?}', function ($controller, $action = 'index', $id = '') {
        $currentController = str_replace('-', ' ', $controller);
        $upperCase = ucwords($currentController);
        $result = str_replace(' ', '', $upperCase);
        if(method_exists("App\\Http\\Controllers\\Customers\\MyPage\\{$result}Controller", "{$action}")){
            return app()->call("App\\Http\\Controllers\\Customers\\MyPage\\{$result}Controller@{$action}", ['id' => $id]);
        }else{
            return abort(404);
        }
    })->middleware(['auth:customer', 'customer.verified']);

    Route::delete('/{controller}/{action?}/{param1}/{action2}/{param2}', function ($controller, $action = 'index', $param1 = '', $action2 = '', $param2 = '') {
        $currentController = str_replace('-', ' ', $controller);
        $upperCase = ucwords($currentController);
        $result = str_replace(' ', '', $upperCase);
        if(method_exists("App\\Http\\Controllers\\Customers\\MyPage\\{$result}Controller", "{$action2}")){
            return app()->call("App\\Http\\Controllers\\Customers\\MyPage\\{$result}Controller@{$action2}", ['id' => $param1, 'otherId' => $param2]);
        }else{
            return abort(404);
        }
    })->middleware(['auth:customer', 'customer.verified']);

    Route::delete('/{controller}/{action?}/{param}', function ($controller, $action = 'index', $param = '') {
        $currentController = str_replace('-', ' ', $controller);
        $upperCase = ucwords($currentController);
        $result = str_replace(' ', '', $upperCase);
        if(method_exists("App\\Http\\Controllers\\Customers\\MyPage\\{$result}Controller", "{$action}")){
            return app()->call("App\\Http\\Controllers\\Customers\\MyPage\\{$result}Controller@{$action}", ['id' => $param]);
        }else{
            return abort(404);
        }
    })->middleware(['auth:customer', 'customer.verified']);
});


Route::get('/{controller}/{action?}', function ($controller, $action = 'index') {
    $currentController = str_replace('-', '', $controller);
    $upperCase = ucwords($currentController);
    if($action == 'store' || $action == 'update' || $action == 'delete'){
        return redirect('/');
    }
    if(method_exists("App\\Http\\Controllers\\{$upperCase}Controller", "{$action}")){
        return app()->call("App\\Http\\Controllers\\{$upperCase}Controller@{$action}");
    }else{
        return abort(404);
    }
})->middleware('checkout.success');

Route::post('/{controller}/{action?}', function ($controller, $action = 'index') {
    $currentController = str_replace('-', '', $controller);
    $upperCase = ucwords($currentController);
    if(method_exists("App\\Http\\Controllers\\{$upperCase}Controller", "{$action}")){
        return app()->call("App\\Http\\Controllers\\{$upperCase}Controller@{$action}");
    }else{
        return abort(404);
    }
});


Route::get('/{controller}/{action}/{params}', function ($controller, $action = 'index', $params = '') {
    $currentController = str_replace('-', '', $controller);
    $upperCase = ucwords($currentController);
    if(method_exists("App\\Http\\Controllers\\{$upperCase}Controller", "{$action}")){
        return app()->call("App\\Http\\Controllers\\{$upperCase}Controller@{$action}",['id' => $params]);
    }else{
        return abort(404);
    }
});

