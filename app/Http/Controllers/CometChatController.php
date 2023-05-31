<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CometChatController extends Controller
{
    public function index()
    {

        $role_code = Auth::user()->role_code;
        $authToken = Auth::user()->cometchat_auth_token;
        $widgetId = '';
        // If user is club
        if ($role_code == 'UR03') {
            $widgetId = '0983efdd-88c8-4fc9-a323-99c4de66b8de';
        } else {
            $widgetId = 'f2655b9a-c3dd-4047-8c47-b4d89d11ec2c';
        }

        return response()->json([
            'authToken' => $authToken,
            'widgetId' => $widgetId,
        ]);
    }
}
