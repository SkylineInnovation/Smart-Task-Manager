<?php

namespace App\Imports\Work;

use App\Models\Work;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullWorksImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $job_title = trim($row['job_title']);


            $work = Work::find($id);

            if (!$work) {
                $work = Work::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'job_title' => $job_title,
                ]);
            } else {
                $work->update([
                    'slug' => $slug,


                    'job_title' => $job_title,
                ]);
            }
        }
    }
}
