<?php

namespace BinaryCats\Sku;

use BinaryCats\Sku\Concerns\SkuObserver;
use BinaryCats\Sku\Concerns\SkuOptions;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasSku
{
    /**
     * Boot the trait by adding observers.
     *
     * @return void
     */
    public static function bootHasSku(): void
    {
        static::whenBooted(
            fn () => static::observe(SkuObserver::class)
        );
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
     */
    public function skuOption(string $key): mixed
    {
        return $this->skuOptions()->{$key};
    }

    /**
     * Unless the field is called something else, we can safely get the value from the attribute.
     */
    public function getSkuAttribute($value): string
    {
        return (string) $value ?: $this->getAttribute($this->skuOption('field'));
    }
}
