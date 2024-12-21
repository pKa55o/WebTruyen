<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
|
*/
enum RouteName: string {
    case Chapter_create = 'chapter.create_chapter';
    case Chapter_list = 'chapter.list';
}

//user route
Route::get('/', [IndexController::class, 'index']) -> name('homepage');
Route::get('/truyeninfo/{truyen_id}', [IndexController::class, 'in4truyen']) -> name('infotruyen');
Route::get('/manga', [IndexController::class, 'manga']) -> name('manga');
Route::get('/manhwa', [IndexController::class, 'manhwa']) -> name('manhwa');
Route::get('/manhua', [IndexController::class, 'manhua']) -> name('manhua');
Route::get('/search', [IndexController::class, 'search']) -> name('search');
Route::get('/reading', [IndexController::class, 'giaodien3']) -> name('read');
//admin route
Route::middleware(['auth', 'admin'])->group(function () {
    //giao diện admin
    Route::get('/admin', [AdminController::class, 'home'])->name('admin.home');
    //giao diện thêm CRUD truyện
    Route::get('/admin/truyen', [TruyenController::class, 'index'])->name('truyen.index');
    Route::get('/admin/truyen/create', [TruyenController::class, 'create'])->name('truyen.create');
    Route::get('/admin/truyen/{id}/edit', [TruyenController::class, 'edit'])->name('truyen.edit');
    Route::delete('truyen/{id}', [TruyenController::class, 'destroy'])->name('truyen.destroy');

    //giao diện xử lí chapter
    Route::get('/admin/truyen/{truyen_id}/chapters/', [ChapterController::class, 'index'])->name('chapter.list');
    Route::get('/admin/truyen/{truyen_id}/chapters/create', [ChapterController::class, 'create'])->name('chapter.create_chapter');
    Route::post('/admin/truyen/{truyen_id}/chapters', [ChapterController::class, 'store'])->name('chapter.create_store');
    Route::get('/admin/truyen/{truyen_id}/chapters/{chapter_id}/edit', [ChapterController::class, 'edit'])
    ->name('chapter.edit');
    Route::put('/admin/truyen/{truyen_id}/chapters/{chapter_id}', [ChapterController::class, 'update'])
    ->name('chapter.chapter_update'); 
    Route::delete('/admin/truyen/{truyen_id}/chapters/{chapter_id}', [ChapterController::class, 'destroy'])->name('chapter.destroy');
    Route::get('/chapter/{chapter_id}/view', [ChapterController::class, 'show'])->name('chapter.show');

});

//login route
Auth::routes();
//??
Route::resource('/truyen', TruyenController::class);
Route::resource('/chapter', ChapterController::class);
Route::get('/home', [IndexController::class, 'index']) -> name('home');