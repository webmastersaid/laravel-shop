<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{

    const CATEGORIES = 'categories';
    const COLORS = 'colors';
    const PRICE = 'price';
    const TAGS = 'tags';

    protected function getCallbacks(): array
    {
        return [
            self::CATEGORIES => [$this, 'categories'],
            self::COLORS => [$this, 'colors'],
            self::PRICE => [$this, 'price'],
            self::TAGS => [$this, 'tags']
        ];
    }

    public function categories(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }

    public function colors(Builder $builder, $value)
    {
        $builder->whereIn('color_id', $value);
    }

    public function price(Builder $builder, $value)
    {
        $builder->whereBetween($value['from'], $value['to']);
    }

    public function tags(Builder $builder, $value)
    {
        $builder->whereHas('tags', function ($b) use ($value) {
            $b->whereIn('tag_id', $value);
        });
    }
}
