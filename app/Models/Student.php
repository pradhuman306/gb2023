<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
      'student_id','scholar_no','name','dob','father_name','mother_name','address','aadhar_no','samarg_id','mobile_no','mobile_no2','account_no',
       'profile_picture',
      ];
}
