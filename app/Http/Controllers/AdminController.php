<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminModel;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        return view('Hello World');
    }

    public function register(RegisterRequest $request)
    {
        try {

            $validatedData = $request->validated();

            $validatedData['birthdate'] = Carbon::createFromFormat('m-d-Y', $validatedData['birthdate'])->format('m-d-Y');

            $validatedData['role'] = $validatedData['role'] ?? 'admin';

            $admin = AdminModel::create($validatedData);

            $account = $admin->account()->create([
                'password' => Hash::make($validatedData['password']),
            ]);

            return response()->json([
                'message' => 'Admin Created Successfully',
                'admin' => $admin,
                'account' => $account
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
