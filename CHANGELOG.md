# Changelog

All notable changes to `laravel-sku` will be documented in this file

## 1.0.0 - 2026-03-08

### Added
- Dev container support with PHP 8.3, Xdebug, PCOV, and common extensions (`.devcontainer/`)
- `@mixin \Illuminate\Database\Eloquent\Model` annotation to `HasSku` trait for improved IDE support
- `#[Test]` attribute support across all test classes, replacing `/** @test */` docblock annotations

### Changed
- **Minimum PHP version bumped to 8.2+** (previously `^7.2|^8.0`)
- **Minimum Laravel version bumped to 12+** (previously `~5.6` through `^11.0`); `^13.0` also supported
- `orchestra/testbench` narrowed to `^10.0|^11.0`
- `phpunit/phpunit` narrowed to `^11.5.3|^12.5.12`
- `SkuOptions::from()` parameter type narrowed from untyped to `array|string`
- `SkuOptions` class properties now carry explicit native type declarations (`array`, `string`, `bool`)
- `bootHasSku()` now defers observer registration via `static::whenBooted()` rather than registering eagerly
- `SkuGenerator` model dependency moved to constructor promotion with `protected readonly`
- `toJson()` in `SkuGenerator` now carries an explicit `: string` return type
- All public and protected methods across `HasSku`, `SkuObserver`, `SkuOptions`, `SkuServiceProvider`, and `SkuGenerator` now carry explicit return types
- `HasSku::skuOption()` return type changed from untyped to `mixed`
- `SkuException::render()` docblock corrected to use fully-qualified `\Illuminate\Http\Request` and `\Illuminate\Http\Response`
- `SkuMacro` docblock updated to typed closure signature `\Closure(string $source, string|null $separator = null): string`
- `phpunit.xml` schema updated to local vendor path; removed deprecated `backupGlobals`, `processIsolation`, `stopOnFailure`, and `backupStaticProperties` attributes; `suffix=".php"` removed from source directory definition
- Author homepage updated to `https://binarycats.dev`
- `README.md` Ukraine support banner sourced locally (`./art/support-ukraine.svg`)

### Removed
- Support for PHP `^7.2` and `^8.0`
- Support for Laravel `~5.6` through `^11.0`
- Redundant `@param` and `@return` docblock tags superseded by native type hints throughout
- `docker`-based `fix` script from `composer.json` scripts

## 0.2.0 - 2020-03-04

- add support for Laravel 7

## 0.1.3 - 2020-02-02

- Add support for Laravel 5.6

## 0.1.0 - 2019-12-28

- Initial release
