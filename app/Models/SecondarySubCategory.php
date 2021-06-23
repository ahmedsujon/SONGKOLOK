<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SecondarySubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    //status check
    public function scopeGetActive($query)
    {
        return $query->where('status', 1);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'secondary_sub_categories_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSecondarySubCategoryWithAdminOwner($query)
    {
        return $query->where('admin_id', Auth::guard('admin')->id());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeSecondarySubCategoryWithOutAdminOwner($query)
    {
        return $query->where('admin_id','!=' ,Auth::guard('admin')->id());
    }
}
