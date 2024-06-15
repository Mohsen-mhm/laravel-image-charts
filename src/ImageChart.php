<?php

namespace MohsenMhm\LaravelImageCharts;

use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class ImageChart
{
    private string $baseUrl;

    private array $labels = [];
    private array $data = [];
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

    /**
     * @param array $labels
     * @return $this
     */
    public function setLabels(array $labels): self
    {
        if (empty($labels)) {
            throw new InvalidArgumentException("Labels array cannot be empty.");
        }
        foreach ($labels as $label) {
            if (!is_string($label)) {
                throw new InvalidArgumentException("Each label must be a string.");
            }
        }

        $this->labels = $labels;
        return $this;
    }


    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self
    {
        if (empty($data)) {
            throw new InvalidArgumentException("Data array cannot be empty.");
        }
        foreach ($data as $value) {
            if (!is_numeric($value)) {
                throw new InvalidArgumentException("Each data point must be numeric.");
            }
        }

        $this->data = $data;
        return $this;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function setBackgroundColor(string $color): self
    {
        if (!$this->isValidColor($color)) {
            throw new InvalidArgumentException("Invalid background color format.");
        }

        $this->bgColor = $color;
        return $this;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function setDatasetBackgroundColor(string $color): self
    {
        if (!$this->isValidColor($color)) {
            throw new InvalidArgumentException("Invalid dataset background color format.");
        }

        $this->datasetBgColor = $color;
        return $this;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function setDatasetBorderColor(string $color): self
    {
        if (!$this->isValidColor($color)) {
            throw new InvalidArgumentException("Invalid dataset border color format.");
        }

        $this->datasetBorderColor = $color;
        return $this;
    }

    /**
     * @param string $width
     * @return $this
     */
    public function setWidth(string $width): self
    {
        if (!is_numeric($width) || $width <= 100 || $width >= 900) {
            throw new InvalidArgumentException("Width must be a positive number & between 100 - 900.");
        }

        $this->width = $width;
        return $this;
    }

    /**
     * @param string $height
     * @return $this
     */
    public function setHeight(string $height): self
    {
        if (!is_numeric($height) || $height <= 100 || $height >= 900) {
            throw new InvalidArgumentException("Height must be a positive number & between 100 - 900.");
        }

        $this->height = $height;
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitleText(string $title): self
    {
        if (empty($title)) {
            throw new InvalidArgumentException("Title text cannot be empty.");
        }

        $this->titleText = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        if (empty($this->labels) || empty($this->data)) {
            throw new InvalidArgumentException("Labels and data arrays cannot be empty.");
        }

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

    /**
     * @param string|null $path
     * @return string
     */
    public function getImage(string $path = null): string
    {
        if (!$path) {
            $path = config('image-charts.default_image_path');
        }

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $filename = 'chart_' . time() . '.png';
        $fullPath = $path . DIRECTORY_SEPARATOR . $filename;

        $image = Http::get($this->getUrl())->body();
        file_put_contents($fullPath, $image);

        return $fullPath;
    }

    private function isValidColor(string $color): bool
    {
        return preg_match('/^#?(?:[a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/', $color) === 1;
    }
}
