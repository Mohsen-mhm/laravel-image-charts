<?php

namespace MohsenMhm\LaravelImageCharts\Facades;

use Illuminate\Support\Facades\Facade;
use MohsenMhm\LaravelImageCharts\ImageChart;

class ImageChartFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ImageChart::class;
    }
}
