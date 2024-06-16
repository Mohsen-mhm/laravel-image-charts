<?php

namespace MohsenMhm\LaravelImageCharts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self setData(array $data)
 * @method static self setLabels(array $labels)
 * @method static self setBackgroundColor(string $color)
 * @method static self setDatasetBackgroundColor(string $color)
 * @method static self setDatasetBorderColor(string $color)
 * @method static self setWidth(string $width)
 * @method static self setHeight(string $height)
 * @method static self setTitleText(string $title)
 * @method static string getUrl()
 * @method static string getImage(string $path = null)
 * @method static string getBinary()
 *
 * @see \MohsenMhm\LaravelImageCharts\ImageChart
 */
class ImageChartFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ImageChart';
    }
}
