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

    // Create a user on CometChat API
    public static function createCometChatUser($userInfo)
    {
        // Set the URL for the API request to create a user
        $url = 'https://' . self::getAppId() . '.api-' . self::getRegion() . '.cometchat.io/v3/users';

        // Set the payload for the API request to create a user
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

        // Send the API request to create a user
        $response = Http::withHeaders([
            'apikey' => self::getApiKey(),
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

       return $response->json();
    }


    public static function sendMessageOnCometChat($sender, $receiver, $message)
    {
        // Implement the logic to send a message on CometChat API
    }

    // Add other static methods for additional functionalities
}
