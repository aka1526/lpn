<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slidepage extends Model
{
    use HasFactory;
    protected $primaryKey = "slidepages_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'slidepages';

    protected $fillable = [
        'slidepages_uid',
        'slidepages_index',
        'slidepages_headline',
        'slidepages_header',
        'slidepages_detail',
        'slidepages_link',
        'slidepages_img',
        'slidepages_status',
        'created_at',
        'update_at',

    ];
}
