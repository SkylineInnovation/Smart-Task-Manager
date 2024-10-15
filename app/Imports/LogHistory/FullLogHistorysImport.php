<?php

namespace App\Imports\LogHistory;

use App\Models\LogHistory;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullLogHistorysImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $action = trim($row['action']);

            $by_model_name = trim($row['by_model_name']);

            $by_model_id = trim($row['by_model_id']);

            $on_model_name = trim($row['on_model_name']);

            $on_model_id = trim($row['on_model_id']);

            $from_data = trim($row['from_data']);

            $to_data = trim($row['to_data']);

            $preaf = trim($row['preaf']);

            $desc = trim($row['desc']);

            $color = trim($row['color']);


            $loghistory = LogHistory::find($id);

            if (!$loghistory) {
                $loghistory = LogHistory::create([
                    'add_by' => auth()->user()->id,
                    'slug' => $slug,


                    'action' => $action,
                    'by_model_name' => $by_model_name,
                    'by_model_id' => $by_model_id,

                    'on_model_name' => $on_model_name,
                    'on_model_id' => $on_model_id,

                    'from_data' => $from_data,
                    'to_data' => $to_data,
                    'preaf' => $preaf,
                    'desc' => $desc,
                    'color' => $color,
                ]);
            } else {
                $loghistory->update([
                    'slug' => $slug,


                    'action' => $action,
                    'by_model_name' => $by_model_name,
                    'by_model_id' => $by_model_id,

                    'on_model_name' => $on_model_name,
                    'on_model_id' => $on_model_id,

                    'from_data' => $from_data,
                    'to_data' => $to_data,
                    'preaf' => $preaf,
                    'desc' => $desc,
                    'color' => $color,
                ]);
            }
        }
    }
}
