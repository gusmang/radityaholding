<?php

use App\Models\User;
use App\Events\MyEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
use App\Notifications\BrowserNotification;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PettyCashController;
use App\Http\Controllers\ReportPdfController;
use App\Http\Controllers\UnitUsahaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Api\ApiJabatanController;

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
Route::get('/pusher', [LoginController::class, 'pusher'])->name('pusher');
Route::get('/', [LoginController::class, 'pageLogin'])->name('homePage');
Route::get('/login', [LoginController::class, 'pageLogin'])->name('pagelogin');
Route::get('/reset-pass', [LoginController::class, 'resetPass'])->name('resetPass');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::get('/reset-success', [LoginController::class, 'successPage'])->name('successPage');
Route::get('password-reset' , [RegistrationController::class, 'resetPassword'])->name('resetPassword');
Route::get('/success-register', [LoginController::class, 'successRegister'])->name('successRegister');
Route::post('new-registration' , [RegistrationController::class, 'registration'])->name('newRegistration');
Route::post('forgot-pass' , [RegistrationController::class, 'forgotPass'])->name('forgotPass');
Route::post('reset-password' , [RegistrationController::class, 'resetPasswordPost'])->name('resetPasswordPost');

Route::get('/send-notification', function () {
    $user = User::find(41); // Replace with a valid user ID
    $user->notify(new BrowserNotification('This is a browser notification!'));
    return 'Notification sent!';
});

Route::get('/send-event', function () {
    $data = ['message' => 'Hello, this is a test message!'];
    event(new MyEvent($data));
    return 'Event sent to my-channel/my-event!';
});

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/send-message', [DashboardController::class, 'sendMessage'])->name('sendMessage');

Route::get('/signature_new', [ReportPdfController::class, 'signature_new'])->name('signature_new');
Route::get('/generate_pdf', [ReportPdfController::class, 'generatePDF'])->name('generatePDF');

Route::get('/notif', [MessageController::class, 'sendMessage'])->name('sendMessageNotif');

Route::post('/save-signature', [ReportPdfController::class, 'saveSignature']);

// Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->group(function () {
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
   
    Route::get('/jabatan', [UserController::class, 'index'])->name('list-jabatan');
    Route::get('/document', [DocumentController::class, 'index'])->name('document');
    Route::get('/laporan/{index}', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/surat/{index}', [SuratController::class, 'index'])->name('surat');
    

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post("/users/save" , [UserController::class, 'save'])->name('users-save');
    Route::post("/users/edit" , [UserController::class, 'edit'])->name('users-edit');

    Route::get('/unit-usaha', [UnitUsahaController::class, 'index'])->name('unit-usaha');
    Route::post('/usaha/add', [UnitUsahaController::class, 'usahaPost'])->name('addUsaha');
    Route::put('/usaha/edit', [UnitUsahaController::class, 'usahaEdit'])->name('editUsaha');
    Route::get('/detail-usaha/{index}', [UnitUsahaController::class, 'detailUsaha'])->name('detailUsaha');
    Route::post('/save-signature-new', [ReportPdfController::class, 'saveSignatureNew'])->name('saveSignatureNew');

    Route::post('/unit-usaha/pos-role-pengadaan', [UnitUsahaController::class, 'editPosPengadaan'])->name('editPosPengadaan');
    Route::post('/jabatan/add', [JabatanController::class, 'add'])->name('role_pengadaan_save');

    Route::post('/unit-usaha/pos-role-pembayaran', [UnitUsahaController::class, 'editPosPembayaran'])->name('editPosPembayaran');
    //Route::post("/users/save" , [UnitUsahaController::class, 'save'])->name('users-save');

    Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan');
    Route::get('/pengadaan/add', [PengadaanController::class, 'add'])->name('addPengadaan');
    Route::get('/detail-pengadaan/{index}', [PengadaanController::class, 'detailPengadaan'])->name('detailPengadaan');
    Route::post('postPengadaan/insert' , [PengadaanController::class, 'postPengadaan'])->name('postPengadaanNew');
    Route::post('postPersetujuan/insert' , [PengadaanController::class, 'postPersetujuan'])->name('postPersetujuanNew');
    Route::post('/approval-pengadaan', [PengadaanController::class, 'approvalDocument'])->name('approval-pengadaan');

    Route::post('/editAccessMenu' , [MenuController::class, 'crud'])->name('editAccessMenu');
    Route::get('/getAccessMenu' , [MenuController::class, 'get'])->name('getAccessMenu');

    Route::post('/addHolding', [JabatanController::class, 'saveJabatan'])->name('addHolding');
    Route::get('/holding', [JabatanController::class, 'viewHolding'])->name('viewHolding');
    //Route::put('/editHolding', [JabatanController::class, 'editHolding'])->name('editHolding');
    Route::put('/update-holding', [JabatanController::class, 'editUserHolding'])->name('update-holding');
    Route::post('/save-signature-holding', [JabatanController::class, 'saveSignatureHolding'])->name('saveSignatureHolding');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/jabatan/add', [SettingController::class, 'addPositions'])->name('settingsAddJabatan');
    Route::put('/settings/jabatan/edit', [SettingController::class, 'editPositions'])->name('settingsEditJabatan');

    Route::get('/petty_cash', [PettyCashController::class, 'index'])->name('petty_cash');
    Route::get('/petty_cash/add', [PettyCashController::class, 'add'])->name('addPettyCash');
    Route::post('/petty_cash/insert' , [PettyCashController::class, 'postPettyCash'])->name('postPettyCashNew');
    Route::get('/petty-cash/{index}', [PettyCashController::class, 'detailPettyCash'])->name('detailPettyCash');

    Route::get('/template_surat', [SettingController::class, 'index'])->name('template_surat');

    Route::get('/show-pengadaan-pdf/{index}', [ReportPdfController::class, 'showPDF'])->name('show-pengadaan-pdf');
    Route::get('/show-persetujuan-pdf/{index}', [ReportPdfController::class, 'showPersetujuanPDF'])->name('show-persetujuan-pdf');


    /* Api */
    Route::get('/api/jabatan' , [ApiJabatanController::class, 'index'])->name('api-jabatan');
    Route::get('/profile/edit' , [ProfileController::class, 'index'])->name('profile-edit');
    Route::put('/edit/profiles' , [ProfileController::class, 'editProfiles'])->name('editProfiles');
    Route::post('/save-signature-profile', [ProfileController::class, 'saveSignatureProfile'])->name('saveSignatureProfile');
    /* Api */

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/detailPembayaran/{index}', [PembayaranController::class, 'detailPembayaran'])->name('detailPembayaran');
    Route::post('/approval-pembayaran', [PembayaranController::class, 'approvalDocument'])->name('approval-pembayaran');
});
