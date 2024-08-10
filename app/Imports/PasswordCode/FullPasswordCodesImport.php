<?php

namespace App\Imports\PasswordCode;

use App\Models\PasswordCode;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullPasswordCodesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $code = trim($row['code']);

            $note = trim($row['note']);

            $is_used = trim($row['is_used']);

            $ip_address = trim($row['ip_address']);


            $passwordcode = PasswordCode::find($id);

            if (!$passwordcode) {
                $passwordcode = PasswordCode::create([
                    'slug' => $slug,


                    'code' => $code,
                    'note' => $note,
                    'is_used' => $is_used,
                    'ip_address' => $ip_address,
                ]);
            } else {
                $passwordcode->update([
                    'slug' => $slug,


                    'code' => $code,
                    'note' => $note,
                    'is_used' => $is_used,
                    'ip_address' => $ip_address,
                ]);
            }
        }
    }
}
