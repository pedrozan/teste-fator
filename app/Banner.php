<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'imageLocation'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'banners';
}
