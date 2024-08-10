<?php

namespace App\Imports\DeviceTokenList;

use App\Models\DeviceTokenList;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullDeviceTokenListsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $device_info = trim($row['device_info']);

            $device_type = trim($row['device_type']);

            $application = trim($row['application']);

            $device_token = trim($row['device_token']);


            $devicetokenlist = DeviceTokenList::find($id);

            if (!$devicetokenlist) {
                $devicetokenlist = DeviceTokenList::create([
                    'slug' => $slug,


                    'device_info' => $device_info,
                    'device_type' => $device_type,
                    'application' => $application,
                    'device_token' => $device_token,
                ]);
            } else {
                $devicetokenlist->update([
                    'slug' => $slug,


                    'device_info' => $device_info,
                    'device_type' => $device_type,
                    'application' => $application,
                    'device_token' => $device_token,
                ]);
            }
        }
    }
}
