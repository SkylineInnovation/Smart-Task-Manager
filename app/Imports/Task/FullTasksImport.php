<?php

namespace App\Imports\Task;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullTasksImport implements ToCollection, WithHeadingRow
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

            $desc = trim($row['desc']);

            $start_time = trim($row['start_time']);

            $end_time = trim($row['end_time']);

            $is_separate_task = trim($row['is_separate_task']);
            $comment_type = trim($row['comment_type']);
            $max_worning_count = trim($row['max_worning_count']);
            $sent_warnings = trim($row['sent_warnings']);
            $close_attempt = trim($row['close_attempt']);
            $priority_level = trim($row['priority_level']);

            $status = trim($row['status']);


            $task = Task::find($id);

            if (!$task) {
                $task = Task::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'title' => $title,
                    'desc' => $desc,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'is_separate_task' => $is_separate_task,
                    'comment_type' => $comment_type,
                    'max_worning_count' => $max_worning_count,
                    'sent_warnings' => $sent_warnings,
                    'close_attempt' => $close_attempt,
                    'priority_level' => $priority_level,
                    'status' => $status,
                ]);
            } else {
                $task->update([
                    'slug' => $slug,


                    'title' => $title,
                    'desc' => $desc,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'is_separate_task' => $is_separate_task,
                    'comment_type' => $comment_type,
                    'max_worning_count' => $max_worning_count,
                    'sent_warnings' => $sent_warnings,
                    'close_attempt' => $close_attempt,
                    'priority_level' => $priority_level,
                    'status' => $status,
                ]);
            }
        }
    }
}
