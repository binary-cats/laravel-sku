<?php

namespace BinaryCats\Sku\Contracts;

/**
 * @property string[] $source
 * @property string $field
 * @property bool $unit
 * @property string $separator
 * @property bool $generateOnCreate
 * @property bool $generateOnUpdate
 */
interface SkuOptions
{
    /**
     * Create a new instance of the class, with standard settings.
     */
    public static function make(): self;

    /**
     * Set the source field.
     *
     * @param  string[]|string  $field
     */
    public function from(array|string $field): self;

    /**
     * Set the destination field.
     */
    public function target(string $field): self;

    /**
     * Set unique flag.
     */
    public function forceUnique(bool $value): self;

    /**
     * Set the separator value.
     */
    public function allowDuplicates(): self;

    /**
     * Set the separator value.
     */
    public function using(string $separator): self;

    /**
     * Set the generateOnCreate value.
     */
    public function generateOnCreate(bool $value): self;

    /**
     * Set the generateOnUpdate value.
     */
    public function refreshOnUpdate(bool $value): self;
}
