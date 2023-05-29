<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialUnitSize extends Model
{
    use HasFactory;
    protected $table = 'material_unit_sizes';
    protected $primaryKey = 'id';
    protected $fillable = ['Unit_Size'];
    public function pricebook()
    {
        return $this->belongsTo(Pricebook::class, 'id', 'fk_unit_size');
    }
}