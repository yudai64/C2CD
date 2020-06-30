<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'image', 'price', 'amount', 'describe', 'user_id', 'category_id','status_id'
    ];

    public function user(): BelongsTo
{
    return $this->belongsTo('App\User');
}
}
