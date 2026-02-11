<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Booking;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MockPaymentController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard (Breeze default)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Perfil proveedor (público)
|--------------------------------------------------------------------------
*/
Route::get('/p/{slug}', function ($slug) {

    $provider = User::where('role', 'provider')
        ->whereHas('providerProfile', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })
        ->with(['providerProfile'])
        ->firstOrFail();

    return view('provider.show', compact('provider'));
});


/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/
Route::get('/checkout/{booking}', function (Booking $booking) {

    abort_unless(auth()->check(), 403);
    abort_unless($booking->client_id === auth()->id(), 403);

    $booking->load(['service', 'provider.providerProfile']);

    return view('checkout.show', compact('booking'));

})->middleware('auth');

/*sssss*/
/*
|--------------------------------------------------------------------------
| Pago simulado (mock)
|--------------------------------------------------------------------------
*/
Route::post('/pay/mock/{booking}', [MockPaymentController::class, 'pay'])
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| Mis citas (cliente)
|--------------------------------------------------------------------------
*/
Route::get('/mi-cuenta/citas', function () {

    $bookings = Booking::where('client_id', auth()->id())
        ->with(['service', 'provider.providerProfile'])
        ->orderBy('start_at')
        ->get();

    return view('account.bookings', compact('bookings'));

})->middleware('auth');




Route::get('/meet/{booking}', function (Booking $booking, Request $request) {
    // solo el cliente o el proveedor puede entrar
    abort_unless(auth()->check(), 403);
    abort_unless(in_array(auth()->id(), [$booking->client_id, $booking->provider_id]), 403);

    return view('meet.show', compact('booking'));
})->middleware('auth');

Route::get('/meet/{booking}/host', function (Booking $booking, Request $request) {
    abort_unless(auth()->check(), 403);
    abort_unless(auth()->id() === $booking->provider_id, 403);

    return view('meet.host', compact('booking'));
})->middleware('auth');




/*
|--------------------------------------------------------------------------
| Breeze profile routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';
