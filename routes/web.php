<?php

//GET METHOD
Router::get('/', 'HomeController@index');
Router::get('/login', 'LoginController@login');
Router::get('/register', 'LoginController@register');
Router::get('/id/{id}', 'LoginController@show');
Router::get('/profile', 'ProfileController@profile');
Router::get('/kost', 'ProfileController@profileKost');

//POST METHOD
Router::post('/login', 'LoginController@auth');


//APi
Router::get('/api/user/{id}', 'API@user');
