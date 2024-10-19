<?php
namespace App\Http\HttpResponse;

class JsonResponse
{
    public function failedValidationJsonResponse(array $errors, bool $success = false, string $message = 'Validation Error', int $statusCode = 422)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'errors' => $errors
        ];

        return response()->json($response, $statusCode);
    }

    public function notFoundJsonResponse(string $message = 'Not Found', bool $success = false, int $statusCode = 404)
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }

    public function invalidCredentialsJsonResponse(string $message = 'Invalid Credentials', bool $success = false, int $statusCode = 401)
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }

    public function serverErrorJsonResponse(string $message = 'Internal Server Error', bool $success = false, int $statusCode = 500)
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }
}
?>