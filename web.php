<?php

use App\Http\Controllers\ImportItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

// หน้า import add
Route::get('/import', [ImportItemController::class, 'index'])->name('import'); 
Route::get('/check-refcode', [ImportItemController::class, 'checkRefcode'])->name('check.refcode');
Route::get('/check-import', [ImportItemController::class, 'checkImport_add'])->name('check.import');
Route::get('/import', [ImportItemController::class, 'material'])->name('import_get');

// กด import add
Route::post('/importadd',[ImportItemController::class,'additem'])->name('importadd');
Route::get('/importadd',[ImportItemController::class,'additem'])->name('importadd');

//หน้า Refcode
Route::post('/addrefcode',[ImportItemController::class,'import_refcode'])->name('addrefcode');
Route::get('/addrefcode',[ImportItemController::class,'import_refcode'])->name('addrefcode');

Route::post('/saveadd',[ImportItemController::class,'saveAdd'])->name('saveadd');
Route::get('/saveadd',[ImportItemController::class,'saveAdd'])->name('saveadd');

//หน้า Material
Route::get('/material',[ImportItemController::class,'import_material'])->name('material');
Route::post('/material',[ImportItemController::class,'import_material'])->name('material');

Route::get('/savematerial',[ImportItemController::class, 'savematerial'])->name('savematerial');
Route::post('/savematerial',[ImportItemController::class, 'savematerial'])->name('savematerial');

//Droppoint
Route::get('/droppoint', [ImportItemController::class, 'droppoint'])->name('droppoint');
//add
Route::get('/Adddroppoint', [ImportItemController::class, 'addDroppoint'])->name('Adddroppoint');
Route::post('/Adddroppoint', [ImportItemController::class, 'addDroppoint'])->name('Adddroppoint');
//import
Route::post('/droppoint', [ImportItemController::class, 'import_droppoint'])->name('droppoint');
Route::get('/droppoint',[ImportItemController::class, 'import_droppoint'])->name('droppoint');
//save
Route::get('/savedroppoint',[ImportItemController::class, 'savedroppoint'])->name('savematerial');
Route::post('/savedroppoint',[ImportItemController::class, 'savedroppoint'])->name('savematerial');

//withdraw
Route::get('/withdraw', [ImportItemController::class, 'withdraw'])->name('withdraw');

Route::post('/withdrawAdd', [ImportItemController::class, 'addWithdraw'])->name('withdrawAdd');

//SUM
Route::get('/sum',[ImportItemController::class,'summary'])->name('sum');

// routes/web.php API
Route::get('/droppoint/search', [ImportItemController::class, 'search']);


// EDIT_ import_item
// เส้นทางเพื่อดึงข้อมูลสำหรับการแก้ไข
Route::get('/edit/{id}', [ImportItemController::class, 'edit'])->name('edit_import');
Route::post('/edit/save', [ImportItemController::class, 'saveEdit'])->name('save_edit_import');

// EDIT_ withdraw
Route::get('/edit/withdraw/{id}',[ImportItemController::class, 'editWithdraw'])->name('edit_witdraw');
Route::post('/edit/save/withdraw',[ImportItemController::class, 'saveEditWithdraw'])->name('save_edit_withdraw');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
