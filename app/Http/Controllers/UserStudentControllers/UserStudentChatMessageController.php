<?php

namespace App\Http\Controllers\UserStudentControllers;

use App\Models\UserStudentModels\UserStudentChatMessage;
use App\Http\Requests\UserStudentRequests\UserStudentChatMessageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserStudentChatMessageController extends Controller
{
    public function index()
    {
        $messages = UserStudentChatMessage::with(['userStudent', 'recepient'])->paginate(10);
        return response()->json($messages, 200);
    }

    public function store(UserStudentChatMessageRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_student_id'] = auth()->id();
        // $validatedData['recepient_id'] = $this->determineRecepientId();

        $message = UserStudentChatMessage::create($validatedData);

        return response()->json(['message' => 'Message created successfully!', 'data' => $message], 201);
    }

    public function show($id)
    {
        $message = UserStudentChatMessage::with(['userStudent', 'recepient'])->find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json($message, 200);
    }

    public function update(UserStudentChatMessageRequest $request, $id)
    {
        $message = UserStudentChatMessage::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->update($request->validated());
        return response()->json(['message' => 'Message updated successfully!', 'data' => $message], 200);
    }

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

