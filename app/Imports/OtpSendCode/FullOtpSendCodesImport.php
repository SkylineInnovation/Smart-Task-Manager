<?php

namespace App\Imports\OtpSendCode;

use App\Models\OtpSendCode;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FullOtpSendCodesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $id = trim($row['id']);
            $slug = trim($row['slug']);


            $otp_code = trim($row['otp_code']);

            $phone_number = trim($row['phone_number']);

            $applecation = trim($row['applecation']);

            $code_status = trim($row['code_status']);

            $back_response = trim($row['back_response']);


            $otpsendcode = OtpSendCode::find($id);

            if (!$otpsendcode) {
                $otpsendcode = OtpSendCode::create([
                    'slug' => $slug,


                    'otp_code' => $otp_code,
                    'phone_number' => $phone_number,
                    'applecation' => $applecation,
                    'code_status' => $code_status,
                    'back_response' => $back_response,
                ]);
            } else {
                $otpsendcode->update([
                    'slug' => $slug,


                    'otp_code' => $otp_code,
                    'phone_number' => $phone_number,
                    'applecation' => $applecation,
                    'code_status' => $code_status,
                    'back_response' => $back_response,
                ]);
            }
        }
    }
}
