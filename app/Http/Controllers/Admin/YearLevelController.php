<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\YearLevel;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class YearLevelController extends Controller
{
    public function index()
    {
        $yearLevels = YearLevel::withCount('sections', 'users')->orderBy('created_at', 'desc')->get();
        return view('admin.year-levels.index', compact('yearLevels'));
    }

    public function create()
    {
        return view('admin.year-levels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:year_levels',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $yearLevel = YearLevel::create($validated);

        ActivityLog::log(
            'year_level_created',
            "Created year level: {$yearLevel->name}",
            'YearLevel',
            $yearLevel->id
        );

        return redirect()->route('admin.year-levels.index')
            ->with('success', 'Year level created successfully.');
    }

    public function edit(YearLevel $yearLevel)
    {
        return view('admin.year-levels.edit', compact('yearLevel'));
    }

    public function update(Request $request, YearLevel $yearLevel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:year_levels,code,' . $yearLevel->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $yearLevel->update($validated);

        ActivityLog::log(
            'year_level_updated',
            "Updated year level: {$yearLevel->name}",
            'YearLevel',
            $yearLevel->id
        );

        return redirect()->route('admin.year-levels.index')
            ->with('success', 'Year level updated successfully.');
    }

    public function destroy(YearLevel $yearLevel)
    {
        $name = $yearLevel->name;
        $yearLevel->delete();

        ActivityLog::log(
            'year_level_deleted',
            "Deleted year level: {$name}",
            'YearLevel',
            $yearLevel->id
        );

        return redirect()->route('admin.year-levels.index')
            ->with('success', 'Year level deleted successfully.');
    }
}
