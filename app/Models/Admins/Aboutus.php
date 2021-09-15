<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    use HasFactory;

    protected $primaryKey = "aboutus_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'aboutus';

    protected $fillable = [
        'aboutus_uid', 
        'aboutus_index', 
        'aboutus_name', 
        'aboutus_header', 
        'aboutus_desc', 
        'aboutus_url', 
        'aboutus_img', 
        'aboutus_status', 
        'aboutus_icon', 
        'created_at', 
        'updated_at'
    
    ];
}

 