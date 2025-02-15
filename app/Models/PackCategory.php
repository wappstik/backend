<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }
}
