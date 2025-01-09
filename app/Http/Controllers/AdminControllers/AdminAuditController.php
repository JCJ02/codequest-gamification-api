<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminModels\AdminAudit;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\AdminAuditRequest;
use Illuminate\Http\JsonResponse;

class AdminAuditController extends Controller
{
    // Get all audit logs
    public function index(): JsonResponse
    {
        try {
            $audit = AdminAudit::with('admin')->get();

            return response()->json([
                'audit' => $audit,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Store a new audit record
    public function store(AdminAuditRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $validatedData['admin_id'] = auth()->id();
            $audit = AdminAudit::create($validatedData);

            return response()->json([
                'message' => 'Audit log created successfully.',
                'audit' => $audit,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Show a single audit record
    public function show($id): JsonResponse
    {
        try {
            $audit = AdminAudit::find($id);

            if (!$audit) {
                return response()->json([
                    'message' => 'Audit log not found.',
                ], 404);
            }

            return response()->json([
                'audit' => $audit,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Update an audit record
    public function update(AdminAuditRequest $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $audit = AdminAudit::find($id);

            if (!$audit) {
                return response()->json([
                    'message' => 'Audit log not found.',
                ], 404);
            }

            $audit->update($validatedData);

            return response()->json([
                'message' => 'Audit log updated successfully.',
                'audit' => $audit,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Delete an audit record
    public function destroy($id): JsonResponse
    {
        try {
            $audit = AdminAudit::find($id);

            if (!$audit) {
                return response()->json([
                    'message' => 'Audit log not found.',
                ], 404);
            }

            $audit->delete();

            return response()->json([
                'message' => 'Audit log deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}

