<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use apiresponse;

    /**
     * Update user primary info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateUserInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'email'      => 'nullable|email|unique:users,email,' . Auth::id(),
            'password'   => 'nullable|string|min:8|confirmed',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        $user = Auth::user();
        try {
            $user = Auth::user();
            $user->update([
                'first_name' => $request->first_name ?? $user->first_name,
                'last_name'  => $request->last_name ?? $user->last_name,
                'email'      => $request->email ?? $user->email,
                'password'   => $request->password ? Hash::make($request->password) : $user->password
            ]);

            return $this->success([
                'user' => $user,
            ], 'User updated successfully', 200);

        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 400);
        }
    }

    /**
     * Change Password
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255|confirmed',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try
        {
            $user = User::where('id', Auth::id())->first();
            if (password_verify($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return $this->success([], "Password changed successfully", 200);
            } else {
                return $this->error([], "Old password is incorrect", 500);
            }
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }


    /**
     * Delete User
     * @return \Illuminate\Http\Response
     */
    public function deleteUser()
    {
        $user = User::where('id', Auth::id())->first();
        if ($user) {
            $user->delete();
            return $this->success([], "User deleted successfully", 200);
        } else {
            return $this->error("User not found", 404);
        }

    }
}
