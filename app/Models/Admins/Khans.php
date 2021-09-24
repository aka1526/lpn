<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
 
class Khans extends Model
{
    use   HasFactory ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "khan_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    public $table = 'khans';

    protected $fillable = [
        'khan_uid'
        , 'khan_index'
        , 'khan_group'
        , 'khan_name'
        , 'khan_desc'
        , 'khan_name_th'
        , 'khan_img'
        , 'khan_status'
        , 'created_at'
        , 'updated_at'

    ];

    
}
