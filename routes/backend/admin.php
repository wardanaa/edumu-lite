<?php

use App\Http\Controllers\Backend\ContentController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EbookController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\ContentCategoryController;
use App\Http\Controllers\Backend\CustomerController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Route::get('show/{role}', [DashboardController::class, 'show'])->name('dashboard.show');

//content
Route::get('content', [ContentController::class, 'index'])->name('content');
Route::get('content/contentjson',[ContentController::class, 'json'])->name('contentjson');
Route::get('show/{content}', [ContentController::class, 'show'])->name('content.show');
Route::get('delete/{content}', [ContentController::class, 'delete'])->name('content.delete');

//ebook
Route::get('ebook', [EbookController::class, 'index'])->name('ebook');
Route::get('ebook/ebookjson',[EbookController::class, 'json'])->name('ebookjson');
Route::get('shows/{role}', [EbookController::class, 'show'])->name('ebook.shows');
Route::get('created_ebook', [EbookController::class, 'create'])->name('ebook.created_ebook');
Route::post('create_post_ebook', [EbookController::class, 'create_data'])->name('ebook.create_post_ebook');
Route::get('get_ebook_id/{role}', [EbookController::class, 'get_by_id'])->name('ebook.get_ebook_id');
Route::patch('editpostebook/{id}', [EbookController::class, 'update'])->name('ebook.editpostebook');
Route::get('delete_ebook/{role}', [EbookController::class, 'delete'])->name('ebook.delete_ebook');

//newsebookjson

Route::get('news', [NewsController::class, 'index'])->name('news');
Route::get('news/json',[NewsController::class, 'json'])->name('json');
Route::get('look/{role}', [NewsController::class, 'show'])->name('news.look');
Route::get('create', [NewsController::class, 'create'])->name('news.create');
Route::post('create_post', [NewsController::class, 'create_data'])->name('news.create_post');
Route::get('getid/{role}', [NewsController::class, 'get_by_id'])->name('news.getid');
Route::patch('editpost/{id}', [NewsController::class, 'update'])->name('news.editpost');
Route::get('deleted/{role}', [NewsController::class, 'delete'])->name('news.deleted');

//category
Route::get('category', [ContentCategoryController::class, 'index'])->name('category');
Route::get('category/categoryjson',[ContentCategoryController::class, 'json'])->name('categoryjson');
Route::get('showcategory/{role}', [ContentCategoryController::class, 'show'])->name('category.showcategory');
Route::get('created', [ContentCategoryController::class, 'create'])->name('category.created');
Route::post('create_post_category', [ContentCategoryController::class, 'create_data'])->name('category.create_post_category');
Route::get('getcategoryid/{role}', [ContentCategoryController::class, 'get_by_id'])->name('category.getcategoryid');
Route::patch('editcategorypost/{id}', [ContentCategoryController::class, 'update'])->name('category.editcategorypost');
Route::get('delete_contentcategory/{role}', [ContentCategoryController::class, 'delete'])->name('category.delete_contentcategory');

//customer
Route::get('customer', [CustomerController::class, 'index'])->name('customer');
Route::get('customer/customerjson',[CustomerController::class, 'json'])->name('customerjson');
Route::get('showcustomer/{role}', [CustomerController::class, 'show'])->name('customer.showcustomer');
Route::get('created_customer', [CustomerController::class, 'create'])->name('customer.created_customer');
Route::post('create_post_customer', [CustomerController::class, 'create_data'])->name('customer.create_post_customer');
Route::get('get_customer_id/{role}', [CustomerController::class, 'get_by_id'])->name('customer.get_customer_id');
Route::patch('editcustomerpost/{id}', [CustomerController::class, 'update'])->name('customer.editcustomerpost');
Route::get('delete_customer/{role}', [CustomerController::class, 'delete'])->name('customer.delete_customer');
