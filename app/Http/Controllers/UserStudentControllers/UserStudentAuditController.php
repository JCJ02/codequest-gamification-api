<?php

namespace App\Http\Controllers\UserStudentControllers;

use App\Models\UserStudentModels\UserStudentAudit;
use App\Http\Requests\UserStudentRequests\UserStudentAuditRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserStudentAuditController extends Controller
{
    // GET ALL AUDIT ENTRIES
    public function index()
    {
        $audits = UserStudentAudit::with('userStudent')->paginate(10);
        return response()->json($audits, 200);
    }

    // STORE A NEW AUDIT ENTRY
    public function store(UserStudentAuditRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_student_id'] = auth()->id();
        $validatedData['event_date'] = now(); 

        $audit = UserStudentAudit::create($validatedData);

        return response()->json(['message' => 'Audit entry created successfully!', 'data' => $audit], 201);
    }

    // SHOW A SINGLE AUDIT ENTRY
    public function show($id)
    {
        $audit = UserStudentAudit::with('userStudent')->find($id);

        if (!$audit) {
            return response()->json(['error' => 'Audit entry not found'], 404);
        }

        return response()->json($audit, 200);
    }

    // UPDATE AN AUDIT ENTRY
    public function update(UserStudentAuditRequest $request, $id)
    {
        $audit = UserStudentAudit::find($id);

        if (!$audit) {
            return response()->json(['error' => 'Audit entry not found'], 404);
        }

        $audit->update($request->validated());

        return response()->json(['message' => 'Audit entry updated successfully!', 'data' => $audit], 200);
    }

    // DELETE AN AUDIT ENTRY
    public function destroy($id)
    {
        $audit = UserStudentAudit::find($id);

        if (!$audit) {
            return response()->json(['error' => 'Audit entry not found'], 404);
        }

        $audit->delete();

        return response()->json(['message' => 'Audit entry deleted successfully!'], 200);
    }
}
