<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = "course_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'courses';

    protected $fillable = [
        'course_uid',
        'course_index',
        'course_name',
        'course_th',
        'course_description',
        'course_link',
        'course_img',
        'course_img2',
        'course_img3',
        'course_total',
        'course_status',
        'course_icon',
        'created_at',
        'update_at',
    
    ];
}

 