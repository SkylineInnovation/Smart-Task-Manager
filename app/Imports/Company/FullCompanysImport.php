<?php

namespace App\Imports\Company;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullCompanysImport implements ToCollection, WithHeadingRow
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

            $address = trim($row['address']);

            $phone = trim($row['phone']);

            $number = trim($row['number']);

            $fax = trim($row['fax']);

            $email = trim($row['email']);

            $website = trim($row['website']);

            $commercial_register = trim($row['commercial_register']);


            $company = Company::find($id);

            if (!$company) {
                $company = Company::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'name' => $name,
                    'address' => $address,
                    'phone' => $phone,
                    'number' => $number,
                    'fax' => $fax,
                    'email' => $email,
                    'website' => $website,
                    'commercial_register' => $commercial_register,
                ]);
            } else {
                $company->update([
                    'slug' => $slug,


                    'name' => $name,
                    'address' => $address,
                    'phone' => $phone,
                    'number' => $number,
                    'fax' => $fax,
                    'email' => $email,
                    'website' => $website,
                    'commercial_register' => $commercial_register,
                ]);
            }
        }
    }
}
