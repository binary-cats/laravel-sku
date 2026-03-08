# Upgrading

# 0.x -> 1.x
Minimum Requirements: 
- PHP 8.2
- Laravel 12+

The code was upgraded with typehints and return types; some of these changes are not compatible with older versions of PHP.

## Enforced `SkuOptions` contract
If you implement custom `SkuOptions` make sure to check method typehints as the [interface](./src/Contracts/SkuOptions.php) has been updated with stricter type constraints.

#### `SkuOptions::from()` type narrowed
The `from()` method previously accepted any type. It now enforces `array|string`. 
Ensure all calls to `->from()` pass only a string or an array of strings.

#### `bootHasSku` now uses `whenBooted()`
Observer registration is now deferred via `static::whenBooted()`. 
This should be transparent in most cases, but if you rely on the observer 
being registered at a precise point during the boot cycle, verify your behaviour.

# 0.4.0
You can now implement your own SkuGenerators, as suggested by #12
