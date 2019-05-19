<?php

namespace App\cms;

use Illuminate\Database\Eloquent\Model;

class welcome extends Model
{
    protected $primaryKey = 'id';
    protected $fillable =['owner','content','images','type','selected'];
    protected $hidden =['created_at','updated_at'];
}
