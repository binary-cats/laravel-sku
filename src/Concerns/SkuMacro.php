<?php

namespace BinaryCats\Sku\Concerns;

use Closure;
use Illuminate\Support\Str;

class SkuMacro
{
    /**
     * Sku generator mixin.
     *
     * @param  string $source
     * @param  string $separator
     * @return Closure
     */
    public function sku(): Closure
    {
        return function ($source, $separator = null) {
            $separator = $separator ?: config('laravel-sku.default.separator');
            // Clean up the source
            $source = Str::studly($source);
            // Limit the source
            $source = Str::limit($source, 3, '');
            // signature
            $signature = str_shuffle(str_repeat(str_pad('0123456789', 8, rand(0, 9).rand(0, 9), STR_PAD_LEFT), 2));
            // Sanitize the signature
            $signature = substr($signature, 0, 8);
            // Implode with random
            $result = implode($separator, [$source, $signature]);
            // Uppercase it
            return Str::upper($result);
        };
    }
}
