<?php

use App\Events\NewVisitorMessage;
use App\Http\Controllers\ChatController;
use App\Livewire\CheckoutPage;
use App\Livewire\CheckoutSuccessPage;
use App\Livewire\CollectionPage;
use App\Livewire\Home;
use App\Livewire\Maps;
use App\Livewire\ProductPage;
use App\Livewire\SearchPage;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Route;


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

Route::get('/test-pusher', function () {
    // Для теста создадим “заглушечное” сообщение
    $msg = ChatMessage::create([
        'visitor_id'       => session()->getId(),
        'from_visitor'     => false,
        'text'             => 'Тестовая пушка! '.now(),
        'telegram_message_id' => null,
    ]);

    // Рассылаем событие:
    broadcast(new NewVisitorMessage($msg))->toOthers();

    return 'Event broadcasted';
});
Route::get('/set-webhook',    [ChatController::class, 'setWebhook']);
Route::get('/', Home::class);
Route::get('/test', \App\Livewire\CreatePost::class);

Route::get('/about', \App\Livewire\Pages\About::class)->name('about.view');
Route::get('/b2b', \App\Livewire\Pages\B2b::class)->name('b2b.view');
Route::get('/basket', \App\Livewire\Pages\Basket::class)->name('basket.view');
Route::get('/blogs', \App\Livewire\Pages\Blogs::class)->name('blogs.view');
Route::get('/blog', \App\Livewire\Pages\Blog::class)->name('blog.view');
Route::get('/favorites', \App\Livewire\Pages\Favorites::class)->name('favorites.view');
Route::get('/works', \App\Livewire\Pages\Works::class)->name('work.view');
Route::get('/warranty', \App\Livewire\Pages\Warranty::class)->name('warranty.view');

Route::get('/collections/{slug?}', CollectionPage::class)->name('collection.view');
Route::get('/collections', CollectionPage::class)->name('collection.view.all');

Route::get('/products/{slug}', ProductPage::class)->name('product.view');

Route::get('search', SearchPage::class)->name('search.view');

Route::get('/maps', Maps::class)->name('maps');

Route::get('checkout', CheckoutPage::class)->name('checkout.view');

Route::get('checkout/success', CheckoutSuccessPage::class)->name('checkout-success.view')->middleware('1c');


