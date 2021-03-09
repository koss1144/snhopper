<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    public $guarded = [];

    public $timestamps = false;


    public static function search($search)
    {
        return empty($search) ?
            static::query()
            : static::where('country', 'like', '%' . $search . '%')
                ->orWhere('county', 'like', '%' . $search . '%')
                ->orWhere('town', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('p_title', 'like', '%' . $search . '%');
    }

    public static function thumbnailUrl($url)
    {
        if(Str::contains($url, 'http'))
            return $url;

        return Storage::disk('properties')->url($url);
    }
}
