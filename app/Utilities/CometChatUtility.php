<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Http;

class CometChatUtility
{
    public static function getApiKey()
    {
        return config('cometchat.api_key');
    }

    public static function getAppId()
    {
        return config('cometchat.app_id');
    }

    public static function getRegion()
    {
        return config('cometchat.region');
    }

    public static function createCometChatUser($userInfo)
    {
        $url = 'https://' . self::getAppId() . '.' . self::getRegion() . '.api.cometchat.io/v3/users';

        $payload = [
            'uid' => $userInfo->id,
            'name' => $userInfo->name,
            'metadata' => [
                '@private' => [
                    'email' => $userInfo->email
                ]
            ],
            'withAuthToken' => true
        ];


        $response = Http::withHeaders([
            'apikey' => self::getApiKey(),
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        // Check the response and handle accordingly
        if ($response->successful()) {
            // User created successfully
            $responseData = $response->json();
            // Additional logic or response handling
        } else {
            // Error occurred while creating the user
            $errorData = $response->json();
            // Additional error handling or response handling
        }
    }


    public static function sendMessageOnCometChat($sender, $receiver, $message)
    {
        // Implement the logic to send a message on CometChat API
    }

    // Add other static methods for additional functionalities
}
