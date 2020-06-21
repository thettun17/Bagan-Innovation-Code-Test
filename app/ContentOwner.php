<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentOwner extends Model
{
    protected $table = "content_owner";

   protected $fillable = ['name'];
}
