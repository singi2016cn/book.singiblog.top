<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'BooksController@index');

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

Route::get('books/search','BooksController@search')->name('books.search');
Route::resource('books', 'BooksController');

Route::get('book_download_links/update_download_count/{id}/{type?}', 'BookDownloadLinksController@update_download_count');
Route::resource('book_download_links', 'BookDownloadLinksController');

Route::view('statement','web/statement');

Route::view('feedback','web/feedback');
Route::post('feedback','WebController@feedback');

Route::view('faq','web/faq');

Route::view('rights','web/rights');
Route::post('rights','WebController@rights');

Route::view('donate','web/donate');

Route::get('book_lists/search','BookListsController@search')->name('book_lists.search');
Route::resource('book_lists', 'BookListsController');

Route::get('sentences/search','SentencesController@search')->name('sentences.search');
Route::resource('sentences', 'SentencesController');

