<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tbl_UserModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table      = "tbl_user";
    protected $primarykey = "id";
}
