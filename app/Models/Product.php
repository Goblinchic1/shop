<?php

namespace App\Models;

use App\Traits\Model\HasSlug;
use App\Traits\Model\HasThumbnail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 *
 * @method Builder|static homePage()
 */
class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    protected $fillable = [
        'title',
        'slug',
        'brand_id',
        'price',
        'thumbnail',
        'on_home_page',
        'sorting'
    ];


    protected function thumbnailDir(): string
    {
        return 'products';
    }


    public function scopeHomePage(Builder $query)
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


}
