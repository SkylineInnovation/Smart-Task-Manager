<?php

namespace App\Imports\Discount;

use App\Models\Discount;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullDiscountsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $amount = trim($row['amount']);

            $reason = trim($row['reason']);


            $discount = Discount::find($id);

            if (!$discount) {
                $discount = Discount::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'amount' => $amount,
                    'reason' => $reason,
                ]);
            } else {
                $discount->update([
                    'slug' => $slug,


                    'amount' => $amount,
                    'reason' => $reason,
                ]);
            }
        }
    }
}
