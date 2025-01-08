<?php

namespace App\Http\Controllers;

use App\Models\LanguageAdmin;
use App\Http\Requests\AdminStoreLanguageRequest;
use App\Http\Requests\AdminUpdateLanguageRequest;

class LanguageAdminController extends Controller
{
    public function index()
    {
        $languages = LanguageAdmin::with('admin')->get();
        return response()->json(['languages' => $languages], 200);
    }

    public function store(AdminStoreLanguageRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['admin_id'] = auth()->id(); 

            $language = LanguageAdmin::create($validatedData);

            return response()->json([
                'message' => 'Language created successfully.',
                'language' => $language,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $language = LanguageAdmin::with('admin')->find($id);
        return response()->json(['language' => $language], 200);
    }

    public function update(AdminUpdateLanguageRequest $request, $id)
    {
        $language = LanguageAdmin::find($id);
        $language->update($request->validated());
        return response()->json([
            'message' => 'Admin language updated successfully.',
            'language' => $language,
        ], 200);
    }

    public function destroy($id)
    {
        $language = LanguageAdmin::find($id);
        $language->delete();
        return response()->json(['message' => 'Admin language deleted successfully.'], 200);
    }
}
