<?php

namespace BinaryCats\Sku\Tests;

use BinaryCats\Sku\Concerns\SkuGenerator;
use BinaryCats\Sku\Concerns\SkuMacro;
use Illuminate\Support\Str;
use Mockery\MockInterface;

class SkuGeneratorTest extends TestCase
{
    /** @test */
    public function it_will_convert_to_json()
    {
        $model = DummyModel::make();

        $generator = new SkuGenerator($model);

        $this->assertJson($generator->toJson());
    }
}
