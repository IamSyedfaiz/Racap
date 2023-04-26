<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function productdetail()
    {
        return $this->hasMany(ProductDetail::class);
    }
    public function uploadfile()
    {
        return $this->hasMany(UploadFile::class);
    }
}
