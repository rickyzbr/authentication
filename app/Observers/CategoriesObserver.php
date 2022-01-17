<?php

namespace App\Observers;

use App\Models\Categories;

class CategoriesObserver
{
    /**
     * Handle the Categories "created" event.
     *
     * @param  \App\Models\Categories  $categories
     * @return void
     */
    public function creating(Categories $category)
    {
        if (is_null($category->position)) {
            $category->position = Categories::max('position') + 1;
            return;
        }

        $lowerPriorityCategories = Categories::where('position', '>=', $category->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            $lowerPriorityCategory->position++;
            $lowerPriorityCategory->saveQuietly();
        }
    }

    /**
     * Handle the Categories "updated" event.
     *
     * @param  \App\Models\Categories  $categories
     * @return void
     */
    public function updating(Categories $category)
    {
        if ($category->isClean('position')) {
            return;
        }

        if (is_null($category->position)) {
            $category->position = Categories::max('position');
        }

        if ($category->getOriginal('position') > $category->position) {
            $positionRange = [
                $category->position, $category->getOriginal('position')
            ];
        } else {
            $positionRange = [
                $category->getOriginal('position'), $category->position
            ];
        }

        $lowerPriorityCategories = Categories::where('id', '!=', $category->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            if ($category->getOriginal('position') < $category->position) {
                $lowerPriorityCategory->position--;
            } else {
                $lowerPriorityCategory->position++;
            }
            $lowerPriorityCategory->saveQuietly();
        }
    }

    /**
     * Handle the Categories "deleted" event.
     *
     * @param  \App\Models\Categories  $categories
     * @return void
     */
    public function deleted(Categories $category)
    {
        $lowerPriorityCategories = Categories::where('position', '>', $category->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            $lowerPriorityCategory->position--;
            $lowerPriorityCategory->saveQuietly();
        }
    }

    /**
     * Handle the Categories "restored" event.
     *
     * @param  \App\Models\Categories  $categories
     * @return void
     */
    public function restored(Categories $categories)
    {
        //
    }

    /**
     * Handle the Categories "force deleted" event.
     *
     * @param  \App\Models\Categories  $categories
     * @return void
     */
    public function forceDeleted(Categories $categories)
    {
        //
    }
}
