<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTradeCapacity extends Model
{
    use HasFactory;

    protected $table = 'vendor_product_trade_capacities';
    protected $guarded = [];
}
