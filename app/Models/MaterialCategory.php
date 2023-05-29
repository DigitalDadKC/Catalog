<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCategory extends Model
{
    use HasFactory;
    protected $table = 'material_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['Name'];
    public function pricebook()
    {
        return $this->belongsTo(Pricebook::class, 'id', 'fk_category');
    }
}