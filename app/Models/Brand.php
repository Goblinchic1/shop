<?php

namespace App\Models;

use App\Traits\Model\HasSlug;
use App\Traits\Model\HasThumbnail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 *
 * @method Builder|static homePage()
 */
class Brand extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    protected $fillable = [
        'slug',
        'title',
        'thumbnail',
        'on_home_page',
        'sorting'
    ];


    protected function thumbnailDir(): string
    {
        return 'brands';
    }


    public function scopeHomePage(Builder $query)
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
