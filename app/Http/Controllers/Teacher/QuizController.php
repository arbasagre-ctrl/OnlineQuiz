<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Section;
use App\Models\YearLevel;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuizController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $quizzes = Quiz::where('instructor_id', auth()->id())
            ->with(['course', 'section', 'yearLevel'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('teacher.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $courses = Course::where('instructor_id', auth()->id())->get();
        $sections = Section::where('is_active', true)->with('yearLevel')->get();
        $yearLevels = YearLevel::where('is_active', true)->get();
        return view('teacher.quizzes.create', compact('courses', 'sections', 'yearLevels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'total_points' => 'required|integer|min:1',
            'time_limit' => 'nullable|integer|min:1',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date|after:available_from',
            'category' => 'nullable|string|max:100',
            'section_id' => 'nullable|exists:sections,id',
            'year_level_id' => 'nullable|exists:year_levels,id',
        ]);

        $validated['instructor_id'] = auth()->id();
        $validated['is_published'] = false;

        $quiz = Quiz::create($validated);

        ActivityLog::log(
            'quiz_created',
            "Created quiz: {$quiz->title}",
            'Quiz',
            $quiz->id
        );

        return redirect()->route('teacher.quizzes.edit', $quiz)
            ->with('success', 'Quiz created successfully. Now add questions.');
    }

    public function edit(Quiz $quiz)
    {
        $this->authorize('update', $quiz);
        
        $courses = Course::where('instructor_id', auth()->id())->get();
        $sections = Section::where('is_active', true)->with('yearLevel')->get();
        $yearLevels = YearLevel::where('is_active', true)->get();
        $quiz->load('questions.options');

        return view('teacher.quizzes.edit', compact('quiz', 'courses', 'sections', 'yearLevels'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'total_points' => 'required|integer|min:1',
            'time_limit' => 'nullable|integer|min:1',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date|after:available_from',
            'category' => 'nullable|string|max:100',
            'section_id' => 'nullable|exists:sections,id',
            'year_level_id' => 'nullable|exists:year_levels,id',
        ]);

        $quiz->update($validated);

        ActivityLog::log(
            'quiz_updated',
            "Updated quiz: {$quiz->title}",
            'Quiz',
            $quiz->id
        );

        return redirect()->route('teacher.quizzes.index')
            ->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorize('delete', $quiz);

        $quizTitle = $quiz->title;
        $quiz->delete();

        ActivityLog::log(
            'quiz_deleted',
            "Deleted quiz: {$quizTitle}",
            'Quiz',
            $quiz->id
        );

        return redirect()->route('teacher.quizzes.index')
            ->with('success', 'Quiz deleted successfully.');
    }

    public function publish(Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $quiz->is_published = true;
        $quiz->save();

        ActivityLog::log(
            'quiz_published',
            "Published quiz: {$quiz->title}",
            'Quiz',
            $quiz->id
        );

        return redirect()->back()
            ->with('success', 'Quiz published successfully.');
    }

    public function unpublish(Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $quiz->is_published = false;
        $quiz->save();

        ActivityLog::log(
            'quiz_unpublished',
            "Unpublished quiz: {$quiz->title}",
            'Quiz',
            $quiz->id
        );

        return redirect()->back()
            ->with('success', 'Quiz unpublished successfully.');
    }
}
