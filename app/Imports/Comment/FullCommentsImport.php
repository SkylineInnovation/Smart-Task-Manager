<?php

namespace App\Imports\Comment;

use App\Models\Comment;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullCommentsImport implements ToCollection, WithHeadingRow
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

            $replay_time = trim($row['replay_time']);


            $comment = Comment::find($id);

            if (!$comment) {
                $comment = Comment::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'title' => $title,
                    'desc' => $desc,
                    'replay_time' => $replay_time,
                ]);
            } else {
                $comment->update([
                    'slug' => $slug,


                    'title' => $title,
                    'desc' => $desc,
                    'replay_time' => $replay_time,
                ]);
            }
        }
    }
}
