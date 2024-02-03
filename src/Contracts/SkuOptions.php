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
     *
     * @return $this
     */
    public static function make(): self;

    /**
     * Set the source field.
     *
     * @param  string[]|string  $field
     * @return $this
     */
    public function from($field): self;

    /**
     * Set the destination field.
     *
     * @param  string  $field
     * @return $this
     */
    public function target(string $field): self;

    /**
     * Set unique flag.
     *
     * @param  bool  $value
     * @return $this
     */
    public function forceUnique(bool $value): self;

    /**
     * Set the separator value.
     *
     * @param  string  $separator
     * @return $this
     */
    public function allowDuplicates(): self;

    /**
     * Set the separator value.
     *
     * @param  string  $separator
     * @return $this
     */
    public function using(string $separator): self;

    /**
     * Set the generateOnCreate value.
     *
     * @param  bool  $value
     * @return $this
     */
    public function generateOnCreate(bool $value): self;

    /**
     * Set the generateOnUpdate value.
     *
     * @param  bool  $value
     * @return $this
     */
    public function refreshOnUpdate(bool $value): self;
}
