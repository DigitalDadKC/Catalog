<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricebook extends Model
{
    use HasFactory;
    protected $table = 'pricebooks';
    protected $primaryKey = 'id';
    protected $fillable = ['SKU', 'Name', 'fk_unit_size', 'Price', 'fk_status', 'Discountable', 'fk_category'];

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
        return $this->hasMany(MaterialUnitSize::class, 'id', 'fk_unit_size');
    }
    public function materialCategories()
    {
        return $this->hasMany(MaterialCategory::class, 'id', 'fk_category');
    }
    public function materialStatuses()
    {
        return $this->hasMany(MaterialStatus::class, 'id', 'fk_status');
    }
}