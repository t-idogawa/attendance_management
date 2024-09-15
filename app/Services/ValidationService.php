<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class ValidationService
{
    public function validateUserRegistration($request)
    {
        return Validator::make($request->all(), [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name_kana' => 'required|string|max:255',
            'first_name_kana' => 'required|string|max:255',
            'gender' => 'required|integer|in:0,1,2',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:11',
            'birthday' => 'required|date',
            'post_code' => 'required|string|max:7',
            'address' => 'required|string|max:255',
            'store_id' => 'required|string|max:26',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    }
}