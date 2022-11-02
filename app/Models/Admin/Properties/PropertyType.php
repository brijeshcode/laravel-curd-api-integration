<?php

namespace App\Models\Admin\Properties;

use App\Models\Admin\Properties\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    protected $fillable = ['is_created_by_api', 'title', 'description'];

    protected $casts =[
        'is_created_by_api' => 'boolean'
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
