<?php

namespace App\Http\Controllers;

use App\Models\LevelAdmin;
use App\Http\Requests\AdminLevelRequest;
use Illuminate\Http\JsonResponse;

class LevelAdminController extends Controller
{
    // Get all admin levels
    public function index(): JsonResponse
    {
        try {
            $levelAdmin = LevelAdmin::with(['admin', 'language'])->get();

            return response()->json([
                'level_Admin' => $levelAdmin,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Store a new admin level
    public function store(AdminLevelRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $validatedData['admin_id'] = auth()->id(); 

            $levelAdmin = LevelAdmin::create($validatedData);

            return response()->json([
                'message' => 'Admin level created successfully.',
                'admin_level' => $levelAdmin,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Show a single admin level
    public function show($id): JsonResponse
    {
        try {
            $levelAdmin = LevelAdmin::with(['admin', 'language'])->find($id);

            if (!$levelAdmin) {
                return response()->json([
                    'message' => 'Admin level not found.',
                ], 404);
            }

            return response()->json([
                'level_admin' => $levelAdmin,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Update an admin level
    public function update(AdminLevelRequest $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $levelAdmin = LevelAdmin::find($id);

            if (!$adminLevel) {
                return response()->json([
                    'message' => 'Admin level not found.',
                ], 404);
            }

            $levelAdmin->update($validatedData);

            return response()->json([
                'message' => 'Admin level updated successfully.',
                'admin_level' => $adminLevel,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Delete an admin level
    public function destroy($id): JsonResponse
    {
        try {
            $levelAdmin = LevelAdmin::find($id);

            if (!$levelAdmin) {
                return response()->json([
                    'message' => 'Admin level not found.',
                ], 404);
            }

            $levelAdmin->delete();

            return response()->json([
                'message' => 'Admin level deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
