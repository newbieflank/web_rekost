<?php

//APi
Router::get('/api/data/{id}', 'UserController@user');
Router::post('/api/update','UserController@updateUser');
Router::post('/api/data', 'UserController@getProfile');
Router::post('/api/login', 'UserController@login');
Router::get('/api/imgProfile/{id}', 'UserController@getProfileImage');
Router::get('/api/kos', 'KosController@getKos');
Router::post('/api/upload', 'FileController@upload');
Router::get('/api/best', 'KosController@getKosBest');
Router::get('/api/terdekat', 'KosController@getKosTerdekat');
Router::post('/api/allkos', 'KosController@getAllKos');
Router::post('/api/register', 'UserController@register');
