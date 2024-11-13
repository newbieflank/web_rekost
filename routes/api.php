<?php

//APi
Router::get('/api/user/{id}', 'UserController@user');
Router::post('/api/data', 'UserController@getProfile');
Router::post('/api/login', 'UserController@login');
Router::get('/api/imgProfile/{id}', 'UserController@getProfileImage');
