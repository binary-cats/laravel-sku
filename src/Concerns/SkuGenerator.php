<?php

namespace BinaryCats\Sku\Concerns;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SkuGenerator implements Renderable
{
    /**
     * Model to generate SKUs from.
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Shortcut to the SkuOptions.
     *
     * @var BinaryCats\Sku\Concerns\SkuOptions
     */
    protected $options;

    /**
     * Create new SKU Generator.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->options = $model->skuOptions();
    }

    /**
     * Render the SKU.
     *
     * @return string
     */
    public function render(): string
    {
        // Fetch the part that makes the initial source
        $source = $this->getSourceString();
        // now, make Sku
        return $this->makeSku($source, $this->options->separator, $this->options->unique);
    }

    /**
     * Get the source fields for the SKU.
     *
     * @return string
     */
    protected function getSourceString(): string
    {
        // fetch the source fields
        $source = $this->options->source;
        // Fetch fields from model, skip empty
        $fields = array_filter($this->model->only($source));
        // Impode with a separator
        return implode($this->options->separator, $fields);
    }

    /**
     * Make the SKU.
     *
     * @param  string  $source
     * @param  string  $separator
     * @param  bool $unique
     * @return string
     */
    protected function makeSku(string $source, string $separator, bool $unique = false): string
    {
        // Make
        $sku = Str::sku($source, $separator);
        // if we are forcing uniques and it already exists, re-try
        if ($unique and $this->exists($sku)) {
            return $this->makeSku($source, $unique);
        }

        return $sku;
    }

    /**
     * True if the value already exists in the DB.
     *
     * @param  string $sku
     * @return bool
     */
    protected function exists(string $sku): bool
    {
        // We need to exclude the current model
        $key = $this->model->getKey();
        // Evaluate the model for SKU presence
        return $this->model
            ->where($this->model->getKeyName(), '!=', $key)
            ->where($this->options->field, $sku)
            ->withoutGlobalScopes()
            ->exists();
    }

    /**
     * Convert the Generator to String.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
