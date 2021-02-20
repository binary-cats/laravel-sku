<?php

namespace BinaryCats\Sku\Contracts;

interface SkuGenerator
{
    /**
     * Render the SKU.
     *
     * @return string
     */
    public function render(): string;
}
