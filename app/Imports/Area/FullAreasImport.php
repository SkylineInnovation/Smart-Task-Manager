<?php

namespace App\Imports\Area;

use App\Models\Area;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullAreasImport implements ToCollection, WithHeadingRow
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


            $area = Area::find($id);

            if (!$area) {
                $area = Area::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'name' => $name,
                    'location' => $location,
                ]);
            } else {
                $area->update([
                    'slug' => $slug,


                    'name' => $name,
                    'location' => $location,
                ]);
            }
        }
    }
}
