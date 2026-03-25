<?php

namespace Pterodactyl\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;
use Pterodactyl\Models\User;
use Pterodactyl\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Handle a registration request.
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Generate verification code
        $verification_code = Str::random(6);

        // Temporarily store registration data in session (or use a temp table if preferred)
        $request->session()->put('registration', [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'verification_code' => $verification_code,
        ]);

        // Send verification code via email
        Mail::raw("Ihr Bestätigungscode: $verification_code", function ($message) use ($request) {
            $message->to($request->input('email'));
            $message->subject('Ihr Bestätigungscode');
        });

        return response()->json(['message' => 'Bestätigungscode gesendet. Bitte prüfen Sie Ihre E-Mail.']);
    }

    /**
     * Handle verification of the code and create the user.
     */
    public function verify(Request $request): JsonResponse
    {
        $code = $request->input('code');
        $registration = $request->session()->get('registration');
        if (!$registration || $registration['verification_code'] !== $code) {
            return response()->json(['error' => 'Ungültiger Code.'], 400);
        }

        // Create user
        $user = User::create([
            'username' => $registration['username'],
            'email' => $registration['email'],
            'password' => $registration['password'],
            'email_verified' => true,
        ]);
        // Remove registration session
        $request->session()->forget('registration');

        return response()->json(['message' => 'Registrierung erfolgreich. Sie können sich jetzt anmelden.']);
    }
}
