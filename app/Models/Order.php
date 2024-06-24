<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    
}
