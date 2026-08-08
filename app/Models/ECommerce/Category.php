<?php

namespace App\Models\ECommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'ecom_categories';
    protected $fillable = ['name'];

    public static function sortable(): array { return ['id', 'name']; }
}
