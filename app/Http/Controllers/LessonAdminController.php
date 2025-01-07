<?php

namespace App\Http\Controllers;

use App\Models\LessonAdmin;
use App\Http\Requests\LessonAdminRequest;
use Illuminate\Http\JsonResponse;

class LessonAdminController extends Controller
{
    // Get all lessons
    public function index(): JsonResponse
    {
        try {
            $lessons = LessonAdmin::with('admin')->get();

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
    public function store(LessonAdminRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated(); 
            $validatedData['admin_id'] = auth()->id();

            $lesson = LessonAdmin::create($validatedData);

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
            $lesson = LessonAdmin::with('admin')->find($id);
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
    public function update(LessonAdminRequest $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validated(); 
            $validatedData['admin_id'] = auth()->id();

            $lesson = LessonAdmin::find($id);
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

    public function destroy($id): JsonResponse
    {
        try {
            $lesson = LessonAdmin::findOrFail($id);
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
