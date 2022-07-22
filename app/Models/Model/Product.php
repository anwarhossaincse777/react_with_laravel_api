<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='products';
    protected $fillable=[

        'image',
        'category_id',
        'slug',
        'name',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'selling_price',
        'original_price',
        'qty',
        'brand',
        'feature',
        'popular',
        'status',

    ];



    protected $with=['category'];
    public function category(){


        return $this->belongsTo(Category::class,'category_id','id');
    }

}
