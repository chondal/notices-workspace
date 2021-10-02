<?php

// probando subir cambio

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Intranet', 'prefix' => config('notices-workspace.prefix.admin'), 'middleware' => 'web'], function () {
    Route::namespace('\Chondal\NoticesWorkspace\Http\Controllers')->group(function(){
        Route::get(NoticeWorkspace::route(), 'NoticesController@index')->name('noticesWorkspace.index');
        Route::get(NoticeWorkspace::route().'/crear', 'NoticesController@create')->name('noticesWorkspace.create');
        Route::get(NoticeWorkspace::route().'/edit/{alerta}', 'NoticesController@edit')->name('noticesWorkspace.edit');
        Route::post(NoticeWorkspace::route().'/store', 'NoticesController@store')->name('noticesWorkspace.store');
        Route::put(NoticeWorkspace::route().'/update/{alerta}', 'NoticesController@update')->name('noticesWorkspace.update');
        Route::delete(NoticeWorkspace::route().'/destroy/{alerta}', 'NoticesController@destroy')->name('noticesWorkspace.destroy');
    
    });
});





