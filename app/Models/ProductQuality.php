<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuality extends Model
{
    use HasFactory;
    protected $table = 'vendor_product_quality_controllers';
    protected $guarded = [];
}
