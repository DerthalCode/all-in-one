<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Goods extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'company_id'];

    public function company() {
        return $this->belongsTo(Company::class);
    }

}
