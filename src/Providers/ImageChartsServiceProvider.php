<?php

namespace MohsenMhm\LaravelImageCharts\Providers;

use Illuminate\Support\ServiceProvider;
use MohsenMhm\LaravelImageCharts\ImageChart;

final class ImageChartsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish the configuration file
        $this->publishes([
            __DIR__ . '/../config/image-charts.php' => config_path('image-charts.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge the default configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/image-charts.php', 'image-charts');

        // Register the ImageChart class with the application container
        $this->app->singleton(ImageChart::class, function ($app) {
            return new ImageChart([
                'default_bg_color' => config('image-charts.default_bg_color'),
                'default_dataset_bg_color' => config('image-charts.default_dataset_bg_color'),
                'default_dataset_border_color' => config('image-charts.default_dataset_border_color'),
                'default_width' => config('image-charts.default_width'),
                'default_height' => config('image-charts.default_height'),
                'default_title_text' => config('image-charts.default_title_text'),
            ]);
        });

        // Register the ImageChartFacade accessor
        $this->app->bind('ImageChart', function ($app) {
            return $app->make(ImageChart::class);
        });
    }

    public function provides(): array
    {
        return [
            ImageChart::class,
            'ImageChart',
        ];
    }
}
