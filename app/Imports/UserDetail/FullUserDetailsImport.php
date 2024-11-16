<?php

namespace App\Imports\UserDetail;

use App\Models\UserDetail;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullUserDetailsImport implements ToCollection, WithHeadingRow
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

            $nationality = trim($row['nationality']);

            $id_number = trim($row['id_number']);

            $address = trim($row['address']);

            $qualification = trim($row['qualification']);

            $salary = trim($row['salary']);

            $home = trim($row['home']);

            $transport = trim($row['transport']);


            $userdetail = UserDetail::find($id);

            if (!$userdetail) {
                $userdetail = UserDetail::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'title' => $title,
                    'nationality' => $nationality,
                    'id_number' => $id_number,
                    'address' => $address,
                    'qualification' => $qualification,
                    'salary' => $salary,

                    'home' => $home,

                    'transport' => $transport,

                ]);
            } else {
                $userdetail->update([
                    'slug' => $slug,


                    'title' => $title,
                    'nationality' => $nationality,
                    'id_number' => $id_number,
                    'address' => $address,
                    'qualification' => $qualification,
                    'salary' => $salary,

                    'home' => $home,

                    'transport' => $transport,

                ]);
            }
        }
    }
}
