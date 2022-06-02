<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login2(){
        $email = 'hosiqb@gmail.com';
        $password = '12345678';
        $url = "http://127.0.0.1:8000/api/login";


        $client = new Client();
        $response = $client->request('POST', $url, ['json' => [$email, $password]]);
        dd($response);

    // $response = Http::withBasicAuth($email, $password)->post($url);
    //    $data = json_decode($response->getBody());
    //      echo $response->getBody();

        // $client = new Client();
        // $response = $client->request('POST', $url, [
        //     'json' => ['email' => $email, 'password' => $password]
        // ]);
        // $data = json_decode($response->getBody());
        // echo $data->user->name;

        // $client = new Client();
        // $response = $client->request('POST',$url, [
        //             'json' => ['email' => $email, 'password' => $password],
        //             'headers' => ['Content-Type' => 'application/json']
        //             ]);
        // $data = json_decode($response->getBody());
        // echo $data->user->name.'<br>';
        // echo $data->token;

            // dd(($response)->getStatusCode());
             //dd(($response));
            // dd($response->getBody()->getContents());
                //$user = $response->getBody()->getContents();
                //return $user->user->name;

              // echo $response->getBody();

                // $client = new Client();
                // $credentials = base64_encode('hosiqb@gmail.com:12345678');
                // $response = $client->post($url,
                //         [
                //             'headers' => [
                //                 'Authorization' => 'Basic' . $credentials,
                //             ],
                //         ]);
              //  echo $response->getBody();
              //dd(($response)->getStatusCode());

            //   $response = Http::withBasicAuth($email,$password)
            //   ->post($url);
            //   echo $response->getBody();




    }
}
