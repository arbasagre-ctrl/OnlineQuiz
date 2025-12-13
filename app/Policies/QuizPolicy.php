<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;

class QuizPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Quiz $quiz): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher() && $quiz->instructor_id === $user->id) {
            return true;
        }

        if ($user->isStudent() && $quiz->is_published) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isTeacher() || $user->isAdmin();
    }

    public function update(User $user, Quiz $quiz): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isTeacher() && $quiz->instructor_id === $user->id;
    }

    public function delete(User $user, Quiz $quiz): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isTeacher() && $quiz->instructor_id === $user->id;
    }
}
