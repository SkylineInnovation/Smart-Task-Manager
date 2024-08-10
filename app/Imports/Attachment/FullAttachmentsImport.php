<?php

namespace App\Imports\Attachment;

use App\Models\Attachment;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullAttachmentsImport implements ToCollection, WithHeadingRow
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


            $attachment = Attachment::find($id);

            if (!$attachment) {
                $attachment = Attachment::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'title' => $title,
                    'desc' => $desc,
                ]);
            } else {
                $attachment->update([
                    'slug' => $slug,


                    'title' => $title,
                    'desc' => $desc,
                ]);
            }
        }
    }
}
