<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SlideTranslation extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function slide()
    {
        return $this->belongsTo(Slide::class);
    }
}
