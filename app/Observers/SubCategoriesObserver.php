<?php

namespace App\Observers;

use App\Models\SubCategories;

class SubCategoriesObserver
{
    /**
     * Handle the SubCategories "created" event.
     *
     * @param  \App\Models\SubCategories  $subCategories
     * @return void
     */
    public function creating(Subcategories $subcategory)
    {
        if (is_null($subcategory->position)) {
            $subcategory->position = Subcategories::where('category_id', $subcategory->category_id)->max('position') + 1;
            return;
        }

        $lowerPrioritySubcategories = Meal::where('category_id', $subcategory->category_id)
            ->where('position', '>=', $subcategory->position)
            ->get();

        foreach ($lowerPrioritySubcategories as $lowerPrioritySubcategory) {
            $lowerPrioritySubcategory->position++;
            $lowerPrioritySubcategory->saveQuietly();
        }
    }

    /**
     * Handle the SubCategories "updated" event.
     *
     * @param  \App\Models\SubCategories  $subCategories
     * @return void
     */
    public function updating(Subcategories $subcategory)
    {
        if ($subcategory->isClean('position')) {
            return;
        }

        if (is_null($subcategory->position)) {
            $subcategory->position = Subcategories::where('category_id', $subcategory->category_id)->max('position');
        }

        if ($subcategory->getOriginal('position') > $subcategory->position) {
            $positionRange = [
                $subcategory->position, $subcategory->getOriginal('position')
            ];
        } else {
            $positionRange = [
                $subcategory->getOriginal('position'), $subcategory->position
            ];
        }

        $lowerPrioritySubcategories = Subcategories::where('category_id', $subcategory->category_id)
            ->whereBetween('position', $positionRange)
            ->where('id', '!=', $subcategory->id)
            ->get();

        foreach ($lowerPrioritySubcategories as $lowerPrioritySubcategory) {
            if ($meal->getOriginal('position') < $subcategory->position) {
                $lowerPrioritySubcategory->position--;
            } else {
                $lowerPrioritySubcategory->position++;
            }
            $lowerPrioritySubcategory->saveQuietly();
        }
    }

    /**
     * Handle the SubCategories "deleted" event.
     *
     * @param  \App\Models\SubCategories  $subCategories
     * @return void
     */
    public function deleted(Subcategories $subcategory)
    {
        $lowerPrioritySubcategories = Subcategories::where('category_id', $subcategory->category_id)
            ->where('position', '>', $subcategory->position)
            ->get();

        foreach ($lowerPrioritySubcategories as $lowerPrioritySubcategory) {
            $lowerPrioritySubcategory->position--;
            $lowerPrioritySubcategory->saveQuietly();
        }
    }

    /**
     * Handle the SubCategories "restored" event.
     *
     * @param  \App\Models\SubCategories  $subCategories
     * @return void
     */
    public function restored(SubCategories $subCategories)
    {
        //
    }

    /**
     * Handle the SubCategories "force deleted" event.
     *
     * @param  \App\Models\SubCategories  $subCategories
     * @return void
     */
    public function forceDeleted(SubCategories $subCategories)
    {
        //
    }
}
