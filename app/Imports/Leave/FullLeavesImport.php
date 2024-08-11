<?php

namespace App\Imports\Leave;

use App\Models\Leave;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullLeavesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $type = trim($row['type']);

            $time_out = trim($row['time_out']);

            $time_in = trim($row['time_in']);

            $reason = trim($row['reason']);

            $result = trim($row['result']);

            $status = trim($row['status']);

            $accepted_time = trim($row['accepted_time']);


            $leave = Leave::find($id);

            if (!$leave) {
                $leave = Leave::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'type' => $type,
                    'time_out' => $time_out,
                    'time_in' => $time_in,
                    'reason' => $reason,
                    'result' => $result,
                    'status' => $status,
                    'accepted_time' => $accepted_time,
                ]);
            } else {
                $leave->update([
                    'slug' => $slug,


                    'type' => $type,
                    'time_out' => $time_out,
                    'time_in' => $time_in,
                    'reason' => $reason,
                    'result' => $result,
                    'status' => $status,
                    'accepted_time' => $accepted_time,
                ]);
            }
        }
    }
}
