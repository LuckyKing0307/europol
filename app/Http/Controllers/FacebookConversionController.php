<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacebookConversionService;

class FacebookConversionController extends Controller
{
    protected FacebookConversionService $facebookService;

    public function __construct()
    {
        $this->facebookService = new FacebookConversionService();
    }

    public function sendConversion(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string',
            'event_time' => 'required|integer',
            'user_data' => 'required|array',
            'custom_data' => 'nullable|array',
        ]);

        $event = [
            'event_name' => $request->event_name,
            'event_time' => $request->event_time,
            'user_data' => $request->user_data,
            'custom_data' => $request->custom_data ?? [],
            'action_source' => 'website',
        ];

        $result = $this->facebookService->sendEvent($event);

        return response()->json($result);
    }
}

