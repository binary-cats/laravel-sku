<?php

namespace BinaryCats\Sku\Tests;

use Illuminate\Support\Str;

class SkuTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_have_sku_on_create()
    {
        $one = DummyModelFactory::new()->create();

        $this->assertTrue(isset($one->sku));
        $this->assertIsString($one->sku);
    }

    /**
     * @test
     */
    public function it_will_miss_sku_on_create_if_configured()
    {
        config()->set('laravel-sku.default.generate_on_create', false);

        $one = DummyModelFactory::new()->create();

        $value = $one->getRawOriginal('sku');

        $this->assertNull($value);
    }

    /**
     * @test
     */
    public function it_will_reset_sku_on_update()
    {
        $one = DummyModelFactory::new()->create();

        $sku = $one->sku;

        $one->forceFill(
            [
                'name' => Str::random(),
            ]
        )->save();

        $this->assertFalse(Str::is($one->sku, $sku));
        $this->assertIsString($sku);
        $this->assertIsString($one->sku);
    }

    /**
     * @test
     */
    public function it_will_preserve_sku_on_update_when_configured()
    {
        config()->set('laravel-sku.default.generate_on_update', false);

        $one = DummyModelFactory::new()->create();

        $sku = $one->sku;

        $one->forceFill(
            [
                'name' => Str::random(),
            ]
        )->save();

        $this->assertTrue(Str::is($one->sku, $sku));
        $this->assertIsString($sku);
        $this->assertIsString($one->sku);
    }
}
