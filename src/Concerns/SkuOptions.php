<?php

namespace BinaryCats\Sku\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SkuOptions
{
    /**
     * Set the field which is a base fo rthe SKU.
     *
     * @var array
     */
    protected $source;

    /**
     * Name of the model to store the SKU.
     *
     * @var string
     */
    protected $field;

    /**
     * True if SKU is to be unique.
     *
     * @var bool
     */
    protected $unique;

    /**
     * Separator value.
     *
     * @var string
     */
    protected $separator;

    /**
     * True if SKU to be generated on creating.
     *
     * @var bool
     */
    protected $generateOnCreate;

    /**
     * True if SKU needs to be re-generated on update.
     *
     * @var bool
     */
    protected $generateOnUpdate;

    /**
     * Create new class
     */
    public function __construct(array $config)
    {
        $this->from($config['source'])
            ->to($config['field'])
            ->using($config['separator'])
            ->forceUnique($config['unique'])
            ->generateOnCreate($config['generate_on_create'])
            ->refreshOnUpdate($config['generate_on_update']);
    }

    /**
     * Create a new instance of the class, with standard settings
     *
     * @return new instance
     */
    public static function make() : self
    {
        return resolve(SkuOptions::class);
    }

    /**
     * Set the source field
     *
     * @param  mixed $field
     * @return $this
     */
    public function from($field) : self
    {
        $this->source = Arr::wrap($field);

        return $this;
    }

    /**
     * Set the destination field
     *
     * @param  mixed $field
     * @return $this
     */
    public function to(string $field) : self
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Set unique flag
     *
     * @param  boll $value
     * @return $this
     */
    public function forceUnique(bool $value) : self
    {
        $this->unique = $value;

        return $this;
    }

    /**
     * Set the separator value
     *
     * @param  string $separator
     * @return $this
     */
    public function allowDuplicates() : self
    {
        return $this->forceUnique(false);
    }

    /**
     * Set the separator value
     *
     * @param  string $separator
     * @return $this
     */
    public function using(string $separator) : self
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * Set the generateOnCreate value
     *
     * @param  bool   $value
     * @return $this
     */
    public function generateOnCreate(bool $value) : self
    {
        $this->generateOnCreate = $value;

        return $this;
    }

    /**
     * Set the generateOnUpdate value
     *
     * @param  bool   $value
     * @return $this
     */
    public function refreshOnUpdate(bool $value) : self
    {
        $this->generateOnUpdate = $value;

        return $this;
    }

    /**
     * Access protected properties
     *
     * @param  string $property
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        throw new \InvalidArgumentException("`{$property}` does not exist as a option", 500);
    }
}
