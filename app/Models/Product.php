<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'sku', 'price', 'quantity', 'description', 'status'
    ];
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}