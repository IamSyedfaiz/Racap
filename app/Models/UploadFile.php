<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class UploadFile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deleBY()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
