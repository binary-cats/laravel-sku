<?php

namespace BinaryCats\Sku;

use BinaryCats\Sku\Concerns\SkuObserver;
use BinaryCats\Sku\Concerns\SkuOptions;

trait HasSku
{
    /**
     * Boot the trait by adding observers.
     *
     * @return void
     */
    public static function bootHasSku()
    {
        static::observe(SkuObserver::class);
    }

    /**
     * Get the options for generating the Sku.
     *
     * @return BinaryCats\Sku\SkuOptions
     */
    public function skuOptions(): SkuOptions
    {
        return resolve(SkuOptions::class);
    }

    /**
     * Fetch SKU option.
     *
     * @param  string $key
     * @return mixed
     */
    public function skuOption(string $key)
    {
        return $this->skuOptions()->{$key};
    }

    /**
     * Unless the field is called something else, we can safely get the value from the attribute.
     *
     * @param  mixed $value
     * @return string
     */
    public function getSkuAttribute($value)
    {
        return (string) $value ?: $this->getAttribute($this->skuOption('field'));
    }
}
