<?php

namespace BinaryCats\Sku\Tests;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DummyModel extends Model
{
    use HasFactory;
    use HasSku;
}
