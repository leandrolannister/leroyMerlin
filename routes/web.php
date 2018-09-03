<?php

Route::get('/', function () {
    return view('produto.form');
});

Route::get('produto/filter', "Produtos@filter");
Route::post('produto/upload', "Produtos@upload");
Route::post('produto/filtro', "Produtos@filtro");
Route::post('produto/delete', "Produtos@delete");
Route::get('produto/index', "Produtos@index");