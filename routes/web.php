<?php

//GET METHOD
Router::get('/', 'HomeController@index');
Router::get('/login', 'LoginController@login');
Router::get('/register', 'LoginController@register');
Router::get('/id/{id}', 'LoginController@show');
Router::get('/profile', 'ProfileController@profile');
Router::get('/Kost', 'ProfileController@profileKost');
Router::get('/popular', 'DetailController@popularkos');
Router::get('/best', 'DetailController@bestkos');
Router::get('/campus', 'DetailController@strategically');
Router::get('/detailkos', 'DetailController@detailkos');


//POST METHOD
Router::post('/login', 'LoginController@auth');


//APi
Router::get('/api/user/{id}', 'API@user');
