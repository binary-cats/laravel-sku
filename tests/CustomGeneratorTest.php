<?php

namespace BinaryCats\Sku\Tests;

use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;

class CustomGeneratorTest extends TestCase
{
    #[Test]
    public function it_can_use_custom_generator(): void
    {
        config()->set('laravel-sku.default.generate_on_create', true);

        config()->set('laravel-sku.generator', DummySkyGenerarator::class);

        $one = DummyModelFactory::new()->create();

        $this->assertTrue(Str::is($one->sku, DummySkyGenerarator::$testSku));
    }
}
