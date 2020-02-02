<?php

namespace BinaryCats\Sku\Contracts;

interface SkuOptions
{
    /**
     * Create a new instance of the class, with standard settings.
     *
     * @return new instance
     */
    public static function make(): self;

    /**
     * Set the source field.
     *
     * @param  mixed $field
     * @return $this
     */
    public function from($field): self;

    /**
     * Set the destination field.
     *
     * @param  mixed $field
     * @return $this
     */
    public function target(string $field): self;

    /**
     * Set unique flag.
     *
     * @param  boll $value
     * @return $this
     */
    public function forceUnique(bool $value): self;

    /**
     * Set the separator value.
     *
     * @param  string $separator
     * @return $this
     */
    public function allowDuplicates(): self;

    /**
     * Set the separator value.
     *
     * @param  string $separator
     * @return $this
     */
    public function using(string $separator): self;

    /**
     * Set the generateOnCreate value.
     *
     * @param  bool $value
     * @return $this
     */
    public function generateOnCreate(bool $value): self;

    /**
     * Set the generateOnUpdate value.
     *
     * @param  bool $value
     * @return $this
     */
    public function refreshOnUpdate(bool $value): self;
}
