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

            $phone = trim($row['phone']);

            $number = trim($row['number']);

            $fax = trim($row['fax']);

            $email = trim($row['email']);

            $password = trim($row['password']);

            $website = trim($row['website']);

            $commercial_register = trim($row['commercial_register']);


            $branch = Branch::find($id);

            if (!$branch) {
                $branch = Branch::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'name' => $name,
                    'location' => $location,
                    'phone' => $phone,
                    'number' => $number,
                    'fax' => $fax,
                    'email' => $email,
                    'password' => $password,
                    'website' => $website,
                    'commercial_register' => $commercial_register,
                ]);
            } else {
                $branch->update([
                    'slug' => $slug,


                    'name' => $name,
                    'location' => $location,
                    'phone' => $phone,
                    'number' => $number,
                    'fax' => $fax,
                    'email' => $email,
                    'password' => $password,
                    'website' => $website,
                    'commercial_register' => $commercial_register,
                ]);
            }
        }
    }
}
