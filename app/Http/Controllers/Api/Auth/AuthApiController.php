<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\SendForgetPasswordCode;
use App\Models\DeviceTokenList;
use App\Models\OtpSendCode;
use App\Models\PasswordCode;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthApiController extends Controller
{
    public function checkUserPhone(Request $request)
    {
        $request->validate(['phone' => 'required']);
        $user = User::whereSearch('phone', $request->phone)->first();

        if (!$user)
            return response()->json([
                "message" => "user not found",
                "show_message" => false,
                "have_more" => false,
                "data" => [
                    'user' => "user not found",
                    'can_sign_up' => true,
                    'can_login' => false,
                ],
            ], 450);

        if (!$user->hasRole('customer'))
            return response()->json([
                "message" => "sorry only customers can use the app",
                "show_message" => true,
                "have_more" => false,
                "data" => [
                    'user' => "sorry only customers can use the app",
                    'can_sign_up' => false,
                    'can_login' => false,
                ],
            ], 450);

        return response()->json([
            "message" => "user already exiset",
            "show_message" => true,
            "have_more" => false,
            "data" => [
                'user' => "phone already exiset",
                'can_sign_up' => false,
                'can_login' => true,
            ],
        ], 210);
    }

    public function sendOtpCode(Request $request)
    {
        $phone_number = $request->input('phone');
        $type = $request->input('type', 'login');
        $applecation = $request->input('applecation', 'customer');
        $signature = $request->input('signature');

        $user_id = 0;
        if ($type == 'login') {
            $user = User::where('phone', $phone_number)->first();
            if ($user) $user_id = $user->id;
        }

        $phone_number = str_replace(
            ['+', '962077', '962078', '962079'],
            ['', '96277', '96278', '96279'],
            $phone_number,
        );


        if ($phone_number == '962782562016' || $phone_number == '962798652431') {
            $otpSendCode = OtpSendCode::create([
                'user_id' => $user_id,
                'otp_code' => '123456',
                'phone_number' => $phone_number,
                'applecation' => $applecation,
                'code_status' => 'pending',
            ]);
        } else {
            $otp_code = rand(100000, 999999);
            $otpSendCode = OtpSendCode::create([
                'user_id' => $user_id,
                'otp_code' => $otp_code,
                'phone_number' => $phone_number,
                'applecation' => $applecation,
                'code_status' => 'pending',
            ]);

            $sms_body = "Thanks for using Our App your OTP is $otp_code, $signature"; // , $signature

            $senderid = env('senderid', 'Takeh%20Car');
            $accname = env('accname', 'takehcar');
            $accPass = env('accPass', 'rX3lL6oS9nC6zE9z');

            $url = "https://josmsservice.com/SMSServices/Clients/Prof/SingleSMS/SMSService.asmx/SendSMS?senderid=$$senderid&numbers=$phone_number&accname=$$accname&AccPass=$accPass&msg=$sms_body&id=" . $otpSendCode->id;

            try {
                $response = Http::timeout(30)->get($url);
            } catch (\Throwable $th) {
                // Log::alert("th => " . json_encode($th));

                $url = "https://josmsservice.com/SMSServices/Clients/Prof/RestSingleSMS/SendSMS?senderid=$$senderid&numbers=$phone_number&accname=$$accname&AccPass=$accPass&msg=$sms_body&id=" . $otpSendCode->id;
                $response = Http::timeout(30)->get($url);

                // Log::alert("response -> " . json_encode($response));
            }

            // https://josmsservice.com/SMSServices/Clients/Prof/RestSingleSMS/SendSMS?senderid=codexal OTP&amp;numbers=9627********&amp;accname=codexal&amp;AccPass=bS1xI5eY2eQ2cL0l&amp;msg=SMSBODY

            // Log::alert("response -> " . json_encode($response));

            $otpSendCode->update([
                'back_response' => $response,
            ]);
        }

        return response()->json([
            "message" => "successfully Send OTP",
            "data" => [
                'otp_send' => true,
            ],
        ], 201);
    }

    public function checkOtpCode(Request $request)
    {
        $phone_number = $request->input('phone');
        $type = $request->input('type', 'login');
        $otp_code = $request->input('otp_code');

        $phone_number = str_replace(
            ['+', '962077', '962078', '962079'],
            ['', '96277', '96278', '96279'],
            $phone_number,
        );

        $otpSendCode = OtpSendCode::where([
            'otp_code' => $otp_code,
            'phone_number' => $phone_number,
            'code_status' => 'pending',
        ])->first();

        if ($otpSendCode) {

            $otpSendCode->update(['code_status' => 'used']);

            return response()->json([
                "message" => "Valed OTP Code",
                "data" => [
                    'valed_otp' => true,
                ],
            ], 201);
        } else {
            return response()->json([
                "message" => "unvaled OTP Code",
                "data" => [
                    'valed_otp' => false,
                ],
            ], 209);
        }
    }

    public function checkUserEmail(Request $request)
    {
        $request->validate(['email' => 'required']);
        $user = User::whereSearch('email', $request->email)->first();

        if (!$user)
            return response()->json([
                "message" => "user not found",
                "show_message" => false,
                "have_more" => false,
                "data" => [
                    'user' => "user not found",
                    'can_sign_up' => true,
                    'can_login' => false,
                ],
            ], 450);

        return response()->json([
            "message" => "user found",
            "data" => [
                'user' => "user found",
                'can_sign_up' => false,
                'can_login' => true,
            ],
        ], 210);
    }

    public function signUp(Request $request)
    {
        // $request->validate([
        //     'phone' => 'string|unique:users,phone',
        //     'email' => 'string|unique:users,email',
        //     // 'user_name' => 'string|unique:users,user_name',
        // ]);

        $image = $request->has('image') ? HomeApiController::saveImageApi(json_decode($request->image, true), 'user') : '';

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'is_email_verified' => false,
            // 'email_verified_at' => $request->email_verified_at,
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'fire_base_uid' => $request->input('fire_base_phone_uid'),
            'is_phone_verified' => false,
            'device_token' => $request->input('device_token'),
            'fire_base_phone_uid' => $request->input('fire_base_phone_uid'),
            'fire_base_google_uid' => $request->input('fire_base_google_uid'),
            'fire_base_facebook_uid' => $request->input('fire_base_facebook_uid'),
            'fire_base_apple_uid' => $request->input('fire_base_apple_uid'),
            'gender' => $request->input('gender'),
            'birth_day' => $request->input('birth_day'),
            'language' => $request->input('language'),

            'image' => $image,

            'status' => 'active',
            'last_time_use' => date('Y-m-d h:i:s A'),
            // 'active_until' => $request->active_until,
        ]);


        $device_token = $request->input('device_token', null);
        if ($device_token) {
            $token = DeviceTokenList::where([
                'user_id' => $user->id,
                'device_token' => $device_token,
                'device_type' => $request->header('device_type'),
                'application' => $request->header('application'),
            ])->latest()->first();

            if ($token == null)
                DeviceTokenList::create([
                    'user_id' => $user->id,
                    'device_token' => $device_token,
                    'device_type' => $request->header('device_type'),
                    'application' => $request->header('application'),
                ]);
        }

        $role = Role::where('name', 'customer')->first();
        $user->attachRole($role);

        $tokenResult = $user->createToken('customer access client');


        return response()->json([
            "message" => "successfully created account",
            "data" => [
                'access_token' => $tokenResult->accessToken,
                'user' => new UserResource($user),
                'token_type' => 'Bearer',
                'can_sign_up' => false,
                'can_login' => true,
            ],
        ], 201);
    }


    public function logIn(Request $request)
    {
        $log_in_way = $request->input('log_in_way');

        if ($request->has('phone'))
            $user = User::where('phone', $request->phone)->first();
        else if ($request->has('email'))
            $user = User::where('email', $request->email)->first();


        if (!$user)
            return response()->json([
                "message" => "user not found",
                "show_message" => false,
                "have_more" => false,
                "data" => [
                    'user' => "user not found",
                    'can_sign_up' => true,
                    'can_login' => false,
                ],
            ], 450);

        if (!$user->hasRole('customer'))
            return response()->json([
                "message" => "sorry only customers can use the app",
                "show_message" => true,
                "have_more" => false,
                "data" => [
                    'user' => "sorry only customers can use the app",
                    'can_sign_up' => false,
                    'can_login' => false,
                ],
            ], 450);

        if ($request->has('phone')) {
            if ($user->fire_base_phone_uid == null)
                $user->update(['fire_base_phone_uid' => $request->fire_base_phone_uid]);

            if ($request->has('password')) {
                if ($user->password == null) $user->update(['password' => Hash::make($request->password)]);
                $user = User::find($user->id);

                if (!Hash::check($request->password, $user->password)) return response()->json([
                    "message" => "password not correct",
                    "show_message" => true,
                    "data" => ['user' => "password not correct", 'can_sign_up' => true, 'can_login' => false,],
                ], 450);
            }
        } else {
            if ($log_in_way == 'google') {
                if ($user->fire_base_google_uid == null) $user->update(['fire_base_google_uid' => $request->fire_base_google_uid]);
                if ($user->fire_base_google_uid != $request->fire_base_google_uid) return response()->json(["message" => "user not found"], 450);
            } elseif ($log_in_way == 'facebook') {
                if ($user->fire_base_facebook_uid == null) $user->update(['fire_base_facebook_uid' => $request->fire_base_facebook_uid]);
                if ($user->fire_base_facebook_uid != $request->fire_base_facebook_uid) return response()->json(["message" => "user not found"], 450);
            } elseif ($log_in_way == 'apple') {
                if ($user->fire_base_apple_uid == null) $user->update(['fire_base_apple_uid' => $request->fire_base_apple_uid]);
                if ($user->fire_base_apple_uid != $request->fire_base_apple_uid) return response()->json(["message" => "user not found"], 450);
            } else {
                if ($user->password == null) $user->update(['password' => Hash::make($request->password)]);
                if (!Hash::check($request->password, $user->password)) return response()->json([
                    "message" => "password not correct",
                    "show_message" => true,
                    "data" => ['user' => "password not correct", 'can_sign_up' => true, 'can_login' => false,],
                ], 450);
            }
        }

        $user->update([
            'device_token' => $request->device_token,
            'last_time_use' => date('Y-m-d h:i:s A'),
            'language' => $request->header('lang', 'en'),
        ]);

        $device_token = $request->input('device_token', null);
        if ($device_token) {

            $token = DeviceTokenList::where([
                'user_id' => $user->id,
                'device_token' => $device_token,
                'device_type' => $request->header('device_type'),
                'application' => $request->header('application'),
            ])->latest()->first();

            if ($token == null)
                DeviceTokenList::create([
                    'user_id' => $user->id,
                    'device_token' => $device_token,
                    'device_type' => $request->header('device_type'),
                    'application' => $request->header('application'),
                ]);
        }

        // foreach (User::find($user->id)->tokens as $token)
        //     $token->revoke();

        $tokenResult = $user->createToken('customer access client');

        return response()->json([
            "message" => "successfully log in",
            "show_message" => false,
            "have_more" => false,
            "data" => [
                'access_token' => $tokenResult->accessToken,
                'user' => new UserResource($user),
                'token_type' => 'Bearer',
                'can_sign_up' => false,
                'can_login' => true,
            ],
        ]);
    }

    public function user(Request $request)
    {
        $user = $request->user();
        // $lang = $request->header('lang', 'en');

        $user->update([
            'device_token' => $request->device_token,
            'last_time_use' => date('Y-m-d h:i:s A'),
            'language' => $request->header('lang', 'en'),
        ]);

        $device_token = $request->input('device_token', null);
        if ($device_token) {

            $token = DeviceTokenList::where([
                'user_id' => $user->id,
                'device_token' => $device_token,
                'device_type' => $request->header('device_type'),
                'application' => $request->header('application'),
            ])->latest()->first();

            if ($token == null)
                DeviceTokenList::create([
                    'user_id' => $user->id,
                    'device_token' => $device_token,
                    'device_type' => $request->header('device_type'),
                    'application' => $request->header('application'),
                ]);
        }

        return response()->json([
            "message" => "successfully get user",
            "show_message" => false,
            "have_more" => false,
            "data" => [
                'user' => new UserResource($user),
            ],
        ]);
    }

    public function logOut(Request $request)
    {
        $user = $request->user();
        // foreach ($user->token() as $token) $token->revoke();
        $user->token()->revoke();
        $user->update(['device_token' => null]);

        return response()->json([
            "message" => "successfully logged out",
            "show_message" => false,
            "have_more" => false,
            "data" => ['user' => "successfully logged out",],
        ], 213);
    }

    public function updateInfo(Request $request)
    {
        $user = $request->user();


        $already_email = User::where('id', '!=', $user->id)->where('email', $request->email)->latest()->first();

        if ($already_email)
            return response()->json([
                "message" => "sorry email already used",
                "show_message" => true,
                "data" => [
                    'user' => new UserResource($user),
                    'update' => false,
                ],
            ], 202);

        // 

        $already_phone = User::where('id', '!=', $user->id)->where('phone', $request->phone)->latest()->first();

        if ($already_phone)
            return response()->json([
                "message" => "sorry phone already used",
                "show_message" => true,
                "data" => [
                    'user' => new UserResource($user),
                    'update' => false,
                ],
            ], 202);

        // 

        if ($request->has('first_name')) $user->first_name = $request->first_name;
        if ($request->has('last_name')) $user->last_name = $request->last_name;
        if ($request->has('user_name')) $user->user_name = $request->user_name;
        if ($request->has('email')) $user->email = $request->email;
        if ($request->has('is_email_verified')) $user->is_email_verified = $request->is_email_verified;
        if ($request->has('password')) $user->password = $request->password;
        if ($request->has('phone')) $user->phone = $request->phone;
        if ($request->has('fire_base_uid')) $user->fire_base_uid = $request->fire_base_uid;
        if ($request->has('is_phone_verified')) $user->is_phone_verified = $request->is_phone_verified;
        if ($request->has('device_token')) $user->device_token = $request->device_token;
        if ($request->has('fire_base_phone_uid')) $user->fire_base_phone_uid = $request->fire_base_phone_uid;
        if ($request->has('fire_base_google_uid')) $user->fire_base_google_uid = $request->fire_base_google_uid;
        if ($request->has('fire_base_facebook_uid')) $user->fire_base_facebook_uid = $request->fire_base_facebook_uid;
        if ($request->has('fire_base_apple_uid')) $user->fire_base_apple_uid = $request->fire_base_apple_uid;
        if ($request->has('gender')) $user->gender = $request->gender;
        if ($request->has('birth_day')) $user->birth_day = $request->birth_day;
        if ($request->has('language')) $user->language = $request->language;

        $user->save();

        if ($request->has('image')) {
            $userLast = User::find($user->id);

            $image = $request->input('image');
            $json_image = $image != null ? json_decode($image, true) : null;
            $image_url = HomeApiController::saveImageApi($json_image, 'user');

            $userLast->update(['image' => $image_url]);
        }


        return response()->json([
            "message" => "successfully updated",
            "show_message" => true,
            "data" => [
                'user' => new UserResource($user),
                'update' => true,
            ],
        ], 202);
    }

    public function chickNumberStep1(Request $request)
    {
        $user = $request->user();
        $old_fire_base_phone_uid = $request->input('old_fire_base_phone_uid');
        $old_phone = $request->input('old_phone');

        if ($user->phone != $old_phone && $user->fire_base_phone_uid != $old_fire_base_phone_uid)
            return response()->json(["message" => "data is false", "data" => ['data_is_true' => false,]], 211);

        return response()->json([
            "message" => "data is true",
            "data" => ['data_is_true' => true,],
        ], 210);
    }

    public function chickNumberStep2(Request $request)
    {
        $user = $request->user();
        $old_fire_base_phone_uid = $request->input('old_fire_base_phone_uid');
        $old_phone = $request->input('old_phone');
        $new_fire_base_phone_uid = $request->input('new_fire_base_phone_uid');
        $new_phone = $request->input('new_phone');

        if ($user->phone != $old_phone && $user->fire_base_phone_uid != $old_fire_base_phone_uid)
            return response()->json(["message" => "data is update", "data" => ['data_is_update' => false,]], 211);

        $user->update([
            'fire_base_phone_uid' => $new_fire_base_phone_uid,
            'phone' => $new_phone,
        ]);

        return response()->json([
            "message" => "data is update",
            "data" => ['data_is_update' => true,],
        ], 210);
    }

    public function sendForgetPasswordCode(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user)
            return response()->json([
                "message" => "user not found",
                "show_message" => true,
                "have_more" => false,
                "data" => [
                    'error' => 'user not found',
                    'code_send' => false,
                ],
            ], 450);

        $ip = $request->ip();
        // $location = Location::get($ip);
        // $user = $request->user();

        if (env('SEND_MAIL', false))
            Mail::to($user->email)->send(new SendForgetPasswordCode($user, $ip));

        return response()->json([
            "message" => "code send",
            "show_message" => false,
            "have_more" => false,
            "data" => ['code_send' => true,],
        ], 210);
    }

    public function checkForgetPasswordCode(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $code = $request->input('code');

        $passCode = PasswordCode::where('code', $code)->where('user_id', $user->id)->first();

        if (!$passCode)
            return response()->json([
                "message" => "code not found",
                "show_message" => false,
                "have_more" => false,
                "data" => [
                    'error' => 'code not found',
                    'continue' => false,
                ],
            ], 450);

        $passCode->update(['is_used' => true]);

        return response()->json([
            "message" => "code found",
            "show_message" => false,
            "have_more" => false,
            "data" => ['good_code' => true, 'continue' => true,],
        ], 210);
    }

    public function setNewPassword(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $code = $request->input('code');
        $new_password = $request->input('new_password');

        $passCode = PasswordCode::where('code', $code)->where('user_id', $user->id)->first();

        if (!$passCode && !$passCode->is_used)
            return response()->json([
                "message" => "code not found",
                "show_message" => false,
                "have_more" => false,
                "data" => [
                    'error' => 'code not found',
                    'continue' => false,
                ],
            ], 450);

        $user->update(['password' => Hash::make($new_password)]);

        return response()->json([
            "message" => "password changed",
            "show_message" => false,
            "have_more" => false,
            "data" => ['change_password' => true, 'continue' => true,],
        ], 210);
    }

    public function deleteAccount(Request $request)
    {
        $user = $request->user();

        $user->update([
            'phone' => '0-0-' . Str::random(5) . '--' . $user->phone . '--',
            'email' => '0-0-' . Str::random(5) . '--' . $user->email . '--',
            'fire_base_uid' => null,
            'device_token' => null,
        ]);

        $user->token()->revoke();

        $user->delete();

        return response()->json([
            "message" => "user deleteed",
            "data" => [
                'user_deleted' => true,
            ],
        ], 209);
    }
}
