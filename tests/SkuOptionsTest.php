<?php

namespace BinaryCats\Sku\Tests;

use BinaryCats\Sku\Contracts\SkuOptions as SkuOptionsContract;
use BinaryCats\Sku\Concerns\SkuOptions;
use BinaryCats\Sku\Exceptions\SkuException;

class SkuOptionsTest extends TestCase
{
    /** @test */
    public function it_can_create_sku_options_statically()
    {
        $options = SkuOptions::make();

        $this->assertInstanceOf(SkuOptionsContract::class, $options);
    }

    /** @test */
    public function it_will_throw_exception_on_missing_property()
    {
        $this->expectException(SkuException::class);

        SkuOptions::make()->garbage_property_that_doesnt_exist;
    }

    /** @test */
    public function it_can_set_properties_via_methods()
    {
        $options = SkuOptions::make();

        $options->from('foo');
        $this->assertEquals(['foo'], $options->source);

        $options->from(['foo', 'bar']);
        $this->assertEquals(['foo', 'bar'], $options->source);

        $options->target('baz');
        $this->assertEquals('baz', $options->field);

        $options->forceUnique(true);
        $this->assertTrue($options->unique);

        $options->forceUnique(false);
        $this->assertFalse($options->unique);

        $options->allowDuplicates();
        $this->assertFalse($options->unique);
    }
}
