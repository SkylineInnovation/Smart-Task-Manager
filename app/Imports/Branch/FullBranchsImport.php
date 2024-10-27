<?php

namespace App\Imports\Branch;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullBranchsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $name = trim($row['name']);

            $location = trim($row['location']);


            $branch = Branch::find($id);

            if (!$branch) {
                $branch = Branch::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'name' => $name,
                    'location' => $location,
                ]);
            } else {
                $branch->update([
                    'slug' => $slug,


                    'name' => $name,
                    'location' => $location,
                ]);
            }
        }
    }
}
