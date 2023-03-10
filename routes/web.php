<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Admin\Main\AdminController;

use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\Post\PostController;

use App\Http\Controllers\Admin\Category\CreateController as CreateCategory;
use App\Http\Controllers\Admin\Tag\CreateController as CreateTag;
use App\Http\Controllers\Admin\Post\CreateController as CreatePost;

use App\Http\Controllers\Admin\Category\ShowController as ShowCategory;
use App\Http\Controllers\Admin\Tag\ShowController as ShowTag;
use App\Http\Controllers\Admin\Post\ShowController as ShowPost;

use App\Http\Controllers\Admin\Category\StoreController as StoreCategory;
use App\Http\Controllers\Admin\Tag\StoreController as StoreTag;
use App\Http\Controllers\Admin\Post\StoreController as StorePost;

use App\Http\Controllers\Admin\Category\EditController as EditCategory;
use App\Http\Controllers\Admin\Tag\EditController as EditTag;
use App\Http\Controllers\Admin\Post\EditController as EditPost;

use App\Http\Controllers\Admin\Category\UpdateController as UpdateCategory;
use App\Http\Controllers\Admin\Tag\UpdateController as UpdateTag;
use App\Http\Controllers\Admin\Post\UpdateController as UpdatePost;

use App\Http\Controllers\Admin\Category\DeleteController as DeleteCategory;
use App\Http\Controllers\Admin\Tag\DeleteController as DeleteTag;
use App\Http\Controllers\Admin\Post\DeleteController as DeletePost;




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

Route::group(['namespace' => 'App\Http\Controllers\Main'], function (){
    Route::get('/', IndexController::class);
});

Route::group(['namespace' => 'App\Http\Controllers\Admin','prefix' => 'admin'], function (){
    Route::group(['namespace' => 'Main'], function (){
        Route::get('/', AdminController::class);
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function (){
        Route::get('/', PostController::class)->name('admin.post.index');
        Route::get('/create', CreatePost::class)->name('admin.post.create');
        Route::post('/', StorePost::class)->name('admin.post.store');
        Route::get('/{post}', ShowPost::class)->name('admin.post.show');
        Route::get('/{post}/edit', EditPost::class)->name('admin.post.edit');
        Route::patch('/{post}', UpdatePost::class)->name('admin.post.update');
        Route::delete('/{post}', DeletePost::class)->name('admin.post.delete');
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function (){
        Route::get('/', CategoryController::class)->name('admin.category.index');
        Route::get('/create', CreateCategory::class)->name('admin.category.create');
        Route::post('/', StoreCategory::class)->name('admin.category.store');
        Route::get('/{category}', ShowCategory::class)->name('admin.category.show');
        Route::get('/{category}/edit', EditCategory::class)->name('admin.category.edit');
        Route::patch('/{category}', UpdateCategory::class)->name('admin.category.update');
        Route::delete('/{category}', DeleteCategory::class)->name('admin.category.delete');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function (){
        Route::get('/', TagController::class)->name('admin.tag.index');
        Route::get('/create', CreateTag::class)->name('admin.tag.create');
        Route::post('/', StoreTag::class)->name('admin.tag.store');
        Route::get('/{tag}', ShowTag::class)->name('admin.tag.show');
        Route::get('/{tag}/edit', EditTag::class)->name('admin.tag.edit');
        Route::patch('/{tag}', UpdateTag::class)->name('admin.tag.update');
        Route::delete('/{tag}', DeleteTag::class)->name('admin.tag.delete');
    });
});

Auth::routes();
