<?php

namespace App\Observers;

use App\Models\Grade;

class GradeObserver
{
    /**
     * Handle the grade "created" event.
     *
     * @param  \App\Grade  $grade
     * @return void
     */
    public function created(Grade $grade)
    {
        //
    }

    /**
     * Handle the grade "updated" event.
     *
     * @param  \App\Grade  $grade
     * @return void
     */
    public function updated(Grade $grade)
    {
        //
    }

    /**
     * Handle the grade "deleted" event.
     *
     * @param  \App\Grade  $grade
     * @return void
     */
    public function deleted(Grade $grade)
    {
        $grade->groups->delete();
        $grade->students->delete();
    }

    /**
     * Handle the grade "restored" event.
     *
     * @param  \App\Grade  $grade
     * @return void
     */
    public function restored(Grade $grade)
    {
        //
    }

    /**
     * Handle the grade "force deleted" event.
     *
     * @param  \App\Grade  $grade
     * @return void
     */
    public function forceDeleted(Grade $grade)
    {
        //
    }
}
