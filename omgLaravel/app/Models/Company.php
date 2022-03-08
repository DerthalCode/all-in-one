<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Goods;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'vat', 'head', 'description', 'address', 'logo', 'user_id', 'category_id'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function goods() {
        return $this->hasMany(Goods::class);
    }
}
