<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterSubscribeRequest;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use App\Notifications\AdminNewsletterNotification;
use App\Traits\apiresponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class NewsletterController extends Controller
{
    use apiresponse;

    public function subscribe(NewsletterSubscribeRequest $request)
{
    DB::beginTransaction();

    try {
        $subscriber = NewsletterSubscriber::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'subscribed_at' => now(),
        ]);

        $admin = User::where('is_admin', 1)->first();

        if ($admin) {
            try {
                $admin->notify(new AdminNewsletterNotification($subscriber));
                Log::info("Newsletter notification queued/sent to: {$admin->email}");
            } catch (Exception $e) {
                Log::warning("Failed to notify admin about new subscriber: " . $e->getMessage());
            }
        } else {
            Log::warning("No admin found for newsletter notification");
        }

        DB::commit();

        return $this->success($subscriber->only(['id','name','email']), 'Subscribed successfully!', 201);

    } catch (Exception $e) {
        DB::rollBack();
        Log::error("Newsletter subscribe failed: " . $e->getMessage());
        return $this->error([], 'Something went wrong. Please try again.', 500);
    }
}
}