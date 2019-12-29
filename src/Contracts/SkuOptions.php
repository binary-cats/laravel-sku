<?php

namespace BinaryCats\Sku\Contracts;

interface SkuOptions
{
    /**
     * Create a new instance of the class, with standard settings
     *
     * @return new instance
     */
    public static function make() : SkuOptions;

    /**
     * Set the source field
     *
     * @param  mixed $field
     * @return $this
     */
    public function from($field) : SkuOptions;

    /**
     * Set the destination field
     *
     * @param  mixed $field
     * @return $this
     */
    public function target(string $field) : SkuOptions;

    /**
     * Set unique flag
     *
     * @param  boll $value
     * @return $this
     */
    public function forceUnique(bool $value) : SkuOptions;

    /**
     * Set the separator value
     *
     * @param  string $separator
     * @return $this
     */
    public function allowDuplicates() : SkuOptions;

    /**
     * Set the separator value
     *
     * @param  string $separator
     * @return $this
     */
    public function using(string $separator) : SkuOptions;

    /**
     * Set the generateOnCreate value
     *
     * @param  bool $value
     * @return $this
     */
    public function generateOnCreate(bool $value) : SkuOptions;

    /**
     * Set the generateOnUpdate value
     *
     * @param  bool $value
     * @return $this
     */
    public function refreshOnUpdate(bool $value) : SkuOptions;
}
