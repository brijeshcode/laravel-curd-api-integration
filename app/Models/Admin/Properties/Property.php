<?php

namespace App\Models\Admin\Properties;

use App\Models\Admin\Properties\PropertyType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $fillable = ['is_created_by_api', 'property_type_id', 'county','country', 'postcode' ,'town', 'description', 'address', 'image_full', 'image_thumbnail', 'latitude',  'longitude', 'num_bedrooms', 'num_bathrooms', 'price', 'for'];

    protected $casts =[
        'is_created_by_api' => 'boolean'
    ];

    public function getImageThumbnailAttribute($value){
        if (isset($this->attributes['is_created_by_api']) && $this->attributes['is_created_by_api']) {
            return $value;
        }
        return url( $value);
    }

    public function getImageFullAttribute($value){
        if (isset($this->attributes['is_created_by_api']) && $this->attributes['is_created_by_api']) {
            return $value;
        }
        return url( $value);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
