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
    public function productdetailCons()
    {
        return $this->hasMany(ProductDetail::class)->where('type', 'CO');
    }
    public function productdetailClient()
    {
        return $this->hasMany(ProductDetail::class)->where('type', 'CL');
    }
    public function uploadfile()
    {
        return $this->hasMany(UploadFile::class);
    }
    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
    public function account()
    {
        return $this->hasMany(Account::class);
    }
    public function project_report()
    {
        return $this->hasMany(ProgressReport::class);
    }
    public function conversation()
    {
        return $this->hasMany(Conversation::class);
    }
    public function response()
    {
        return $this->hasMany(Response::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function historygetting()
    {
        return $this->hasMany(HistoryGetting::class);
    }
}
