<?php

namespace BinaryCats\Sku\Concerns;

use BinaryCats\Sku\Contracts\SkuOptions as SkuOptionsContract;
use BinaryCats\Sku\Exceptions\SkuException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class SkuOptions implements SkuOptionsContract
{
    /**
     * Set the field which is a base fo rthe SKU.
     */
    protected array $source;

    /**
     * Name of the model to store the SKU.
     */
    protected string $field;

    /**
     * True if SKU is to be unique.
     */
    protected bool $unique;

    /**
     * Separator value.
     */
    protected string $separator;

    /**
     * True if SKU to be generated on creating.
     */
    protected bool $generateOnCreate;

    /**
     * True if SKU needs to be re-generated on update.
     */
    protected bool $generateOnUpdate;

    /**
     * Create new class.
     */
    public function __construct(array $config)
    {
        $this->from($config['source'])
            ->target($config['field'])
            ->using($config['separator'])
            ->forceUnique($config['unique'])
            ->generateOnCreate($config['generate_on_create'])
            ->refreshOnUpdate($config['generate_on_update']);
    }

    /**
     * Create a new instance of the class, with standard settings.
     *
     * @return new instance
     */
    public static function make(): SkuOptionsContract
    {
        return resolve(self::class);
    }

    /**
     * Set the source field.
     */
    public function from(array|string $field): SkuOptionsContract
    {
        $this->source = Arr::wrap($field);

        return $this;
    }

    /**
     * Set the destination field.
     */
    public function target(string $field): SkuOptionsContract
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Set unique flag.
     */
    public function forceUnique(bool $value): SkuOptionsContract
    {
        $this->unique = $value;

        return $this;
    }

    /**
     * Set the separator value.
     */
    public function allowDuplicates(): SkuOptionsContract
    {
        return $this->forceUnique(false);
    }

    /**
     * Set the separator value.
     */
    public function using(string $separator): SkuOptionsContract
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * Set the generateOnCreate value.
     */
    public function generateOnCreate(bool $value): SkuOptionsContract
    {
        $this->generateOnCreate = $value;

        return $this;
    }

    /**
     * Set the generateOnUpdate value.
     */
    public function refreshOnUpdate(bool $value): SkuOptionsContract
    {
        $this->generateOnUpdate = $value;

        return $this;
    }

    /**
     * Access protected properties.
     *
     * @throws BadSkuArgument
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        throw SkuException::invalidArgument("`{$property}` does not exist as a option", 500);
    }
}
