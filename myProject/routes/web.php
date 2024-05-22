<?php
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\maleController;
use App\Http\Controllers\postController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// Route::get('/', function () {
//     return view('welcome');
// });


route::get('/',[userController::class,"index"]);
route::get('/home',[userController::class,"dashboard"])->middleware('verified')->name('home');
route::get('/login',[userController::class,"login"])->name('login');
route::post('/login',[userController::class,"userLogin"])->name('userLogin');
route::get('/registerForm',[userController::class,"registerForm"]);
route::post('/register',[userController::class,"userRegister"])->name('userRegister');
// route::get('/register',[userController::class,"showUsers"])->name('showUsers');
route::get('/delete/{id}',[userController::class,"deleteUsers"])->name('deleteUsers');
route::get('/update/{id}',[userController::class,"updateUsers"])->name('updateUsers');
route::post('/update/{id}',[userController::class,"updateUsersStore"])->name('updateUsersStore');
route::get('/deleteAllUsers',[userController::class,"deleteAllUsers"])->name('deleteAllUsers');
route::get('/login',[userController::class,"login"])->name('login');
route::post('/login',[userController::class,"userLogin"])->name('userLogin');
route::get('/logout',[userController::class,"logout"])->name('logout');
route::get('/trashrecords',[userController::class,"trashrecords"])->name('trashrecords');
route::get('/restore/{id}',[userController::class,"restore"])->name('restore');
route::post('/selectidsfortrash',[userController::class,"selectidsfortrash"])->name('selectidsfortrash');
route::post('/selectidsforrestore',[userController::class,"selectidsforrestore"])->name('selectidsforrestore');
route::get('/trashall',[userController::class,"trashall"])->name('trashall');
route::get('/restoreall',[userController::class,"restoreall"])->name('restoreall');

// forgot password
// 1st step
Route::get('/forgot-password', function () {
    return view('users.forgot-password');
})->name('password.request');


// 2nd step
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    ); 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->name('password.email');


// 3rd step
Route::get('/reset-password/{token}', function ($token) {
    return view('users.reset-password', ['token' => $token]);
})->name('password.reset');


// 4th step
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');



// send email
route::get('/sendEmail',[maleController::class,'sendEmail'])->name('sendEmail');
route::post('/sendEmail',[maleController::class,'sendEmailToUser'])->name('sendEmailToUser');
route::get('/send-data-view',[maleController::class,'sendDataView'])->name('sendDataView');

// send     Notification
route::get('/sendNotification',[maleController::class,'sendNotification'])->name('sendNotification');
route::post('/sendNotification',[maleController::class,'sendNotificationToUser'])->name('sendNotificationToUser');

// email veryfication
 
// step 1
Route::get('/email/verify', function () {
    return view('users.verify-email');
// })->name('verification.notice');
})->middleware('auth')->name('verification.notice');


// step 2
Route::post('/email/verification-notification', function (Request $request) {
    date_default_timezone_set("asia/karachi");
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// step 3

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = $request->user();
    $user->update(['verified_at' => now()]);
    return redirect('/home'); // Redirect to the dashboard after email verification
})->middleware(['auth', 'signed'])->name('verification.verify');



// post sections
route::get('post-category',[postController::class,"postCategory"])->name('postCategory');
route::post('post-category',[postController::class,"postCategoryStore"])->name('postCategoryStore');

route::get('post',[postController::class,"post"])->name('post');
route::post('post',[postController::class,"postStore"])->name('postStore');

route::get('post-view',[postController::class,"postView"])->name('postView');
route::get('/slug/mlug/{slug}/{id}',[postController::class,"postSlug"])->name('postSlug');
route::get('/post-by-category/{id}',[postController::class,"postByCategorView"])->name('postByCategorView');
route::get('/see-post/{id}',[postController::class,"seePost"])->name('seePost');
route::get('post-update/{id}',[postController::class,"postUpdate"])->name('postUpdate');
route::post('post-update/{id}',[postController::class,"postUpdateStore"])->name('postUpdateStore');
route::get('post-delete/{id}',[postController::class,"postDelete"])->name('postDelete');
route::get('download/{id}',[userController::class,"download"])->name('download');





// Route::fallback(function(){
//     return "<h1>Page Not Found </h1>";
//     });


// redirect
// Route::redirect('reverse','videos',301);


// Route & Routes

// Route::prefix('/Provincial-Sales-Tax-Registration')->group(function(){

//     Route::get('/Individual',[individualController::class,'Individual'])->name('Individual');
// Route::post('/Individual',[individualController::class,'IndividualStore'])->name('IndividualStore');

//     Route::get('/FirmPartnership',[FirmPartnershipController::class,'FirmPartnership'])->name('FirmPartnership');
//     Route::post('/FirmPartnership',[FirmPartnershipController::class,'FirmPartnershipStore'])->name('FirmPartnershipStore');
    
//     Route::get('/SECPCompanyInProvincial',[SecpCompanyInProvincialController::class,'SECPCompanyInProvincial'])->name('SECPCompanyInProvincial');
//     Route::post('/SECPCompanyInProvincial',[SecpCompanyInProvincialController::class,'SECPCompanyInProvincialStore'])->name('SECPCompanyInProvincialStore');
        
//  });