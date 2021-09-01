<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Adminmenus extends Model
{
    
    use   HasFactory, Notifiable;
 
    protected $primaryKey = "menu_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'admin_menus';

    protected $fillable = [
        'menu_uid', 
        'menu_name','menu_name_th', 'menu_url', 'menu_route', 
        'menu_icon', 'menu_class', 'menu_index', 
        'menu_main','menu_main_name', 'created_at','menu_status'
    
    ];


}

