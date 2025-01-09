<?php

namespace App\Http\Controllers\UserStudentControllers;

use App\Models\UserStudentModels\UserStudentMessage;
use App\Http\Requests\UserStudentRequests\UserStudentMessageRequest;
use App\Http\Controllers\Controller;
use Auth;


class UserStudentMessageController extends Controller
{
    // GET ALL MESSAGES
    public function index()
    {
        $messages = UserStudentMessage::with(['userStudent', 'recipient'])->paginate(10);
        return response()->json($messages, 200);
    }

    // STORE A NEW MESSAGE
    public function store(UserStudentMessageRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_student_id'] = auth()->id();  

        $message = UserStudentMessage::create($validatedData);

        return response()->json(['message' => 'Message sent successfully!', 'data' => $message], 201);
    }

    // SHOW A SINGLE MESSAGE
    public function show($id)
    {
        $message = UserStudentMessage::with(['userStudent', 'recipient'])->find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json($message, 200);
    }

    // UPDATE A MESSAGE
    public function update(UserStudentMessageRequest $request, $id)
    {
        $message = UserStudentMessage::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->update($request->validated());

        return response()->json(['message' => 'Message updated successfully!', 'data' => $message], 200);
    }

    // DELETE A MESSAGE
    public function destroy($id)
    {
        $message = UserStudentMessage::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->delete();
        return response()->json(['message' => 'Message deleted successfully!'], 200);
    }
}
