<?php

namespace BinaryCats\Sku\Tests;

use BinaryCats\Sku\Concerns\SkuGenerator;
use PHPUnit\Framework\Attributes\Test;

class SkuGeneratorTest extends TestCase
{
    #[Test]
    public function it_will_convert_to_json(): void
    {
        $model = DummyModel::make();

        $generator = new SkuGenerator($model);

        $this->assertJson($generator->toJson());
    }
}
