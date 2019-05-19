<?php

namespace App\cms;

use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    protected $fillable = ['owner','content','images','type','selected'];

}
