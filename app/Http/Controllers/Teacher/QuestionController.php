<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        // Prevent adding questions to published quizzes
        if ($quiz->is_published) {
            return redirect()->back()
                ->with('error', 'Cannot add questions to a published quiz.');
        }

        $validated = $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:multiple_choice,true_false,short_answer,essay',
            'points' => 'required|integer|min:1',
            'correct_answer' => 'nullable|string',
            'options' => 'nullable|array',
            'options.*.text' => 'required_with:options|string',
            'options.*.is_correct' => 'nullable|boolean',
        ]);

        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => $validated['question_text'],
            'type' => $validated['type'],
            'points' => $validated['points'],
            'correct_answer' => $validated['correct_answer'] ?? null,
            'order' => $quiz->questions()->count() + 1,
        ]);

        // Add options for multiple choice and true/false
        if (in_array($validated['type'], ['multiple_choice', 'true_false']) && isset($validated['options'])) {
            foreach ($validated['options'] as $index => $option) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $option['text'],
                    'is_correct' => $option['is_correct'] ?? false,
                    'order' => $index + 1,
                ]);
            }
        }

        ActivityLog::log(
            'question_created',
            "Added question to quiz: {$quiz->title}",
            'Question',
            $question->id
        );

        return redirect()->back()
            ->with('success', 'Question added successfully.');
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        $this->authorize('update', $quiz);

        if ($quiz->is_published) {
            return redirect()->back()
                ->with('error', 'Cannot edit questions in a published quiz.');
        }

        $validated = $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:multiple_choice,true_false,short_answer,essay',
            'points' => 'required|integer|min:1',
            'correct_answer' => 'nullable|string',
            'options' => 'nullable|array',
            'options.*.text' => 'required_with:options|string',
            'options.*.is_correct' => 'nullable|boolean',
        ]);

        $question->update([
            'question_text' => $validated['question_text'],
            'type' => $validated['type'],
            'points' => $validated['points'],
            'correct_answer' => $validated['correct_answer'] ?? null,
        ]);

        // Update options
        if (in_array($validated['type'], ['multiple_choice', 'true_false']) && isset($validated['options'])) {
            $question->options()->delete();
            
            foreach ($validated['options'] as $index => $option) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $option['text'],
                    'is_correct' => $option['is_correct'] ?? false,
                    'order' => $index + 1,
                ]);
            }
        }

        ActivityLog::log(
            'question_updated',
            "Updated question in quiz: {$quiz->title}",
            'Question',
            $question->id
        );

        return redirect()->back()
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        $this->authorize('update', $quiz);

        if ($quiz->is_published) {
            return redirect()->back()
                ->with('error', 'Cannot delete questions from a published quiz.');
        }

        $question->delete();

        ActivityLog::log(
            'question_deleted',
            "Deleted question from quiz: {$quiz->title}",
            'Question',
            $question->id
        );

        return redirect()->back()
            ->with('success', 'Question deleted successfully.');
    }
}
