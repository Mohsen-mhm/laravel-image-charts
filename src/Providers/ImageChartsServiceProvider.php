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
        $this->app->singleton('ImageChart', function ($app) {
            return new ImageChart();
        });
    }

    public function provides(): array
    {
        return [
            'ImageChart',
        ];
    }
}
