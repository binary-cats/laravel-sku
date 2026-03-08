# Upgrading

# 0.x -> 1.x
Minimum Requirements: 
- PHP 8.2
- Laravel 12+

The code was upgraded with typehints and return types; some of these changes are not compatible with older versions of PHP.

## Enforced `SkuOptions` contract
If you implement custom `SkuOptions` make sure to check method typehints as the [interface](./src/Contracts/SkuOptions.php) has been updated with stricter type constraints.

# 0.4.0
You can now implement your own SkuGenerators, as suggested by #12
