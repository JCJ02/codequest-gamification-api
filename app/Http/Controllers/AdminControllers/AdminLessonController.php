<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminModels\AdminLesson;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\AdminLessonRequest;
use Illuminate\Http\JsonResponse;

class AdminLessonController extends Controller
{
    // Get all lessons
    public function index(): JsonResponse
    {
        try {
            $lessons = AdminLesson::with('admin')->get();

            return response()->json([
                'lessons' => $lessons,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Store a new lesson
    public function store(AdminLessonRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated(); 
            $validatedData['admin_id'] = auth()->id();

            $lesson = AdminLesson::create($validatedData);

            return response()->json([
                'message' => 'Lesson created successfully.',
                'lesson' => $lesson,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Get a single lesson
    public function show($id): JsonResponse
    {
        try {
            $lesson = AdminLesson::with('admin')->find($id);
            $validatedData['admin_id'] = auth()->id();

            return response()->json([
                'lesson' => $lesson,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Update a lesson
    public function update(AdminLessonRequest $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validated(); 
            $validatedData['admin_id'] = auth()->id();

            $lesson = AdminLesson::find($id);
            $lesson->update($validatedData);

            return response()->json([
                'message' => 'Lesson updated successfully.',
                'lesson' => $lesson,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Delete a lesson
    public function destroy($id): JsonResponse
    {
        try {
            $lesson = AdminLesson::findOrFail($id);
            $validatedData['admin_id'] = auth()->id();
            $lesson->delete(); 

            return response()->json([
                'message' => 'Lesson deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
