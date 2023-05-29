<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialStatus extends Model
{
    use HasFactory;
    protected $table = 'material_statuses';
    protected $primaryKey = 'id';
    protected $fillable = ['Status'];
    public function pricebook()
    {
        return $this->belongsTo(Pricebook::class, 'id', 'fk_status')->withDefault(['Status' => '']);
    }
}