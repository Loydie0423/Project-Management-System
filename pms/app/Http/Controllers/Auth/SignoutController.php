<?php
namespace App\Http\Controllers\Auth;
use App\Http\HttpResponse\JsonResponse;
use Auth;

class SignoutController
{
    private JsonResponse $jsonResponse;

    public function __construct()
    {
        $this->jsonResponse = new JsonResponse();
    }

    public function signout()
    {
        try {
            Auth::logout();
            return $this->jsonResponse->successJsonResponse(message: 'Success');
        } catch (\Throwable $th) {
            return $this->jsonResponse->serverErrorJsonResponse();
        }
    }
}