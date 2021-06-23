<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFactoryInspection extends Model
{
    use HasFactory;

    protected $table = 'vendor_product_factory_inspection_reports';
    protected $guarded = [];
}
