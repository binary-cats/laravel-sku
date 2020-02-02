# Handle SKUs for your models

Generate unique SKUs when saving any Eloquent model with support for Laravel 5.6, Laravel 6 and above.

```php
$model = new EloquentModel();
$model->name = 'Laravel is Awesome';
$model->save();

echo $model->sku; // ouputs "LAR-80564492"
```

Package will add a new method to Laravel's `Illuminate\Support\Str::sku()` class to generate an SKU for you.

## Installation

You can install the package via composer:

```bash
composer require binary-cats/laravel-sku
```

The service provider will automatically register itself.

You can publish the config file with:
```bash
php artisan vendor:publish --provider="BinaryCats\Sku\SkuServiceProvider" --tag="config"
```

This is the contents of the config file that will be published at `config/laravel-sku.php`:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | SKU settings
    |--------------------------------------------------------------------------
    |
    | Set up your SKU
    |
    */
    'default' => [
        /*
         * SKU is based on a specific field of a model
         * You can use a single field or an array of fields
         */
        'source' => 'name',

        /*
         * Destination model field name
         *
         */
        'field' => 'sku',

        /*
         * SKU separator
         *
         */
        'separator' => '-',

        /*
         * Shall SKUs be enforced to be unique
         *
         */
        'unique' => true,

        /*
         * Shall SKUs be generated on create
         *
         */
        'generate_on_create' => true,

        /*
         * Shall SKUs be re-generated on update
         *
         */
        'generate_on_update' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | SKU Generator
    |--------------------------------------------------------------------------
    |
    | Define your own generator if needed.
    |
    */
    'generator' => \BinaryCats\Sku\Concerns\SkuGenerator::class,
];
```

Please note that the above set up expects you have an `sku` field in your model. If you plan to manually overwrite the values, please make sure to add this field to `fillable` array;

### Usage

Add `BinaryCats\Sku\HasSku` trait to your model. That's it!


```php
namespace App;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSku;
}
```

Behind the scenes this will register an observer for the `sku` field, which will be generated every time you save the model.

## Advanced usage

If you want to change settings for a specific model, you can overload the `skuOptions`() method:

```php
namespace App;

use BinaryCats\Sku\HasSku;
use BinaryCats\Sku\Concerns\SkuOptions;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSku;

    /**
     * Get the options for generating the Sku.
     *
     * @return BinaryCats\Sku\SkuOptions
     */
    public function skuOptions() : SkuOptions
    {
        return SkuOptions::make()
            ->from(['label', 'another_field'])
            ->target('arbitrary_sku_field_name')
            ->using('_')
            ->forceUnique(false)
            ->generateOnCreate(true)
            ->refreshOnUpdate(false);
    }
}
```

### About SKUs

[Stock Keeping Unit](https://en.wikipedia.org/wiki/Stock_keeping_unit) allows you to set a  unique identifier or code that refers to the particular stock keeping unit.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email cyrill.kalita@gmail.com instead of using issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

## Credits

- [Cyrill Kalita](https://github.com/binary-cats)
- [All Contributors](../../contributors)

## Support us

Binary Cats is a webdesign agency based in Illinois, US.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
