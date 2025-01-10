<?php

namespace App\Http\Controllers\UserStudentControllers;

use App\Models\UserStudentModels\UserStudentChatMessage;
use App\Http\Requests\UserStudentRequests\UserStudentChatMessageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UserStudentChatMessageController extends Controller
{
    // Get all messages
    public function index()
    {
        $messages = UserStudentChatMessage::with(['userStudent', 'recepient'])->paginate(10);
        return response()->json($messages, 200);
    }

    // Store a new message
    public function store(UserStudentChatMessageRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_student_id'] = auth()->id();

        $message = UserStudentChatMessage::create($validatedData);

        return response()->json(['message' => 'Message created successfully!', 'data' => $message], 201);
    }

    // Show a single message
    public function show($id)
    {
        $message = UserStudentChatMessage::with(['userStudent', 'recepient'])->find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json($message, 200);
    }

    // Update a message
    public function update(UserStudentChatMessageRequest $request, $id)
    {
        $message = UserStudentChatMessage::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->update($request->validated());
        return response()->json(['message' => 'Message updated successfully!', 'data' => $message], 200);
    }

    // Delete a message
    public function destroy($id)
    {
        $message = UserStudentChatMessage::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->delete();
        return response()->json(['message' => 'Message deleted successfully!'], 200);
    }
}

