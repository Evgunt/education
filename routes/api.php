<?php

use Src\Route;

Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add(['GET', 'POST'], '/lk', [Controller\Api::class, 'Personal']);
Route::add(['GET', 'POST'], '/order', [Controller\Api::class, 'orders']);
Route::add('POST', '/signup', [Controller\Api::class, 'signup']);

Route::add('GET', '/catalog', [Controller\Api::class, 'catalog']);
Route::add(['GET', 'POST'], '/item', [Controller\Api::class, 'itemAll']);
Route::add('POST', '/setCatalog', [Controller\Api::class, 'setCatalog']);
Route::add('POST', '/setItem', [Controller\Api::class, 'setItem']);
Route::add('POST', '/editCat', [Controller\Api::class, 'editCat']);
Route::add('POST', '/editItem', [Controller\Api::class, 'editItem']);
Route::add('GET', '/dellCats', [Controller\Api::class, 'dellCats']);
Route::add('GET', '/dellItems', [Controller\Api::class, 'dellItems']);

Route::add('POST', '/search', [Controller\Api::class, 'search']);
Route::add('GET', '/itemfilter', [Controller\Api::class, 'itemFilter']);

Route::add(['GET', 'POST'], '/lists', [Controller\Api::class, 'Lists']);
Route::add('POST', '/editList', [Controller\Api::class, 'editList']);
Route::add('GET', '/dellList', [Controller\Api::class, 'dellList']);

