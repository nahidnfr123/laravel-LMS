<?php

namespace App\Imports;

use App\Models\Mcq;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    use Importable;

    public mixed $batch_id;

    public function __construct($batch_id = null)
    {
        $this->batch_id = $batch_id;
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::where('id', '=', $row[0])
                ->orWhere('email', '=', $row[2])
                ->orWhere('phone', '=', $row[3])
                ->first();
            Log::info($user);
            if (empty($user) && $row[0]) {
                $user = User::create([
                    'batch_id' => $this->batch_id,
//                'semester_id' => $this->semester_id,
//                'subject_id' => $this->subject_id,
                    'role' => 'student',
                    's_id' => $row[0],
                    'name' => $row[1],
                    'email' => $row[2],
                    'phone' => $row[3],
                    'avatar' => $row[4],
                    'dob' => $row[5],
                    'gender' => $row[6],
                    'password' => Hash::make($row[7]),
                    'fathers_name' => $row[8],
                    'fathers_phone' => $row[9],
                    'mothers_name' => $row[10],
                    'mothers_phone' => $row[11],
                    'present_address' => $row[12],
                    'permanent_address' => $row[13],
                ]);
                $user->assignRole('student');
            }
        }
    }
}
