<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rankings extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "rank_uid";
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    public $table = 'rankings';

    protected $fillable = [
        'rank_uid'
        , 'rank_index'
        , 'rank_img'
        , 'rankings_weight'
        , 'rankings_weight_desc'
        , 'world_vacant'
        , 'world_won_title'
        , 'world_last_defense'
        , 'international_vacant'
        , 'international_won_title'
        , 'international_last_defense'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'

    ];

     
}
