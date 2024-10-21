<?php
namespace App\Http\Controllers\Auth;
use App\Helper\LogsHelper;
use App\Http\HttpResponse\JsonResponse;
use Auth;
use Illuminate\Http\Request;

class SignoutController
{
    private JsonResponse $jsonResponse;
    private LogsHelper $logsHelper;

    public function __construct()
    {
        $this->jsonResponse = new JsonResponse();
        $this->logsHelper = new LogsHelper();
    }

    public function signout(Request $request)
    {
        try {
            $logs = [
                'user_id' => auth()->user()->id,
                'module_name' => 'Authentication',
                'description' => 'Logged out [Date&Time: ' . now() . ']',
                'ip_address' => $request->ip(),
                'date_time' => now()
            ];

            Auth::logout();

            $this->logsHelper->insertToLogs($logs['user_id'], $logs['module_name'], $logs['description'], request()->ip(), $logs['date_time']);

            return $this->jsonResponse->successJsonResponse(message: 'Success');
        } catch (\Throwable $th) {
            return $this->jsonResponse->serverErrorJsonResponse();
        }
    }
}