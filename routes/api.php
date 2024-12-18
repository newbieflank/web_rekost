<?php

//APi
Router::get('/api/data/{id}', 'UserController@user');
Router::post('/api/update', 'UserController@updateUser');
Router::post('/api/data', 'UserController@getProfile');
Router::post('/api/login', 'UserController@login');
Router::get('/api/imgProfile/{id}', 'UserController@getProfileImage');
Router::get('/api/kos', 'KosController@getKos');
Router::post('/api/upload', 'FileController@upload');
Router::get('/api/best', 'KosController@getKosBest');
Router::get('/api/terdekat', 'KosController@getKosTerdekat');
Router::post('/api/allkos', 'KosController@getAllKos');
Router::post('/api/register', 'UserController@register');
Router::get('/api/detail/{id}', 'KosController@getDetailKos');
Router::get('/api/getImageKos/{id}', 'KosController@getImageKos');
Router::post('/api/pembayaran', 'KosController@konfirmPembayaran');
Router::post('/api/updateFcmToken', 'UpdateFcmToken@update');
Router::post('/api/sendNotification', 'sendNotification@send');
Router::get('/api/Notifikasi/{id_user}', 'Notifikasi@getNotifikasi');
Router::get('/forgotPassword', 'LoginController@forgotPassword');
Router::get('/resetPassword', 'LoginController@resetPassword');

// chat route
Router::get('/api/chats/{id_sender}', 'ChatsController@listChats');
Router::get('/api/chats/{id_sender}/{id_receiver}', 'ChatsController@chatDetail');
Router::post('/api/chats/{id_sender}/{id_receiver}', 'ChatsController@sendMessage');
