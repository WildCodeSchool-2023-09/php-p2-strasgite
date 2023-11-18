<?php

return [
    '' => ['HomeController', 'index',],
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
    'admin/Chambre' => ['DashboardChambreController', 'index',],
    'admin/Contact' => ['DashboardContactController', 'index',],
    'dashboard/chambre/new' => ['DashboardChambreController', 'new'],
    'dashboard/chambre/delete' => ['DashboardChambreController', 'deleteChambre', ['id']],
    'dashboard/chambre/edit' => ['DashboardChambreController', 'editChambre',  ['id']],
];
