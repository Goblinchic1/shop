<?php

namespace Domain\Product\Models;

use App\Jobs\ProductJsonProperties;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\QueryBuilders\ProductQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Support\Casts\PriceCast;
use Support\Traits\Model\HasSlug;
use Support\Traits\Model\HasThumbnail;

/**
 * @method static Product|ProductQueryBuilder query()
 */
class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasSlug;
    use HasThumbnail;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'brand_id',
        'price',
        'thumbnail',
        'on_home_page',
        'sorting',
        'quantity',
        'text',
        'json_properties'
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile();
    }


    protected $casts = [
        'price' => PriceCast::class,
        'json_properties' => 'array'
    ];


    protected static function boot()
    {
        parent::boot();

        static::created(function (Product $product) {
            ProductJsonProperties::dispatch($product)->delay(now()->addSeconds(10));
        });
    }


    public function newEloquentBuilder($query): ProductQueryBuilder
    {
        return new ProductQueryBuilder($query);
    }


    protected function thumbnailDir(): string
    {
        return 'products';
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->withPivot('value');
    }


    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class);
    }


}
