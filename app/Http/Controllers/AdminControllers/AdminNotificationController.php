<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminModels\AdminNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\AdminNotificationRequest;
use Illuminate\Http\JsonResponse;

class AdminNotificationController extends Controller
{
    // Get all notifications
    public function index(): JsonResponse
    {
        try {
            $notifications = AdminNotification::with('admin')->get();
            return response()->json([
                'notifications' => $notifications,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Store a new notification
    public function store(AdminNotificationRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $validatedData['admin_id'] = auth()->id();
            $notification = AdminNotification::create($validatedData);

            return response()->json([
                'message' => 'Notification created successfully.',
                'notification' => $notification,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Show a single notification
    public function show($id): JsonResponse
    {
        try {
            $notification = AdminNotification::with('admin')->find($id);

            if (!$notification) {
                return response()->json([
                    'message' => 'Notification not found.',
                ], 404);
            }

            return response()->json([
                'notification' => $notification,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Update a notification
    public function update(AdminNotificationRequest $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $notification = AdminNotification::find($id);

            if (!$notification) {
                return response()->json([
                    'message' => 'Notification not found.',
                ], 404);
            }

            $notification->update($validatedData);

            return response()->json([
                'message' => 'Notification updated successfully.',
                'notification' => $notification,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Delete a notification
    public function destroy($id): JsonResponse
    {
        try {
            $notification = AdminNotification::find($id);

            if (!$notification) {
                return response()->json([
                    'message' => 'Notification not found.',
                ], 404);
            }

            $notification->delete();

            return response()->json([
                'message' => 'Notification deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
