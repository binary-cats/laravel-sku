<?php

namespace BinaryCats\Sku\Tests;

use BinaryCats\Sku\Contracts\SkuGenerator;

class DummySkyGenerarator implements SkuGenerator
{
    public static $testSku = 'Random-123-value';

    /**
     * Render the SKU.
     *
     * @return string
     */
    public function render(): string
    {
        return static::$testSku;
    }

    /**
     * Implement toString method.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
