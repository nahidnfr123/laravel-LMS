<?php

namespace App\Observers;

use App\Models\Batch;
use App\Models\User;

class BatchObserver
{
    public function updated(Batch $batch)
    {

        $users = $batch->users;

        if (count($users)) {
            $tpoicIds = $batch->semester->topics->pluck('id');
            foreach ($users as $user) {
                $user->topics()->syncWithoutDetaching($tpoicIds);
            }
        }
    }
}
