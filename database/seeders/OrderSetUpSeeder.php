<?php

namespace Database\Seeders;

use App\Models\Applang;
use App\Models\Apptext;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderSetUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'slug' => 'pending',
                'name' => ['ar' => 'قيد الانتظار', 'en' => 'Pending',],
                'color' => '#00ff00',
                // 'citys' => [
                //     ['ar' => 'عمان', 'en' => 'Amman',],
                // ],
            ],
        ];

        // foreach ($statuses as $value) {
        //     $status = OrderStatus::where('slug', 'status-' . $value['slug'])->first();

        //     if (!$status) {
        //         $status = OrderStatus::create([
        //             'slug' => 'status-' . $value['slug'],
        //             'color' => $value['color'],
        //         ]);

        //         foreach ($value['name'] as $key => $val) {
        //             Apptext::create([
        //                 'applang_id' => Applang::where('code', $key)->first()->id,
        //                 'text' => $val,
        //                 'the_model_name' => 'OrderStatus',
        //                 'the_model_id' => $status->id,
        //                 'place' => 'name',
        //             ]);
        //         }
        //     }
        // }

        // // // // // // // // // 
        // // // // // // // // // 
    }
}
