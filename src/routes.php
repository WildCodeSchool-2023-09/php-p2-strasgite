<?php

return [
    '' => ['HomeController', 'index',],
    'index' => ['HomeController', 'index',],
    'contact' => ['ContactController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'login' => ['SecurityController', 'login',],
    'logout' => ['SecurityController', 'logout',],
    'admin/dashboard' => ['DashboardController', 'index',],
    'tarifs' => ['TarifController', 'index',],
];
