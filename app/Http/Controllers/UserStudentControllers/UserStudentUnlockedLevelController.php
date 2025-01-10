<?php

namespace App\Http\Controllers\UserStudentControllers;

use App\Models\UserStudentModels\UserStudentUnlockedLevel;
use App\Models\AdminModels\AdminLevel;
use App\Http\Requests\UserStudentRequests\UserStudentUnlockedLevelRequest;
use App\Http\Controllers\Controller;
use Auth;

class UserStudentUnlockedLevelController extends Controller
{
    // GET ALL UNLOCKED LEVEL ENTRIES
    public function index()
    {
        $unlockedLevels = UserStudentUnlockedLevel::with(['userStudent', 'adminLevel'])->paginate(10);
        return response()->json($unlockedLevels, 200);
    }

    // STORE A NEW UNLOCKED LEVEL ENTRY
    public function store(UserStudentUnlockedLevelRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_student_id'] = auth()->id();
        $validatedData['unlocked_date'] = now();

        $unlockedLevel = UserStudentUnlockedLevel::create($validatedData);

        return response()->json(['message' => 'Unlocked level added successfully!', 'data' => $unlockedLevel], 201);
    }

    // SHOW A SINGLE UNLOCKED LEVEL ENTRY
    public function show($id)
    {
        $unlockedLevel = UserStudentUnlockedLevel::with(['userStudent', 'adminLevel'])->find($id);

        if (!$unlockedLevel) {
            return response()->json(['error' => 'Unlocked level not found'], 404);
        }

        return response()->json($unlockedLevel, 200);
    }

    // UPDATE A UNLOCKED LEVEL ENTRY
    public function update(UserStudentUnlockedLevelRequest $request, $id)
    {
        $unlockedLevel = UserStudentUnlockedLevel::find($id);

        if (!$unlockedLevel) {
            return response()->json(['error' => 'Unlocked level not found'], 404);
        }

        $unlockedLevel->update($request->validated());
        return response()->json(['message' => 'Unlocked level updated successfully!', 'data' => $unlockedLevel], 200);
    }

    // DELETE A UNLOCKED LEVEL ENTRY
    public function destroy($id)
    {
        $unlockedLevel = UserStudentUnlockedLevel::find($id);

        if (!$unlockedLevel) {
            return response()->json(['error' => 'Unlocked level not found'], 404);
        }

        $unlockedLevel->delete();
        return response()->json(['message' => 'Unlocked level deleted successfully!'], 200);
    }
}
