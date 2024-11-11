<?php

//GET METHOD
Router::get('/', 'HomeController@index');
Router::get('/pemilik', 'HomeController@home');
Router::get('/login', 'LoginController@login');
Router::get('/register', 'LoginController@register');
Router::get('/id/{id}', 'LoginController@show');
Router::get('/profile', 'ProfileController@profile');
Router::get('/Kost', 'ProfileController@profileKost');
Router::get('/popular', 'HomeController@popular');
Router::get('/best', 'HomeController@best');
Router::get(uri: '/datakos', action: 'DataKosController@datakos');
Router::get(uri: '/fotokos', action: 'DataKosController@fotokos');
Router::get('/popular', 'DetailController@popularkos');
Router::get('/best', 'DetailController@bestkos');
Router::get('/campus', 'DetailController@strategically');
Router::get('/detailkos', 'DetailController@detailkos');
Router::get(uri: '/fasilitaskos', action: 'DataKosController@fasilitas');
Router::get(uri: '/harga', action: 'DataKosController@harga');
Router::get(uri: '/fotokamar', action: 'DataKosController@fotokmr');
Router::get(uri: '/alamatkos', action: 'DataKosController@alamat');
Router::get(uri: '/ketersediaanKamar', action: 'DataKosController@ke');
Router::get(uri: '/ketersediaanKamar2', action: 'DataKosController@ke2');
Router::get('/echo', 'HomeController@echo');
Router::get('/chats', 'ChatController@ch');
Router::get('/chat/user/{user_id}', 'ChatController@getChatByUserId');
Router::get('/konfirmasi', 'PembayaranController@konfirmasi');
Router::get('/getChat/{userId}', 'ChatController@get_chat');

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


Router::get('/out', 'LoginController@out');
