<?php

namespace BinaryCats\Sku\Concerns;

use Illuminate\Database\Eloquent\Model;

class SkuObserver
{
    /**
     * Handle the "creating" mmodel.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function creating(Model $model)
    {
        $field = $model->skuOption('field');

        if ($model->skuOption('generateOnCreate')) {
            $model->setAttribute($field, new SkuGenerator($model));
        }
    }

    /**
     * Handle the "udating" mmodel.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updating(Model $model)
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
            $model->setAttribute($field, new SkuGenerator($model));
        }
    }
}
