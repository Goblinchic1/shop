<?php

namespace App\Models;

use App\Traits\Model\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'slug'
    ];


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
