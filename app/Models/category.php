<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'descrpion' , 'imgage' ];
    protected $table ="categories";

    public function user()
    {
//        if (!isset($this->user))
          return  $this->belongsTo(User::class);
//        dd($this->user);
//        return $this->user;
    }


}
