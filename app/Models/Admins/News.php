<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $primaryKey = "news_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'news';

    protected $fillable = [
        'news_uid',
        'news_index',
        'news_group',
        'news_location', 
        'news_toppic',
        'news_desc',
        'news_url',
        'news_img',
        'news_status',
        'news_icon', 
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    
    ];
}

 