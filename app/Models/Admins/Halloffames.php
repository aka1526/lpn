<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halloffames extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "hof_uid";
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    public $table = 'halloffames';

    protected $fillable = [
        'hof_uid'
        , 'hof_index'
        , 'hof_title'
        , 'hof_date'
        , 'hof_img'
        , 'hof_content'
        , 'content_status'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'
    ];

     
}
