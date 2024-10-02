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
Router::get(uri:'/datakos', action:'DataKosController@index');
Router::get(uri:'/fotokos',action:'FotoKosController@index');


//POST METHOD
Router::post('/login', 'LoginController@auth');


//APi
Router::get('/api/user/{id}', 'API@user');
