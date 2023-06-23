<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricebook extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;

    protected $table = 'pricebooks';
    protected $primaryKey = 'id';

    public function scopeSearchFilter($query, $search)
    {
        if ($search ?? false) {
            $query->where('Name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('SKU', 'LIKE', '%' . request('search') . '%');
        }
    }

    public function scopeCategoryFilter($query, $categories = [])
    {
        if ($categories ?? false) {
            $query->whereIn('fk_category', request('filter-checkbox'));
        }
    }
    public function materialUnitSizes()
    {
        return $this->belongsTo(MaterialUnitSize::class, 'fk_unit_size', 'id');
    }
    public function materialCategories()
    {
        return $this->belongsTo(MaterialCategory::class, 'fk_category', 'id');
    }
}