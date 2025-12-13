<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Section;
use App\Models\YearLevel;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['section', 'yearLevel'])->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $sections = Section::where('is_active', true)->with('yearLevel')->get();
        $yearLevels = YearLevel::where('is_active', true)->get();
        return view('admin.users.create', compact('sections', 'yearLevels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,teacher,student',
            'section_id' => 'nullable|exists:sections,id',
            'year_level_id' => 'nullable|exists:year_levels,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'section_id' => $validated['section_id'] ?? null,
            'year_level_id' => $validated['year_level_id'] ?? null,
        ]);

        ActivityLog::log(
            'user_created',
            "Created user: {$user->name} ({$user->role})",
            'User',
            $user->id
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $sections = Section::where('is_active', true)->with('yearLevel')->get();
        $yearLevels = YearLevel::where('is_active', true)->get();
        return view('admin.users.edit', compact('user', 'sections', 'yearLevels'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,teacher,student',
            'password' => 'nullable|string|min:8|confirmed',
            'section_id' => 'nullable|exists:sections,id',
            'year_level_id' => 'nullable|exists:year_levels,id',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->section_id = $validated['section_id'] ?? null;
        $user->year_level_id = $validated['year_level_id'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        ActivityLog::log(
            'user_updated',
            "Updated user: {$user->name}",
            'User',
            $user->id
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $userName = $user->name;
        $user->delete();

        ActivityLog::log(
            'user_deleted',
            "Deleted user: {$userName}",
            'User',
            $user->id
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
