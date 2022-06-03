<?php

namespace App\Http\Controllers\Auth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class ApiLoginController extends Controller
{
    public function login(){
        return view('auth.login2');
    }
    public function loginData(Request $request)
    {
        $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

        $email = $request->email;
        $password = $request->password;

        $url = "http://127.0.0.1:8000/api/login";

       try {
            $client = new Client();
            $response = $client->request('POST', $url, [
                'json' => ['email' => $email, 'password' => $password]
            ]);

            $user = json_decode($response->getBody());
            $userId = $user->user->id;

            Auth::loginUsingId($userId);

            return redirect()->route('home');

        } catch (\Exception $exception) {
            return redirect()->route('apiLogin')->with('errorMsg', 'User Not Found or Something Wrong with Error: '.$exception->getMessage());
        }
    }
}
