<?php

namespace App\Policies;

use App\Models\QuizSubmission;
use App\Models\User;

class QuizSubmissionPolicy
{
    public function view(User $user, QuizSubmission $submission): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher() && $submission->quiz->instructor_id === $user->id) {
            return true;
        }

        if ($user->isStudent() && $submission->student_id === $user->id) {
            return true;
        }

        return false;
    }

    public function update(User $user, QuizSubmission $submission): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isTeacher() && $submission->quiz->instructor_id === $user->id;
    }
}
