<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminModel;
use App\Models\AccountModel;

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
            $accountData = $request->only('password');
            $accountData['password'] = Hash::make($accountData['password']);
            $account = AccountModel::create($accountData);

            $adminData = $request->only(['firstname', 'lastname', 'username', 'birthdate', 'email', 'role']);
            $adminData['account_id'] = $account->id; 

            $admin = AdminModel::create($adminData);

            return response()->json([
                'message' => 'Admin Created Successfully',
                'admin' => new AdminResource($admin),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
