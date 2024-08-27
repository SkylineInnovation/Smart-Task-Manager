<?php

namespace App\Imports\DailyTask;

use App\Models\DailyTask;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullDailyTasksImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);
            
            
                        $title = trim($row['title']);

                        $description = trim($row['description']);

                        $start_time = trim($row['start_time']);

                        $end_time = trim($row['end_time']);

                        $proearty = trim($row['proearty']);

                        $status = trim($row['status']);

                        $repeat_time = trim($row['repeat_time']);

                        $repeat_evrey = trim($row['repeat_evrey']);


            $dailytask = DailyTask::find($id);

            if (!$dailytask) {
                $dailytask = DailyTask::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,

                    
                        'title' => $title,
                        'description' => $description,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'proearty' => $proearty,
                        'status' => $status,
                        'repeat_time' => $repeat_time,
                        'repeat_evrey' => $repeat_evrey,
                ]);
            } else {
                $dailytask->update([
                    'slug' => $slug,

                    
                        'title' => $title,
                        'description' => $description,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'proearty' => $proearty,
                        'status' => $status,
                        'repeat_time' => $repeat_time,
                        'repeat_evrey' => $repeat_evrey,
                ]);
            }
        }
    }
}
