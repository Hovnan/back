<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $fillable = [
        'content', 'coords', 'visited',
    ];

    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function getCoordsAttribute($coords)
    {
        return $coords ? json_decode($coords, true) : [];
    }
    public function setCoordsAttribute(array $coords)
    {
        $this->attributes['coords'] = $coords ? json_encode($coords) : '';
    }
}
