<?php

namespace MohsenMhm\LaravelImageCharts;

class ImageChart
{
    private string $baseUrl;

    private array $labels;
    private array $data;
    private string $bgColor;
    private string $datasetBgColor;
    private string $datasetBorderColor;
    private string $width;
    private string $height;
    private string $titleText;
    private string $datasetLabel = '';
    private bool $datasetFill = false;

    public function __construct()
    {
        $this->baseUrl = config('image-charts.base_url', 'https://image-charts.com/chart.js/2.8.0');

        // Initialize properties from configuration
        $this->bgColor = config('image-charts.default_bg_color', '#2B2B2B');
        $this->datasetBgColor = config('image-charts.default_dataset_bg_color', '#FCBB3D');
        $this->datasetBorderColor = config('image-charts.default_dataset_border_color', '#FCBB3D');
        $this->width = config('image-charts.default_width', '900');
        $this->height = config('image-charts.default_height', '600');
        $this->titleText = config('image-charts.default_title_text', 'mohsen.sbs');
    }

    public function setLabels(array $labels): self
    {
        $this->labels = $labels;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function getUrl(): string
    {
        $config = [
            "type" => "line",
            "data" => [
                "labels" => $this->labels,
                "datasets" => [
                    [
                        "backgroundColor" => $this->datasetBgColor,
                        "borderColor" => $this->datasetBorderColor,
                        "data" => $this->data,
                        "label" => $this->datasetLabel,
                        "fill" => $this->datasetFill,
                    ],
                ],
            ],
            "options" => [
                "scales" => [
                    "xAxes" => [
                        [
                            "ticks" => [
                                "autoSkip" => false,
                                "maxRotation" => 0,
                            ],
                        ],
                    ],
                ],
                "title" => [
                    "text" => $this->titleText,
                    "display" => true,
                ],
            ],
        ];

        $encodedConfig = urlencode(json_encode($config));

        return sprintf(
            "%s?bkg=%s&c=%s&height=%s&width=%s",
            $this->baseUrl,
            urlencode($this->bgColor),
            $encodedConfig,
            $this->height,
            $this->width
        );
    }
}
