<?php

namespace App\Helper;

use App\Models\Log;
use DB;

class LogsHelper
{
    public function insertToLogs(string|int $userId, string $moduleName, string $description, string $ipAddress, string $dateNow)
    {
        try {
            DB::beginTransaction();
            Log::create([
                'user_id' => $userId,
                'module_name' => $moduleName,
                'description' => $description,
                'ip_address' => $ipAddress,
                'date_time' => $dateNow
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
}