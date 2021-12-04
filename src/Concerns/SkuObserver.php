<?php

namespace BinaryCats\Sku\Concerns;

use BinaryCats\Sku\Contracts\SkuGenerator;
use Illuminate\Database\Eloquent\Model;

class SkuObserver
{
    /**
     * Handle model "creating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function creating(Model $model): void
    {
        // Name of the field to store the SKU
        $field = $model->skuOption('field');
        // Set the value
        if ($model->skuOption('generateOnCreate')) {
            $model->setAttribute($field, (string) $this->generator($model));
        }
    }

    /**
     * Handle model "updating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function updating(Model $model): void
    {
        // Name of the field to store the SKU
        $field = $model->skuOption('field');
        // If we are overwriting manually, just return
        if ($model->isDirty($field)) {
            return;
        }
        // Fetch the source of the SKUs
        $source = $model->skuOption('source');
        // if we are requested to generate and those fields are dirty
        if ($model->skuOption('generateOnUpdate') and $model->isDirty($source)) {
            $model->setAttribute($field, (string) $this->generator($model));
        }
    }

    /**
     * Make the SKUGenerator.
     *
     * @return \BinaryCats\Sku\Contracts\SkuGenerator
     */
    protected function generator(Model $model): SkuGenerator
    {
        return resolve(SkuGenerator::class, ['model' => $model]);
    }
}
