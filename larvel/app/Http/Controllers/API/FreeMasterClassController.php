<?php

namespace App\Http\Controllers\API;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FreeMasterClassRequest;
use App\Models\FreeMasterClass;
use App\Models\User;
use App\Notifications\AdminFreeMasterClassNotification;
use App\Traits\apiresponse;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FreeMasterClassController extends Controller
{
    use apiresponse;

    public function freeMasterClassRequest(FreeMasterClassRequest $request)
    {
    
        DB::beginTransaction();
        try {
            $free_masterclass = new FreeMasterClass();
            $free_masterclass->name = $request->name;
            $free_masterclass->email = $request->email;
            $free_masterclass->save();


            $admin = User::where('is_admin', 1)->first();
            Log::info('Admin user found: ' . ($admin ? $admin->email : 'No admin found'));
            if ($admin) {
                try {
                    $admin->notify(new AdminFreeMasterClassNotification($free_masterclass));
                    Log::info('Notification sent to admin: ' . $admin->email);
                } catch (Exception $notifyException) {
                    Log::error('Failed to send notification to admin: ' . $notifyException->getMessage());
                }
            } else {
                Log::warning('No admin user found to notify. Please create an admin user with is_admin = 1.');
            }

            DB::commit();

           
            $message = "Free Masterclass request submitted successfully";

            $sanitizedContact = [
                'id' => $free_masterclass->id,
                'name' => $free_masterclass->name,
                'email' => $free_masterclass->email,
            ];
    

            return response()->json([
                'success' => true,
                'data' => $sanitizedContact,
                'message' => $message,
            ], 201);

        } catch (Exception $exception) {
            DB::rollBack();

            Log::error("Free masterclass request failed: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Failed to submit free masterclass request: ' . $exception->getMessage(),
            ], 500);
        }
    }
}