<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpressWish extends Model
{
    use HasFactory;

    protected $table = 'express_wish';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
