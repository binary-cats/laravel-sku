<?php

namespace BinaryCats\Sku\Contracts;

interface SkuGenerator
{
    /**
     * Render the SKU.
     */
    public function render(): string;
}
