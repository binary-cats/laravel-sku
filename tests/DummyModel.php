<?php

namespace BinaryCats\Sku\Tests;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyModel extends Model
{
    use HasFactory;
    use HasSku;
}
