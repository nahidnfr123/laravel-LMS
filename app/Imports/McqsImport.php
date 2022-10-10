<?php

namespace App\Imports;

use App\Models\Exam;
use App\Models\Mcq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class McqsImport implements ToCollection
{
    use Importable;

    public mixed $exam_id;

    public function __construct($exam_id = null)
    {
        $this->exam_id = $exam_id;
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Mcq::create([
                'exam_id' => $this->exam_id,
                'question' => $row[0],
                'a' => $row[1],
                'b' => $row[2],
                'c' => $row[3],
                'd' => $row[4],
                'e' => $row[5],
                'answer' => $row[6],
            ]);
        }
    }
}
