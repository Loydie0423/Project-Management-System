<?php
namespace App\Http\Controllers\Auth;
use App\Http\HttpResponse\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SignInController
{
    private JsonResponse $jsonResponse;

    public function __construct()
    {
        $this->jsonResponse = new JsonResponse();
    }

    public function index()
    {
        return view('auth.signin');
    }

    public function submit(Request $request)
    {
        try {
            if ($request->ajax()) {

                $validator = Validator::make($request->all(), [
                    'username' => ['required', 'max:255'],
                    'password' => ['required', 'max:255']
                ]);

                if ($validator->fails()) {
                    return $this->jsonResponse->failedValidationJsonResponse($validator->errors()->toArray());
                }

                $userCount = User::where('username', $request->username)->count();

                if (!$userCount || !$userCount > 0) {
                    return $this->jsonResponse->notFoundJsonResponse(message: 'User Not Found');
                }

                $credentials = [
                    'username' => $request->username,
                    'password' => $request->password
                ];

                if (!Auth::attempt($credentials)) {
                    return $this->jsonResponse->invalidCredentialsJsonResponse(message: 'Incorrect Password');
                }

                return response()->json('Success Login');
            }
        } catch (\Throwable $th) {
            return $this->jsonResponse->serverErrorJsonResponse(message: $th->getMessage());
        }
    }
}
?>