<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCatalog extends Model
{
    use HasFactory;

    protected $primaryKey = "catalog_name";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'news_catalog';

    protected $fillable = [
        'catalog_uid'
        , 'catalog_index'
        , 'catalog_name'
        , 'catalog_status'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'
    
    ];
}

 