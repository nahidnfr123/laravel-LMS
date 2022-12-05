<?php

namespace App\Imports;

use App\Models\ClasAttendance;
use App\Models\Mark;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;

class AttendanceImport implements ToCollection
{
    use Importable;

    public mixed $batch_id, $total_classes;

    public function __construct($topic_id = null, $total_classes = null)
    {
        $this->topic_id = $topic_id;
        $this->total_classes = $total_classes;
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $s_id = User::where('s_id', $row[0])->first();
            if (!empty($s_id) && $row[0]) {
                ClasAttendance::updateOrCreate([
                    'topic_id' => $this->topic_id,
                    'user_id' => $s_id->id,
                ], [
                    'topic_id' => $this->topic_id,
                    'user_id' => $s_id->id,
                    'attended_classes' => $row[1],
                    'total_classes' => $this->total_classes,
                    'status' => ucwords($row[2]),
                ]);
            }
        }
    }
}
