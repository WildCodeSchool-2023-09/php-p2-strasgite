<?php

return [
    '' => ['HomeController', 'index',],
    'coworking' => ['CoworkingController','index'],
    'contact' => ['ContactController', 'index',],
    'tarifs' => ['TarifsController', 'index',],
    'index' => ['HomeController', 'index',],
    'reservation' => ['ReservationController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'chambre/show' => ['RoomController', 'show', ['id']],
    'login' => ['SecurityController', 'login',],
    'signin' => ['SecurityController', 'signin',],
    'logout' => ['SecurityController', 'logout',],
    'admin/dashboard' => ['DashboardController', 'index',],
    'admin/Tarifs' => ['DashboardTarifsController', 'index',],
    'admin/Contact' => ['DashboardContactController', 'index',],
    'Contact/delete' => ['DashboardContactController', 'deleteMesssage',],
];
