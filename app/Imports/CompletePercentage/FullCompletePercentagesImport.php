<?php

namespace App\Imports\CompletePercentage;

use App\Models\CompletePercentage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullCompletePercentagesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);
            
            
                        $percentage = trim($row['percentage']);

                        $rate_text = trim($row['rate_text']);

                        $rate_val = trim($row['rate_val']);


            $completepercentage = CompletePercentage::find($id);

            if (!$completepercentage) {
                $completepercentage = CompletePercentage::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,

                    
                        'percentage' => $percentage,
                        'rate_text' => $rate_text,
                        'rate_val' => $rate_val,
                ]);
            } else {
                $completepercentage->update([
                    'slug' => $slug,

                    
                        'percentage' => $percentage,
                        'rate_text' => $rate_text,
                        'rate_val' => $rate_val,
                ]);
            }
        }
    }
}
