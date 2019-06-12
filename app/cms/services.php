<?php

namespace App\cms;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
  protected $primaryKey = 'id';
  protected $fillable =['owner','type','title','image','description'];
  protected $hidden =['created_at','updated_at'];
}
