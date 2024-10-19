<?php

namespace App\Imports\Department;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullDepartmentsImport implements ToCollection, WithHeadingRow
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


            $department = Department::find($id);

            if (!$department) {
                $department = Department::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'name' => $name,
                ]);
            } else {
                $department->update([
                    'slug' => $slug,


                    'name' => $name,
                ]);
            }
        }
    }
}
