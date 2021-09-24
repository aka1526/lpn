<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $primaryKey = "country_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'country';

    protected $fillable = [
        'country_uid'
        , 'country_code'
        , 'country_code2'
        , 'country_name'
        , 'country_status'
        , 'created_at'
        , 'updated_at'
    
    ];
}

 