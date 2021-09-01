<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseItem extends Model
{
    use HasFactory;

    protected $primaryKey = "course_item_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'courses_item';

    protected $fillable = [
      'course_item_uid',
       'course_item_index',
        'course_item_name',
        'Course_details',
        'Course_vdo_link',
        'course_item_status',
        'courseref_uid',
        'courseref_name',
        'course_item_icon',
        'course_item_img',
       'created_at',
       'update_at',
    
    ];
}
 