<?php

return [
    '' => ['HomeController', 'index',],
    'contact' => ['ContactController', 'index',],
    'tarifs' => ['TarifsController', 'index',],
    'index' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'login' => ['SecurityController', 'login',],
    'logout' => ['SecurityController', 'logout',],
    'admin/dashboard' => ['DashboardController', 'index',],
];
