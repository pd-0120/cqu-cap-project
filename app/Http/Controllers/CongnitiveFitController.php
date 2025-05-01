<?php

namespace App\Http\Controllers;

use App\Models\User;
use CognifitSdk\Api\UserAccessToken;
use CognifitSdk\Api\UserAccount;
use Illuminate\Support\Facades\Http;
use CognifitSdk\Lib\UserData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use CognifitSdk\Api\UserActivity;


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
        $userName               = $user->full_name;
        $userEmail              = $user->email;
        $userBirth              = $user->dob->toDateString();
        $locale                 = 'en';

        $cognifitApiUserAccount = new UserAccount(
            $this->clientId,
            $this->clientSecret,
        );

        $response = $cognifitApiUserAccount->registration(new UserData([
            'user_name'     => $userName,
            'user_email'    => $userEmail,
            'user_birthday' => $userBirth,
            'user_locale'   => $locale,
            'user_password' => "E80i0c2$"
        ]));

        if (!$response->hasError()) {
            $cognifitUserToken = $response->get('user_token');
            if ($cognifitUserToken) {
                $user->cognifit_user_token = $cognifitUserToken;;
                $user->save();

                return true;
            }
        } else {
            Log::warning($response->getError());
            Session::flash('message.level', 'danger');
            Session::flash('message.content', $response->getError());
        }

        return true;
    }

    public function getUserAccessToken($user)
    {
        $cognifitUserToken = $user->cognifit_user_token;

        $cognifitApiUserAccessToken = new UserAccessToken(
            $this->clientId,
            $this->clientSecret,
        );
        $response = $cognifitApiUserAccessToken->issue($cognifitUserToken);

        return $response;
    }

    public function getCognifitJSversion()
    {
        $response = Http::get('https://api.cognifit.com/description/versions/sdkjs?v=2.0');
        return $response->json('version');
    }

    public function deleteAllCognifitAccounts()
    {
        $response = Http::post('https://api.cognifit.com/get-users-list', [
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret,
            "initial_value" => 0,
            "total_points" => 50
        ]);
        $userAccounts = $response->json('userAccounts');

        foreach ($userAccounts as $userAccount) {
            $userToken              = $userAccount['user_token'];
            $cognifitApiUserAccount = new UserAccount(
                $this->clientId,
                $this->clientSecret,
            );
            $response = $cognifitApiUserAccount->delete($userToken);
        }
    }

    public function getHistoricalScore(User $user)
    {
        $cognifitUserToken = $user->cognifit_user_token;

        $cognifitApiUserActivity = new UserActivity(
            $this->clientId,
            $this->clientSecret,
        );

        $response = $cognifitApiUserActivity->getHistoricalScoreAndSkills($cognifitUserToken);
        if (!$response->hasError()) {
        }
        return $response;
    }

    public function getPlayedGames(User $user)
    {
        $cognifitUserToken = $user->cognifit_user_token;

        $cognifitApiUserActivity = new UserActivity(
            $this->clientId,
            $this->clientSecret,
        );

        $response = $cognifitApiUserActivity->getPlayedGames($cognifitUserToken);
        if (!$response->hasError()) {
        }
        return $response;
    }
}
