<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Utilities\CometChatUtility;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Custom messages for UTM email address validation
        $messages = array(
            'email.regex' => 'The email must be a valid UTM email address.',
            'email.unique' => 'The email has already been registered.',
            // 'utm_id' => 'UTM ID must be unique and not empty',
        );


        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^(.*)utm\.my$/i'],
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required|same:password',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'utm_id' => ['required','string','max:255','unique:users'],

        ], $messages)->validate();

        $newUser = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'utm_id' => $input['utm_id'],
            'password' => Hash::make($input['password']),
            'address' => $input['address'],
            'phone' => $input['phone'],
            'role_code' => $input['role'],
        ]);

        $responseCometChat = CometChatUtility::createCometChatUser($newUser);

        if ($responseCometChat['data']['authToken'] != null) {
            $newUser->cometchat_auth_token = $responseCometChat['data']['authToken'];
            $newUser->save();
        } else {
            $newUser->delete();
            abort(400, 'Error creating user on CometChat');
        }

        return $newUser;
    }
}
