<?php 
// , 'middleware' => 'auth.basic'
$path = config('laravelbackend.path');

Route::group(['middleware' => ['web']], function () use ($path) {

    Route::group(['namespace' => 'Helveden\LBE\Http\Controllers', 'prefix' => $path], function () use ($path) {

        Route::resource('/', 'BackController', [
                'only'  => [
                    'index',
                ],
                'names' => [
                    'index'  => $path,
                ],
            ]
        );

        Route::resource('/menu', 'MenuController', [
                'only'  => [
                    'index',
                    'create',
                    'edit',
                    'store',
                    'show',
                    'update',
                    'destroy',
                ],
                'names' => [
                    'index' => 'menu',
                    'create' => 'menu.create',
                    'edit' => 'menu.edit',
                    'store' => 'menu.store',
                    'show' => 'menu.show',
                    'update' => 'menu.update',
                    'destroy' => 'menu.destroy',
                ],
            ]
        );

        Route::get('/menu/{id}/item/edit', 'MenuController@itemEdit')->name('menu.item.edit');
        Route::post('/menu/{id}/item/store', 'MenuController@itemStore')->name('menu.item.store');
        Route::post('/menu/{id}/item/update', 'MenuController@itemUpdate')->name('menu.item.update');

        Route::resource('/entity/{class}/{id}', 'EntityController', [
                'only' => [
                    'index'
                ],
                'names' => [
                    'index' => 'entity',
                ],  
            ]
        );

        Route::group(['prefix' => 'database'], function () {

            Route::resource('', 'DatabaseController', [
                'only'  => [
                    'index',
                ],
                'names' => [
                    'index' => 'database',
                ],
            ]);

            Route::resource('table', 'TableController', [
                'only'  => [
                    'index',
                    'show',
                    'update',
                    'createTable',
                    'deleteTable',
                    'deleteModel',
                    'newColumn',
                    'updateColumn',
                    'addTimestamps',
                    'addToken',
                    'deleteColumn',
                    'createModel',
                    'updateModel',
                ],
                'names' => [
                    'index'              => 'table',
                    'show'               => 'table_show',
                    'update'             => 'table_update',
                    'createTable'        => 'table_createTable',
                    'deleteTable'        => 'table_deleteTable',
                    'newColumn'          => 'table_newColumn',
                    'updateColumn'       => 'table_updateColumn',
                    'addTimestamps'      => 'table_addTimestamps',
                    'addToken'           => 'table_addToken',
                    'deleteColumn'       => 'table_deleteColumn',
                    'createModel'        => 'table_createModel',
                    'updateModel'        => 'table_updateModel',
                    'deleteModel'        => 'table_deleteModel',
                ],
            ]);

            Route::post('table/createTable', 'TableController@createTable')->name('table_createTable');
            Route::get('table/{table}/deleteTable', 'TableController@deleteTable')->name('table_deleteTable');
            Route::get('table/{table}/deleteModel', 'TableController@deleteModel')->name('table_deleteModel');
            Route::post('table/{table}/newColumn', 'TableController@newColumn')->name('table_newColumn');
            Route::post('table/{table}/updateColumn', 'TableController@updateColumn')->name('table_updateColumn');
            Route::get('table/{table}/addTimestamps', 'TableController@addTimestamps')->name('table_addTimestamps');
            Route::get('table/{table}/addToken', 'TableController@addToken')->name('table_addToken');
            Route::get('table/{table}/deleteColumn/{column}', 'TableController@deleteColumn')->name('table_deleteColumn');

            Route::get('table/{model}/createModel', 'TableController@createModel')->name('table_createModel');
            Route::get('table/{model}/updateModel', 'TableController@updateModel')->name('table_updateModel');
            Route::post('table/{model}/updateModel', 'TableController@updateModel')->name('table_updateModel');

            Route::resource('relation', 'RelationController', [
                'only'  => [
                    'index',
                    'show',
                    'create',
                    'store',
                    'update',
                    'destroy',
                ],
                'names' => [
                    'index' => 'relation',
                    'create' => 'relation.create',
                    'edit' => 'relation.edit',
                    'store' => 'relation.store',
                    'show' => 'relation.show',
                    'update' => 'relation.update',
                    'destroy' => 'relation.destroy',
                ],
            ]);
        
        });

    });
});