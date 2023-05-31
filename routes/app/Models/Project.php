<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function productdetail()
    {
        return $this->hasMany(ProductDetail::class);
    }
}
