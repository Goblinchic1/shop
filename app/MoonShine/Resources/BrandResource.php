<?php

namespace App\MoonShine\Resources;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Actions\ExportAction;
use Leeto\MoonShine\Fields\Image;
use Leeto\MoonShine\Fields\Number;
use Leeto\MoonShine\Fields\SwitchBoolean;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Filters\TextFilter;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;
use Leeto\MoonShine\Decorations\Block;
use Leeto\MoonShine\Actions\FiltersAction;

class BrandResource extends Resource
{
	public static string $model = Brand::class;

	public static string $title = 'Brands';

    public string $titleField = 'title';

	public function fields(): array
	{
		return [
		    Block::make('form-container', [
		        ID::make()->sortable(),

                Text::make('Title')
                    ->showOnExport(),

                Image::make('Thumbnail')
                    ->dir('images/brands')
                    ->withPrefix('/storage/'),

                SwitchBoolean::make('On home page'),

                Number::make('Sorting')
                    ->min(1)
                    ->max(999)
		    ])
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id', 'title'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('title')
        ];
    }

    public function actions(): array
    {
        return [
            ExportAction::make('Export'),
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
