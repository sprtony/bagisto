<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Route::prefix(config('app.admin_url'))->group(function () {
        Route::group(['middleware' => ['admin']], function () {
            Route::prefix('blog')->group(function () {
                Route::prefix('categories')->group(function () {
                    Route::get('/', 'Quimaira\Blog\Http\Controllers\BlogCategoryController@index')
                        ->defaults('_config', [
                            'view' => 'blog::admin.blog.categories.index',
                        ])
                        ->name('admin.blog.categories.index');

                    Route::get('create', 'Quimaira\Blog\Http\Controllers\BlogCategoryController@create')
                        ->defaults('_config', [
                            'view' => 'blog::admin.blog.categories.create',
                        ])
                        ->name('admin.blog.categories.create');

                    Route::post('create', 'Quimaira\Blog\Http\Controllers\BlogCategoryController@store')
                        ->defaults('_config', [
                            'redirect' => 'admin.blog.categories.index',
                        ])
                        ->name('admin.blog.categories.store');

                    Route::get('edit/{id}', 'Quimaira\Blog\Http\Controllers\BlogCategoryController@edit')
                        ->defaults('_config', [
                            'view' => 'blog::admin.blog.categories.edit',
                        ])
                        ->name('admin.blog.categories.edit');

                    Route::put('edit/{id}', 'Quimaira\Blog\Http\Controllers\BlogCategoryController@update')
                        ->defaults('_config', [
                            'redirect' => 'admin.blog.categories.index',
                        ])
                        ->name('admin.blog.categories.update');

                    Route::post('delete/{id}', 'Quimaira\Blog\Http\Controllers\BlogCategoryController@destroy')
                        ->name('admin.blog.categories.delete');
                });
            });

            Route::prefix('posts')->group(function () {
                Route::get('/', 'Quimaira\Blog\Http\Controllers\BlogPostController@index')
                    ->defaults('_config', [
                        'view' => 'blog::admin.blog.posts.index',
                    ])
                    ->name('admin.blog.posts.index');

                Route::get('create', 'Quimaira\Blog\Http\Controllers\BlogPostController@create')
                    ->defaults('_config', [
                        'view' => 'blog::admin.blog.posts.create',
                    ])
                    ->name('admin.blog.posts.create');

                Route::post('create', 'Quimaira\Blog\Http\Controllers\BlogPostController@store')
                    ->defaults('_config', [
                        'redirect' => 'admin.blog.posts.index',
                    ])
                    ->name('admin.blog.posts.store');

                Route::get('edit/{id}', 'Quimaira\Blog\Http\Controllers\BlogPostController@edit')
                    ->defaults('_config', [
                        'view' => 'blog::admin.blog.posts.edit',
                    ])
                    ->name('admin.blog.posts.edit');

                Route::put('edit/{id}', 'Quimaira\Blog\Http\Controllers\BlogPostController@update')
                    ->defaults('_config', [
                        'redirect' => 'admin.blog.posts.index',
                    ])
                    ->name('admin.blog.posts.update');

                Route::post('delete/{id}', 'Quimaira\Blog\Http\Controllers\BlogPostController@destroy')
                    ->name('admin.blog.posts.delete');
            });
        });
    });
});
