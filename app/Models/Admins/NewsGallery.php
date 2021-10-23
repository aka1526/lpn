<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsGallery extends Model
{
    use HasFactory;

    protected $primaryKey = "gallery_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'newsgallery';

    protected $fillable = [
        'gallery_uid'
        , 'gallery_uid_ref'
        , 'gallery_filename'
        , 'gallery_url'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'
    
    ];
}

 