<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
         'name', 'slug', 'description', 'quantity',
        'price', 'sale_price',  'cate_id', 'pro_image'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProducts::class, 'cate_id');
    }
}
