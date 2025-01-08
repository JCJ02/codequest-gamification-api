<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminModels\AdminLanguage;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\AdminStoreLanguageRequest;
use App\Http\Requests\AdminRequests\AdminUpdateLanguageRequest;

class AdminLanguageController extends Controller
{
    public function index()
    {
        $languages = AdminLanguage::with('admin')->get();
        return response()->json(['languages' => $languages], 200);
    }

    public function store(AdminStoreLanguageRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['admin_id'] = auth()->id(); 

            $language = AdminLanguage::create($validatedData);

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
        $language = AdminLanguage::with('admin')->find($id);
        return response()->json(['language' => $language], 200);
    }

    public function update(AdminUpdateLanguageRequest $request, $id)
    {
        $language = AdminLanguage::find($id);
        $language->update($request->validated());
        return response()->json([
            'message' => 'Admin language updated successfully.',
            'language' => $language,
        ], 200);
    }

    public function destroy($id)
    {
        $language = AdminLanguage::find($id);
        $language->delete();
        return response()->json(['message' => 'Admin language deleted successfully.'], 200);
    }
}
