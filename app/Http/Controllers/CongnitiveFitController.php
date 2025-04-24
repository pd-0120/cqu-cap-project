<?php

namespace App\Http\Controllers;

use App\Models\User;
use CognifitSdk\Api\HealthCheck;
use CognifitSdk\Api\Client;
use Illuminate\Http\Request;
use CognifitSdk\Api\UserAccessToken;
use CognifitSdk\Api\UserActivity;
use Illuminate\Support\Facades\Http;

class CongnitiveFitController extends Controller
{
    public string $clientId;
    public string $clientSecret;

    public function __construct()
    {
        $this->clientId = config("app.cognifit.client");
        $this->clientSecret = config("app.cognifit.secret");
    }
    public function addUser(User $user)
    {

        $cognifitApiHealthCheck = new HealthCheck(
            $this->clientId,
            $this->clientSecret,
        );
        $response = $cognifitApiHealthCheck->getInfo();

        // dd($response);
    }

    public function getUserAccessToken()
    {

        $cognifitUserToken          = 'FgJTTZ8zFWyZ9mtZNg4jMnptx1MHHEZT0K2Nruwj+6F+TeJhFLQoj5jNmFNZ8yOELCUNkwI1WKqKMhFj3mmEPA==';
        $cognifitApiUserAccessToken = new UserAccessToken(
            env('COGNI_FIT_CLIENT_ID'),
            env('COGNI_FIT_CLIENT_SECRET')
        );
        $response = $cognifitApiUserAccessToken->issue($cognifitUserToken);
        return $response;
    }

    public function getCognifitJSversion() {
        $response = Http::get('https://api.cognifit.com/description/versions/sdkjs?v=2.0');
        return $response->json('version');
    }
}
