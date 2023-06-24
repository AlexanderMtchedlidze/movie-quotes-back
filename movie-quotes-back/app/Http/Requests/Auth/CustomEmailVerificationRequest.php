<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CustomEmailVerificationRequest extends FormRequest
{
    public function fulfill(Request $request): void
    {

    }
}
