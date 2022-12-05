<?php

namespace App\Imports;

use App\Models\Mark;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;

class MarkImport implements ToCollection
{
    use Importable;

    public mixed $batch_id, $total_mark;

    public function __construct($topic_id = null, $total_mark = null)
    {
        $this->topic_id = $topic_id;
        $this->total_mark = $total_mark;
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $s_id = User::where('s_id', $row[0])->first();
            if (!empty($s_id) && $row[0]) {
                Mark::updateOrCreate([
                    'topic_id' => $this->topic_id,
                    'user_id' => $s_id->id,
                ], [
                    'topic_id' => $this->topic_id,
                    'user_id' => $s_id->id,
                    'obtained_mark' => $row[1],
                    'total_mark' => $this->total_mark,
                    'status' => ucwords($row[2]),
                ]);
            }
        }
    }
}
