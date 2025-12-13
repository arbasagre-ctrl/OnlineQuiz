<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\YearLevel;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('yearLevel')->withCount('users')->orderBy('created_at', 'desc')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        $yearLevels = YearLevel::where('is_active', true)->get();
        return view('admin.sections.create', compact('yearLevels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sections',
            'year_level_id' => 'required|exists:year_levels,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $section = Section::create($validated);

        ActivityLog::log(
            'section_created',
            "Created section: {$section->name}",
            'Section',
            $section->id
        );

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section created successfully.');
    }

    public function edit(Section $section)
    {
        $yearLevels = YearLevel::where('is_active', true)->get();
        return view('admin.sections.edit', compact('section', 'yearLevels'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sections,code,' . $section->id,
            'year_level_id' => 'required|exists:year_levels,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $section->update($validated);

        ActivityLog::log(
            'section_updated',
            "Updated section: {$section->name}",
            'Section',
            $section->id
        );

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $name = $section->name;
        $section->delete();

        ActivityLog::log(
            'section_deleted',
            "Deleted section: {$name}",
            'Section',
            $section->id
        );

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}
