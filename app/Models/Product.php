<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'image'
    ];

    // relación con movimientos
    public function movements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
}
