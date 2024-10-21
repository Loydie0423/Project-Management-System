<?php
namespace App\Http\Controllers\Auth;
use App\Helper\LogsHelper;
use App\Http\HttpResponse\JsonResponse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Log;

class SignInController
{
    private JsonResponse $jsonResponse;
    private LogsHelper $logsHelper;

    private Carbon $dateNow;

    public function __construct()
    {
        $this->jsonResponse = new JsonResponse();
        $this->logsHelper = new LogsHelper();
        $this->dateNow = now();

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

                $userType = (auth()->user()->role_id == "1" || auth()->user()->role_id == 1) ? 'User' : 'Admin';

                $logs = [
                    'user_id' => auth()->user()->id,
                    'module_name' => 'Authentication',
                    'description' => 'Logged in [Date&Time: ' . now() . ']',
                    'ip_address' => $request->ip(),
                    'date_time' => now()
                ];

                $this->logsHelper->insertToLogs($logs['user_id'], $logs['module_name'], $logs['description'], request()->ip(), $logs['date_time']);

                return $this->jsonResponse->successJsonResponse(message: 'Success', data: ['userType' => $userType]);
            }
        } catch (\Throwable $th) {
            return $this->jsonResponse->serverErrorJsonResponse(message: $th->getMessage());
        }
    }
}
?>