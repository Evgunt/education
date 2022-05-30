<?php

use Src\Route;

Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add(['GET', 'POST'], '/lk', [Controller\Api::class, 'Personal']);
Route::add(['GET', 'POST'], '/order', [Controller\Api::class, 'orders']);

Route::add('GET', '/catalog', [Controller\Api::class, 'catalog']);
Route::add(['GET', 'POST'], '/item', [Controller\Api::class, 'itemAll']);
Route::add('POST', '/setCatalog', [Controller\Api::class, 'setCatalog']);
Route::add('POST', '/setItem', [Controller\Api::class, 'setItem']);

Route::add('POST', '/search', [Controller\Api::class, 'search']);
Route::add('GET', '/itemfilter', [Controller\Api::class, 'itemfilter']);

Route::add(['GET', 'POST'], '/lists', [Controller\Api::class, 'Lists']);





