<?php

namespace BinaryCats\Sku\Tests;

use Illuminate\Support\Str;

class CustomGeneratorTest extends TestCase
{
    /** @test */
    public function it_can_use_custom_generator()
    {
        config()->set('laravel-sku.default.generate_on_create', true);

        config()->set('laravel-sku.generator', DummySkyGenerarator::class);

        $one = DummyModelFactory::new()->create();

        $this->assertTrue(Str::is($one->sku, DummySkyGenerarator::$testSku));
    }
}
