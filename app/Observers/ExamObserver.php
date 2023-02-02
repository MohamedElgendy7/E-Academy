<?php

namespace App\Observers;

use App\Models\Exam;

class ExamObserver
{
    /**
     * Handle the exam "created" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function created(Exam $exam)
    {
        //
    }

    /**
     * Handle the exam "updated" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function updated(Exam $exam)
    {
        //
    }

    /**
     * Handle the exam "deleted" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function deleted(Exam $exam)
    {
        $exam->degrees->delete();
    }

    /**
     * Handle the exam "restored" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function restored(Exam $exam)
    {
        //
    }

    /**
     * Handle the exam "force deleted" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function forceDeleted(Exam $exam)
    {
        //
    }
}
