<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{

    public function creating(User $user)
    {
        $batch = $user->batch;
        if (!empty($batch)) {
            $user->name = ucwords($user->name);
            $user->subject_id = $batch->subject_id;
            $user->semester_id = $batch->semester_id;
        }
    }

    public function created(User $user)
    {
        $batch = $user->batch;
        if (!empty($batch)) {
            $tpoicIds = $batch->semester->topics->pluck('id');
            $user->topics()->syncWithoutDetaching($tpoicIds);
        }
    }

    public function updating(User $user)
    {
        $batch = $user->batch;
        if (!empty($batch)) {
            $user->name = ucwords($user->name);
            $user->subject_id = $batch->subject_id;
            $user->semester_id = $batch->semester_id;
        }
    }

    public function updated(User $user)
    {
        $batch = $user->batch;
        if (!empty($batch)) {
            $tpoicIds = $batch->semester->topics->pluck('id');
            $user->topics()->syncWithoutDetaching($tpoicIds);
        }
    }
}
