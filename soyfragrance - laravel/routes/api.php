<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication
Route::post('/register', 'App\Http\Controllers\Authentication\RegisterController@register');
Route::post('/login', 'App\Http\Controllers\Authentication\LoginController@login');
Route::post('/recover-password', 'App\Http\Controllers\Authentication\RecoverPasswordController@recoverPassword');
Route::post('/reset-password/{token}', 'App\Http\Controllers\Authentication\ResetPasswordController@resetPassword');

//Shop
Route::get('/products/{id}', 'App\Http\Controllers\Shop\ProductsController@downloadProducts');
Route::get('/categories', 'App\Http\Controllers\Shop\CategoriesController@downloadCategories');
Route::get('/category/{id}', 'App\Http\Controllers\Shop\CategoriesController@downloadCategory');
Route::get('/product/{id}', 'App\Http\Controllers\Shop\ProductsController@downloadProduct');
//Orders
Route::post('/order-private-person', 'App\Http\Controllers\Shop\OrdersController@orderPrivatePerson');
Route::post('/order-company', 'App\Http\Controllers\Shop\OrdersController@orderCompany');

//Admin Panel
//Category
Route::get('/categories-list', 'App\Http\Controllers\AdminPanel\CategoriesController@downloadCategories');
Route::post('/add-category', 'App\Http\Controllers\AdminPanel\CategoriesController@addCategory');
Route::delete('/delete-category/{id}', 'App\Http\Controllers\AdminPanel\CategoriesController@deleteCategory');
Route::put('/edit-category-name/{id}', 'App\Http\Controllers\AdminPanel\CategoriesController@editCategoryName');
Route::get('/categories-data/{id}', 'App\Http\Controllers\AdminPanel\CategoriesController@downloadCategoryData');

//Orders
Route::get('/orders-list-admin', 'App\Http\Controllers\AdminPanel\OrdersController@downloadOrdersList');
Route::delete('/delete-order/{orderNumber}', 'App\Http\Controllers\AdminPanel\OrdersController@deleteOrder');
Route::get('/order-content/{orderNumber}', 'App\Http\Controllers\AdminPanel\OrdersController@downloadContentOrder');
Route::put('/update-availability/{orderNumber}', 'App\Http\Controllers\AdminPanel\OrdersController@updateAvailability');

//Products
//lista
Route::get('/products-list-admin', 'App\Http\Controllers\AdminPanel\ProductsController@downloadProductsList');
Route::get('/product-admin/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@downloadProduct');
Route::delete('/delete-product/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@deleteProduct');
//dodawanie
Route::post('/product-add', 'App\Http\Controllers\AdminPanel\ProductsController@addProduct');
//dodawanie meta title
Route::post('/product-add-meta/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@addProductMeta');
Route::post('/product-add-photos/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@addProductPhotos');
Route::post('/product-add-description/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@addProductDescription');
//edytowanie
Route::put('/edit-product-name/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductName');
Route::put('/edit-product-category/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductCategory');
Route::put('/edit-product-price/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductPrice');
Route::put('/edit-product-promo-price/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductPromoPrice');
Route::put('/edit-product-availability/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductAvailability');
Route::put('/edit-product-title/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductTitle');
Route::put('/edit-product-description/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductDescription');
Route::put('/edit-product-short-description/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductShortDescription');
Route::put('/edit-product-long-description/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductLongDescription');
Route::post('/edit-product-main-photo/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductMainPhoto');
Route::post('/edit-product-second-photo/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductSecondPhoto');
Route::post('/edit-product-third-photo/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@editProductThirdPhoto');

//Blog
//dodawanie postu
Route::post('/blog-add-post', 'App\Http\Controllers\AdminPanel\BlogController@addBlogPost');
Route::post('/blog-add-photo', 'App\Http\Controllers\AdminPanel\BlogController@addBlogPhoto');
Route::post('/blog-add-meta/{slug}', 'App\Http\Controllers\AdminPanel\BlogController@addBlogMeta');
Route::post('/blog-add-content', 'App\Http\Controllers\AdminPanel\BlogController@addBlogContent');
Route::get('/blog-download-content/{slug}', 'App\Http\Controllers\AdminPanel\BlogController@downloadBlogContent');
Route::put('/blog-edit-content/{slug}', 'App\Http\Controllers\AdminPanel\BlogController@editBlogContent');
Route::get('/blog-list', 'App\Http\Controllers\AdminPanel\BlogController@downloadBlogList');
Route::delete('/blog-delete-article/{slug}', 'App\Http\Controllers\AdminPanel\BlogController@deleteBlogArticle');
Route::get('/blog-download-all-data', 'App\Http\Controllers\AdminPanel\BlogController@downloadBlogAllData');
Route::get('/blog-download-article/{slug}', 'App\Http\Controllers\AdminPanel\BlogController@downloadBlogArticle');
Route::get('/blog-download-meta/{slug}', 'App\Http\Controllers\AdminPanel\BlogController@downloadBlogMeta');

//Lista uzytkownikow
Route::get('/users-list', 'App\Http\Controllers\AdminPanel\UserController@downloadUsersList');
Route::delete('/delete-user/{id}', 'App\Http\Controllers\AdminPanel\UserController@deleteUser');

//Newsletter
Route::get('/newsletter-list', 'App\Http\Controllers\AdminPanel\NewsletterController@downloadNewsletterList');
Route::post('/add-newsletter', 'App\Http\Controllers\AdminPanel\NewsletterController@addNewsletter');

//Kody rabatowe
Route::post('/add-promo-code', 'App\Http\Controllers\AdminPanel\PromoCodeController@addPromoCode');
Route::get('/promo-code-list', 'App\Http\Controllers\AdminPanel\PromoCodeController@downloadPromoCodeList');
Route::delete('/delete-promo-code/{id}', 'App\Http\Controllers\AdminPanel\PromoCodeController@deletePromoCode');

//Kody rabatowe - shop
Route::post('/check-promo-code', 'App\Http\Controllers\Shop\PromoCodeController@checkPromoCode');

//Settings admin
Route::get('/admin-account', 'App\Http\Controllers\AdminPanel\SettingsController@downloadAdmin');
Route::put('change-email-admin/{id}', 'App\Http\Controllers\AdminPanel\SettingsController@changeAdminEmail');

//Panel uzytkownika
//Ustawienia user
Route::get('/user-account', 'App\Http\Controllers\UserPanel\SettingsController@downloadUser');
Route::put('/change-email-user/{id}', 'App\Http\Controllers\UserPanel\SettingsController@changeUserEmail');

//Zamowienia
Route::get('/orders-list-user', 'App\Http\Controllers\UserPanel\OrdersController@ordersListUser');
Route::get('/order-status/{orderNumber}', 'App\Http\Controllers\UserPanel\OrdersController@downloadOrderStatus');

//Meta dane
Route::get('/blog-meta-data/{articleId}', 'App\Http\Controllers\AdminPanel\BlogController@downloadMetaData');
Route::get('/product-meta-data/{id}', 'App\Http\Controllers\AdminPanel\ProductsController@downloadMetaProduct');

//Kontakt kontroler
Route::post('/send-form', 'App\Http\Controllers\Shop\ContactController@sendForm');

//analityka
Route::get('/analytics-data/{month}', 'App\Http\Controllers\AdminPanel\AnaliticsController@getMonthlyPurchases');
Route::get('/analytics-data-yearly', 'App\Http\Controllers\AdminPanel\AnaliticsController@getYearlyPurchases');