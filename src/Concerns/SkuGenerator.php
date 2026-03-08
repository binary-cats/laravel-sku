<?php

namespace BinaryCats\Sku\Concerns;

use BinaryCats\Sku\Contracts\SkuGenerator as SkuGeneratorContract;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SkuGenerator implements Jsonable, Renderable, SkuGeneratorContract
{
    /**
     * Shortcut to the SkuOptions.
     *
     * @var \BinaryCats\Sku\Concerns\SkuOptions
     */
    protected $options;

    /**
     * Create new SKU Generator.
     */
    public function __construct(
        protected readonly Model $model
    ) {
        $this->options = $model->skuOptions();
    }

    /**
     * Render the SKU.
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
     */
    protected function exists(string $sku): bool
    {
        return $this->model
            ->whereKeyNot($this->model->getKey())
            ->where($this->options->field, $sku)
            ->withoutGlobalScopes()
            ->exists();
    }

    /**
     * Convert the Generator to String.
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     */
    public function toJson($options = 0): string
    {
        return $this->render();
    }
}
