<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminModel;

class AdminController extends Controller
{
    // ADMIN CONTROLLER
    public function index()
    {
        return view('Hello World');
    }

    public function register(RegisterRequest $request)
    {

        try {
            $validatedData = $request->validate([]);
            $validatedData['password'] = Hash::make($validatedData['password']);

            $admin = AdminModel::create($validatedData);

            return response()->json([
                'message' => 'Admin Created Successfully',
                'admin' => $admin
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }

        return view('admin.register');
    }
}
