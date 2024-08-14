<?php

namespace App\Imports\ExtraTime;

use App\Models\ExtraTime;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullExtraTimesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $reason = trim($row['reason']);

            $result = trim($row['result']);

            $request_time = trim($row['request_time']);

            $from_time = trim($row['from_time']);
            $to_time = trim($row['to_time']);

            $response_time = trim($row['response_time']);

            $status = trim($row['status']);

            $duration = trim($row['duration']);


            $extratime = ExtraTime::find($id);

            if (!$extratime) {
                $extratime = ExtraTime::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'reason' => $reason,
                    'result' => $result,
                    'request_time' => $request_time,
                    'from_time' => $from_time,
                    'to_time' => $to_time,
                    'response_time' => $response_time,
                    'status' => $status,
                    'duration' => $duration,
                ]);
            } else {
                $extratime->update([
                    'slug' => $slug,


                    'reason' => $reason,
                    'result' => $result,
                    'request_time' => $request_time,
                    'from_time' => $from_time,
                    'to_time' => $to_time,
                    'response_time' => $response_time,
                    'status' => $status,
                    'duration' => $duration,
                ]);
            }
        }
    }
}
