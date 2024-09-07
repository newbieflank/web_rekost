<?php

Router::get('/', 'HomeController@index');
Router::get('/login', 'LoginController@login');
Router::get('/login', 'LoginController@register');
