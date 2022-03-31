<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class pic extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table='posts';
    protected $fillable = [
        'Author',
        'Title',
        'Description',
    ];

    public function author(){
        return $this->belongsTo(User::class, 'Author', 'name');
    }

}
