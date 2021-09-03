<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sysinfo extends Model
{
    use HasFactory;

    protected $primaryKey = "sys_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'sys_info';

    protected $fillable = [
        'sys_uid',
        'sys_name',
        'sys_name_th',
        'sys_address',
        'sys_email1',
        'sys_email2',
        'sys_phone1',
        'sys_phone2',
        'sys_openhour',
        'sys_facebook',
        'sys_twitter',
        'sys_youtube',
        'sys_intragram',

        'sys_googlemap_lat',
        'sys_googlemap_lon',
        'sys_googlemap_zoom',
        'sys_googlemap_info',
        'sys_googlemap_marker',

        'sys_status',
        'created_at',
        'updated_at',
    ];
}
