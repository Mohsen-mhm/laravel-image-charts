<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base URL for Image Charts
    |--------------------------------------------------------------------------
    |
    | This value defines the base URL for generating image charts. You can set
    | it in your environment file using the IMAGE_CHARTS_BASE_URL key. The
    | default value points to the image charts API version 2.8.0.
    |
    */
    'base_url' => env('IMAGE_CHARTS_BASE_URL', 'https://image-charts.com/chart.js/2.8.0'),

    /*
    |--------------------------------------------------------------------------
    | Default Background Color
    |--------------------------------------------------------------------------
    |
    | This value specifies the default background color of the chart. You can
    | change this to any valid color code. The default value is set to a dark
    | gray color (#2B2B2B).
    |
    */
    'default_bg_color' => '#2B2B2B',

    /*
    |--------------------------------------------------------------------------
    | Default Dataset Background Color
    |--------------------------------------------------------------------------
    |
    | This value specifies the default background color for the dataset. You can
    | change this to any valid color code. The default value is set to a bright
    | yellow color (#FCBB3D).
    |
    */
    'default_dataset_bg_color' => '#FCBB3D',

    /*
    |--------------------------------------------------------------------------
    | Default Dataset Border Color
    |--------------------------------------------------------------------------
    |
    | This value specifies the default border color for the dataset. You can
    | change this to any valid color code. The default value is set to a bright
    | yellow color (#FCBB3D).
    |
    */
    'default_dataset_border_color' => '#FCBB3D',

    /*
    |--------------------------------------------------------------------------
    | Default Chart Width
    |--------------------------------------------------------------------------
    |
    | This value defines the default width of the chart in pixels. You can change
    | this value to set the desired width of your charts. The default value is
    | set to 900 pixels.
    |
    */
    'default_width' => '900',

    /*
    |--------------------------------------------------------------------------
    | Default Chart Height
    |--------------------------------------------------------------------------
    |
    | This value defines the default height of the chart in pixels. You can change
    | this value to set the desired height of your charts. The default value is
    | set to 600 pixels.
    |
    */
    'default_height' => '600',

    /*
    |--------------------------------------------------------------------------
    | Default Chart Title
    |--------------------------------------------------------------------------
    |
    | This value specifies the default title text for the charts. You can change
    | this value to set the desired title for your charts. The default value is
    | set to 'mohsen.sbs'.
    |
    */
    'default_title_text' => 'mohsen.sbs',

];

