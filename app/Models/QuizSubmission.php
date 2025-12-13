<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'student_id',
        'submitted_at',
        'grade',
        'feedback',
        'is_graded',
        'graded_at',
        'graded_by',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
        'is_graded' => 'boolean',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function grader()
    {
        return $this->belongsTo(User::class, 'graded_by');
    }

    public function answers()
    {
        return $this->hasMany(SubmissionAnswer::class, 'submission_id');
    }

    public function calculateGrade()
    {
        $totalPoints = $this->answers->sum('points_earned');
        $this->grade = $totalPoints;
        $this->save();
        
        return $totalPoints;
    }
}
