<?php

namespace App\Imports\ExchangePermission;

use App\Models\ExchangePermission;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullExchangePermissionsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $content = trim($row['content']);

            $amount = trim($row['amount']);

            $request_date = trim($row['request_date']);

            $financial_director_response = trim($row['financial_director_response']);

            $financial_director_time = trim($row['financial_director_time']);

            $technical_director_response = trim($row['technical_director_response']);

            $technical_director_time = trim($row['technical_director_time']);

            $status = trim($row['status']);


            $exchangepermission = ExchangePermission::find($id);

            if (!$exchangepermission) {
                $exchangepermission = ExchangePermission::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'content' => $content,
                    'amount' => $amount,

                    'request_date' => $request_date,
                    'financial_director_response' => $financial_director_response,
                    'financial_director_time' => $financial_director_time,
                    'technical_director_response' => $technical_director_response,
                    'technical_director_time' => $technical_director_time,
                    'status' => $status,
                ]);
            } else {
                $exchangepermission->update([
                    'slug' => $slug,


                    'content' => $content,
                    'amount' => $amount,

                    'request_date' => $request_date,
                    'financial_director_response' => $financial_director_response,
                    'financial_director_time' => $financial_director_time,
                    'technical_director_response' => $technical_director_response,
                    'technical_director_time' => $technical_director_time,
                    'status' => $status,
                ]);
            }
        }
    }
}
