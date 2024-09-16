<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    protected $fillable = [
        'catagory',
        'quantity',
        
    ];

}
