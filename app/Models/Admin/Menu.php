<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public static $menu = array(
        'dashboard' => array('name' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'fas fa-tachometer-alt'),
        'urls'      => array('name' => 'URLs', 'route' => 'admin.urls', 'icon' => 'fas fa-link'),
        'stats'     => array('name' => 'Statistics', 'route' => 'admin.stats', 'icon' => 'fas fa-chart-bar'),
        'contacts'  => array('name' => 'Contacts', 'route' => 'admin.contacts', 'icon' => 'fas fa-envelope'),
        'reports'   => array('name' => 'Reports', 'route' => 'admin.reports', 'icon' => 'fas fa-flag')
    );
}
