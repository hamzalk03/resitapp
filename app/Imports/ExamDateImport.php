<?php

namespace App\Imports;

use App\Models\Resitexam_detail;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExamDateImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            // Ensure the row contains valid data
            if (isset($row['course_id'], $row['exam_date'], $row['exam_time'], $row['exam_hall'])) {
                // Insert the details into the resitexam_details table
                Resitexam_detail::create([
                    'course_id' => $row['course_id'],
                    'exam_date' => $row['exam_date'],
                    'exam_time' => $row['exam_time'],
                    'exam_hall' => $row['exam_hall'],
                ]);
            } else {
                Log::warning('Invalid row data: ' . json_encode($row));
            }
        } catch (\Exception $e) {
            Log::error('Error inserting resit exam details for course_id: ' . $row['course_id'] . ' - ' . $e->getMessage());
        }
    }
}