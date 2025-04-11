<?php

namespace App\Http\Controllers;

use App\Models\User;
use CognifitSdk\Api\HealthCheck;
use CognifitSdk\Api\Client;
use Illuminate\Http\Request;

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
}
