<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class WallpaperModel extends Model
{
    use SoftDeletes, HasMediaTrait;
    
    protected $connection = 'azure', $table = 'wallpapers', $primaryKey = 'ID';
    


    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
    protected $fillable = [];
    
    public function getCoverAttribute() 
    {
        return $this->getMedia('cover')->last();
    }
    
    public function registerMediaConversions(Media $media = null) 
    {
        $this->addMediaConversion('thumb')
                ->width(150)
                ->height(100);
        //parent::registerMediaConversions($media);
    }
    
}
