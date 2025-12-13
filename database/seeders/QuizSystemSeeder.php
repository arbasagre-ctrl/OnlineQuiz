<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\YearLevel;
use App\Models\Section;
use Illuminate\Support\Facades\Hash;

class QuizSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Year Levels
        $yearLevel1 = YearLevel::create([
            'name' => '1st Year',
            'code' => 'YEAR1',
            'description' => 'First year students',
            'is_active' => true,
        ]);

        $yearLevel2 = YearLevel::create([
            'name' => '2nd Year',
            'code' => 'YEAR2',
            'description' => 'Second year students',
            'is_active' => true,
        ]);

        // Create Sections
        $sectionA = Section::create([
            'name' => 'Section A',
            'code' => 'SEC-A',
            'year_level_id' => $yearLevel1->id,
            'description' => 'First year, Section A',
            'is_active' => true,
        ]);

        $sectionB = Section::create([
            'name' => 'Section B',
            'code' => 'SEC-B',
            'year_level_id' => $yearLevel1->id,
            'description' => 'First year, Section B',
            'is_active' => true,
        ]);

        $sectionC = Section::create([
            'name' => 'Section A',
            'code' => 'SEC-C',
            'year_level_id' => $yearLevel2->id,
            'description' => 'Second year, Section A',
            'is_active' => true,
        ]);

        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@lms.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Teachers
        $teacher1 = User::create([
            'name' => 'John Teacher',
            'email' => 'teacher@lms.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        $teacher2 = User::create([
            'name' => 'Jane Instructor',
            'email' => 'instructor@lms.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Create Students
        $student1 = User::create([
            'name' => 'Alice Student',
            'email' => 'student1@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'year_level_id' => $yearLevel1->id,
            'section_id' => $sectionA->id,
        ]);

        $student2 = User::create([
            'name' => 'Bob Student',
            'email' => 'student2@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'year_level_id' => $yearLevel1->id,
            'section_id' => $sectionB->id,
        ]);

        $student3 = User::create([
            'name' => 'Charlie Student',
            'email' => 'student3@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'year_level_id' => $yearLevel2->id,
            'section_id' => $sectionC->id,
        ]);

        // Create Courses
        $course1 = Course::create([
            'code' => 'CS101',
            'name' => 'Introduction to Computer Science',
            'description' => 'Basic concepts of computer science and programming',
            'instructor_id' => $teacher1->id,
            'is_active' => true,
        ]);

        $course2 = Course::create([
            'code' => 'MATH201',
            'name' => 'Calculus I',
            'description' => 'Differential and integral calculus',
            'instructor_id' => $teacher2->id,
            'is_active' => true,
        ]);

        // Create Quiz 1 - Computer Science (For Section A)
        $quiz1 = Quiz::create([
            'title' => 'Introduction to Programming - Midterm',
            'description' => 'This quiz covers basic programming concepts including variables, loops, and functions.',
            'course_id' => $course1->id,
            'instructor_id' => $teacher1->id,
            'total_points' => 100,
            'time_limit' => 60,
            'available_from' => now(),
            'available_until' => now()->addDays(7),
            'is_published' => true,
            'category' => 'Midterm',
            'year_level_id' => $yearLevel1->id,
            'section_id' => $sectionA->id,
        ]);

        // Question 1 - Multiple Choice
        $q1 = Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'What is the correct syntax to output "Hello World" in Python?',
            'type' => 'multiple_choice',
            'points' => 10,
            'order' => 1,
        ]);

        QuestionOption::create([
            'question_id' => $q1->id,
            'option_text' => 'echo "Hello World"',
            'is_correct' => false,
            'order' => 1,
        ]);

        QuestionOption::create([
            'question_id' => $q1->id,
            'option_text' => 'print("Hello World")',
            'is_correct' => true,
            'order' => 2,
        ]);

        QuestionOption::create([
            'question_id' => $q1->id,
            'option_text' => 'console.log("Hello World")',
            'is_correct' => false,
            'order' => 3,
        ]);

        QuestionOption::create([
            'question_id' => $q1->id,
            'option_text' => 'printf("Hello World")',
            'is_correct' => false,
            'order' => 4,
        ]);

        // Question 2 - True/False
        $q2 = Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'Python is a compiled programming language.',
            'type' => 'true_false',
            'points' => 5,
            'order' => 2,
        ]);

        QuestionOption::create([
            'question_id' => $q2->id,
            'option_text' => 'True',
            'is_correct' => false,
            'order' => 1,
        ]);

        QuestionOption::create([
            'question_id' => $q2->id,
            'option_text' => 'False',
            'is_correct' => true,
            'order' => 2,
        ]);

        // Question 3 - Short Answer
        Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'What keyword is used to define a function in Python?',
            'type' => 'short_answer',
            'points' => 5,
            'order' => 3,
            'correct_answer' => 'def',
        ]);

        // Question 4 - Essay
        Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'Explain the difference between a list and a tuple in Python. Provide examples.',
            'type' => 'essay',
            'points' => 20,
            'order' => 4,
        ]);

        // Create Quiz 2 - Math (Draft)
        $quiz2 = Quiz::create([
            'title' => 'Calculus Basics Quiz',
            'description' => 'Test your understanding of limits and derivatives.',
            'course_id' => $course2->id,
            'instructor_id' => $teacher2->id,
            'total_points' => 50,
            'time_limit' => 30,
            'available_from' => now(),
            'available_until' => now()->addDays(14),
            'is_published' => false,
            'category' => 'Quiz',
        ]);

        // Question for Math Quiz
        $q3 = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'What is the derivative of x²?',
            'type' => 'short_answer',
            'points' => 10,
            'order' => 1,
            'correct_answer' => '2x',
        ]);

        $this->command->info('Sample data seeded successfully!');
        $this->command->info('');
        $this->command->info('Login Credentials:');
        $this->command->info('Admin: admin@lms.com / password');
        $this->command->info('Teacher: teacher@lms.com / password');
        $this->command->info('Student: student1@lms.com / password');
    }
}
