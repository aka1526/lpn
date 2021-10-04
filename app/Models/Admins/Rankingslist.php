<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rankingslist extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "list_uid";
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    public $table = 'rankingslist';

    protected $fillable = [
        'list_uid'
        , 'list_ref'
        , 'list_index'
        , 'contenders'
        , 'contenders_type'
        , 'won_title'
        , 'last_defense'
        , 'contenders_img'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'

    ];

     
}
