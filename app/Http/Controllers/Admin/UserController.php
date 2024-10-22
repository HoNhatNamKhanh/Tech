<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');

        // Adjusted query with join
        $users = User::with('userMeta')
            ->leftJoin('user_metas', 'users.id', '=', 'user_metas.user_id') // Join user_metas table
            ->orderBy(
                $sortField === 'address' ? 'user_metas.address' :
                ($sortField === 'phone' ? 'user_metas.phone' :
                    ($sortField === 'role' ? 'user_metas.role' : 'users.' . $sortField)),
                $sortDirection
            )
            ->select('users.*', 'user_metas.address', 'user_metas.image', 'user_metas.phone', 'user_metas.role') // Select required fields
            ->paginate(10);

        return view('admin.users.index', compact('users', 'sortField', 'sortDirection'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'role' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Handle user meta
        UserMeta::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            // Handle image upload if necessary
            'image' => $request->file('image') ? $request->file('image')->store('images') : null,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('userMeta')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('userMeta')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegisterRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'role' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user details
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ];
        $user->update($userData);

        // Update user meta
        $userMeta = UserMeta::where('user_id', $user->id)->first();
        if ($userMeta) {
            $userMetaData = [
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
                'image' => $request->file('image') ? $request->file('image')->store('images') : $userMeta->image,
            ];
            $userMeta->update($userMetaData);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->userMeta()->delete(); // Delete associated UserMeta
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
