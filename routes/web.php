<?php

//GET METHOD
Router::get('/', 'HomeController@index');
Router::get('/login', 'LoginController@login');
Router::get('/register', 'LoginController@register');
Router::get('/id/{id}', 'LoginController@show');
Router::get('/profile', 'ProfileController@profile');
Router::get('/Kost', 'ProfileController@profileKost');
Router::get('/popular', 'HomeController@popular');
Router::get('/best', 'HomeController@best');
Router::get('/popular', 'DetailController@popularkos');
Router::get('/best', 'DetailController@bestkos');
Router::get('/campus', 'DetailController@strategically');
Router::get('/detailkos/{id}', 'DetailController@detailkos');
Router::get(uri: '/datakos', action: 'DataKosController@datakos');
Router::get(uri: '/datakamar', action: 'DataKosController@fasilitas');
Router::get('/echo', 'HomeController@echo');
Router::get('/chats', 'ChatController@chats');
Router::get('/chat/user/{user_id}', 'ChatController@getChatByUserId');
Router::get('/konfirmasi', 'PembayaranController@konfirmasi');
Router::get('/verif', 'HomeController@verif');
Router::get('/getchat/{userId}', 'ChatController@get_chat');


//admin
Router::get('/dashboard', 'AdminController@dashboard');
Router::get('/acceptance', 'AdminController@acceptance');
Router::get('/peencarikos', 'AdminController@pencarikos');
Router::get('/pemilikkos', 'AdminController@pemilikkos');

//login Google
Router::get('/auth', 'AuthController@login');
Router::get('/auth/callback', 'AuthController@callback');
Router::get('/create', 'AuthController@register');

//logout
Router::get('/logout', 'LoginController@logout');


//POST METHOD
Router::post('/login', 'LoginController@auth');
Router::post('/register', 'LoginController@create');
Router::post('/create', 'LoginController@Google');
Router::post('/profile/update', 'ProfileController@update');
Router::post('/upImg', 'FileController@upload');
Router::post('/datakos/tambah', 'DataKosController@tambah');
Router::post('/fasilitaskos/tambah', 'DataKosController@tambahFasilitas');
Router::post('/alamatkos/tambah', 'DataKosController@tambahAlamat');
Router::post('/harga/tambah', 'DataKosController@tambahHarga');
Router::post('/addulasan','HomeController@AddUlasan');
Router::post('/verif', 'FileController@lampiran');
Router::post('/sendchat/{incomingUserId}', 'ChatController@sendMessage');

Router::get('/out', 'LoginController@out');
