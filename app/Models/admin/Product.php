<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'content',
        'category_id',
        'status',
        'quantity',
    ];
    public $timestamps = false;

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function orders()
    {
        return $this->belongsToMany(Orders::class, 'order_product')->withPivot('quantity', 'price');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
