<?php

namespace Database\Seeders;

use App\Models\Applang;
use App\Models\Appsetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $ar = Applang::where('code', 'ar')->first();
        // if (!$ar)
        //     Applang::create(['name' => 'عربي', 'code' => 'ar']);


        // $en = Applang::where('code', 'en')->first();
        // if (!$en)
        //     Applang::create(['name' => 'english', 'code' => 'en']);


        // $appSetting = Appsetting::get();
        // if (count($appSetting) == 0)
        //     Appsetting::create([
        //         'enable_ads' => false,
        //         'enable_chat' => true,
        //         'enable_facebook_login' => false,
        //         'enable_google_login' => true,
        //         'enable_apple_login' => false,
        //         'enable_email_login' => false,
        //         'enable_phone_login' => true,
        //         'contact_number' => '+962782562016',
        //         'contact_email' => 'info@olympiadsports.com',
        //         'contact_whats_app' => '+962782562016',
        //         'web_site_link' => 'olympiadsports.com',
        //         'facebook_link' => '',
        //         'instagram_link' => '',
        //         'snapchat_link' => '',
        //         'tiktok_link' => '',
        //         'twitter_link' => '',
        //         'messenger_link' => '',
        //         // 'about_app' => '',
        //         // 'faq_page' => '',
        //         // 'privacy_policy' => '',
        //         // 'terms_and_condition' => '',
        //         'app_version' => 1,
        //         'primary_color' => '#FF5200',
        //         'secoondery_color' => '#18587A',
        //         'border_color' => '#B0D8FF',
        //         'button_color' => '#FF5200',
        //         'icons_color' => '#FF5200',
        //     ]);

    }
}
