<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Division;
use App\Models\Emi;
use App\Models\Event;
use App\Models\EventProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Reply;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use App\Models\SubCity;
use App\Models\User;
use App\Models\Comment;
use Database\Factories\SecondarySubCategoryFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(3)->create();
        // Brand::factory(10)->create();
        // Category::factory(7)->create();
        // Coupon::factory(5)->create();
        // SubCategory::factory(15)->create();
        // SecondarySubCategory::factory(28)->create();
        // Product::factory(40)->create();
        // User::factory(10)->create();
        // ProductImage::factory(50)->create();
        // Blog::factory(10)->create();
        // Comment::factory(15)->create();
        // Reply::factory(15)->create();
        // Emi::factory(10)->create();
        // Division::factory(5)->create();
        // District::factory(20)->create();
        // City::factory(50)->create();
        // SubCity::factory(70)->create();
        // Event::factory(3)->create();
        // EventProduct::factory(10)->create();
    }
}
