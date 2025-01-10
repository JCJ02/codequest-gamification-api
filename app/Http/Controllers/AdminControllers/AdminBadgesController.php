<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminModels\AdminBadges;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\AdminBadgesRequest;
use Illuminate\Http\JsonResponse;
use Auth;

class AdminBadgesController extends Controller
{
    // Get all admin badges
    public function index(): JsonResponse
    {
        try {
            $adminBadges = AdminBadges::with('admin')->get();
            return response()->json(['admin_badges' => $adminBadges], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Store a new admin badge
    public function store(AdminBadgesRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $validatedData['admin_id'] = auth()->id();
            $adminBadges = AdminBadges::create($validatedData);

            return response()->json(['message' => 'Admin badge created successfully.', 'admin_badges' => $adminBadges], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Show a single admin badge
    public function show($id): JsonResponse
    {
        try {
            $adminBadges = AdminBadges::with('admin')->find($id);
            if (!$adminBadges) {
                return response()->json(['message' => 'Admin badge not found.'], 404);
            }
            return response()->json(['admin_badges' => $adminBadges], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Update an admin badge
    public function update(AdminBadgesRequest $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $adminBadges = AdminBadges::find($id);

            if (!$adminBadges) {
                return response()->json(['message' => 'Admin badge not found.'], 404);
            }

            $adminBadges->update($validatedData);
            return response()->json(['message' => 'Admin badge updated successfully.', 'admin_badges' => $adminBadges], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Delete an admin badge
    public function destroy($id): JsonResponse
    {
        try {
            $adminBadges = AdminBadges::find($id);
            if (!$adminBadges) {
                return response()->json(['message' => 'Admin badge not found.'], 404);
            }

            $adminBadges->delete();
            return response()->json(['message' => 'Admin badge deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
