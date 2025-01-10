<?php

namespace App\Http\Controllers\UserStudentControllers;

use App\Models\UserStudentModels\UserStudentLeaderboard;
use App\Http\Requests\UserStudentRequests\UserStudentLeaderboardRequest;
use App\Http\Controllers\Controller;
use Auth;

class UserStudentLeaderboardController extends Controller
{
    // GET ALL LEADERBOARD ENTRIES
    public function index()
    {
        $leaderboard = UserStudentLeaderboard::with('userStudent')->paginate(10);
        return response()->json($leaderboard, 200);
    }

    // STORE A NEW LEADERBOARD ENTRY
    public function store(UserStudentLeaderboardRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData ['user_student_id'] = auth()->id();

        $leaderboardEntry = UserStudentLeaderboard::create($validatedData);

        return response()->json(['message' => 'Entry added to leaderboard!', 'data' => $leaderboardEntry], 201);
    }

    // SHOW A SINGLE LEADERBOARD ENTRY
    public function show($id)
    {
        $leaderboardEntry = UserStudentLeaderboard::with('userStudent')->find($id);

        if (!$leaderboardEntry) {
            return response()->json(['error' => 'Entry not found'], 404);
        }

        return response()->json($leaderboardEntry, 200);
    }

    // UPDATE A LEADERBOARD ENTRY
    public function update(UserStudentLeaderboardRequest $request, $id)
    {
        $leaderboardEntry = UserStudentLeaderboard::find($id);

        if (!$leaderboardEntry) {
            return response()->json(['error' => 'Entry not found'], 404);
        }

        $leaderboardEntry->update($request->validated());
        return response()->json(['message' => 'Leaderboard entry updated!', 'data' => $leaderboardEntry], 200);
    }

    // DELETE A LEADERBOARD ENTRY
    public function destroy($id)
    {
        $leaderboardEntry = UserStudentLeaderboard::find($id);

        if (!$leaderboardEntry) {
            return response()->json(['error' => 'Entry not found'], 404);
        }

        $leaderboardEntry->delete();
        return response()->json(['message' => 'Leaderboard entry deleted!'], 200);
    }
}
