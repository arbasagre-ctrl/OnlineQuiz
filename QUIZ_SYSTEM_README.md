# LMS Quiz/Test Management System

A comprehensive Learning Management System (LMS) Quiz and Test Management module built with Laravel (traditional backend) and Blade templates with HTML/CSS.

## Features

### For Teachers/Instructors

-   ✅ Create new quizzes/tests specifying title, course, and total points
-   ✅ Add, update, or delete questions within a quiz before it is published
-   ✅ Set time limits and availability dates for quizzes
-   ✅ View student submissions and review answers
-   ✅ Update grades or provide feedback for submitted quizzes
-   ✅ Publish/unpublish quizzes

### For Students

-   ✅ View available quizzes/tests assigned to them
-   ✅ Submit answers before the quiz deadline
-   ✅ View their own grades and feedback after the quiz has been graded
-   ✅ See correct answers after grading (for learning purposes)

### For System Administrators

-   ✅ Create and manage teacher and student accounts
-   ✅ Configure quiz categories, point systems, and grading rules
-   ✅ Delete invalid or test quizzes and submissions
-   ✅ View system statistics and activity logs

### System-Level Rules

-   ✅ Each quiz is linked to a specific course and instructor
-   ✅ All quiz creation, updates, submissions, grading, and feedback are timestamped and logged
-   ✅ Students cannot submit quizzes after the deadline
-   ✅ Historical quiz data and grades remain in the system for reporting and auditing

## Question Types Supported

1. **Multiple Choice** - Select one correct answer from multiple options
2. **True/False** - Boolean questions
3. **Short Answer** - Text-based answers (auto-graded if correct answer is set)
4. **Essay** - Long-form text answers (requires manual grading)

## Installation & Setup

### Prerequisites

-   PHP 8.1 or higher
-   Composer
-   MySQL or PostgreSQL database
-   Node.js and NPM (for asset compilation)

### Step 1: Install Dependencies

```bash
composer install
npm install
```

### Step 2: Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
copy .env.example .env
```

Update your database configuration in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lms_quiz
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 3: Generate Application Key

```bash
php artisan key:generate
```

### Step 4: Run Migrations

```bash
php artisan migrate
```

### Step 5: Seed Sample Data (Optional)

```bash
php artisan db:seed --class=QuizSystemSeeder
```

This will create:

-   1 Admin account
-   2 Teacher accounts
-   3 Student accounts
-   2 Sample courses
-   2 Sample quizzes with questions

### Step 6: Start Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Default Login Credentials (After Seeding)

### Admin

-   Email: admin@lms.com
-   Password: password

### Teacher

-   Email: teacher@lms.com
-   Password: password

### Student

-   Email: student1@lms.com
-   Password: password

## Project Structure

### Database Tables

-   **users** - User accounts with roles (admin, teacher, student)
-   **courses** - Course information
-   **quizzes** - Quiz/test metadata
-   **questions** - Quiz questions
-   **question_options** - Multiple choice/true-false options
-   **quiz_submissions** - Student quiz submissions
-   **submission_answers** - Individual question answers
-   **activity_logs** - System activity audit trail

### Controllers

**Admin:**

-   `UserController` - User management
-   `ConfigurationController` - System configuration and logs

**Teacher:**

-   `QuizController` - Quiz CRUD operations
-   `QuestionController` - Question management
-   `GradingController` - Submission grading

**Student:**

-   `QuizController` - Quiz taking
-   `ResultController` - View results and feedback

### Models

-   `User` - User model with role methods
-   `Course` - Course model
-   `Quiz` - Quiz model with availability checking
-   `Question` - Question model
-   `QuestionOption` - Question option model
-   `QuizSubmission` - Submission model with grade calculation
-   `SubmissionAnswer` - Answer model
-   `ActivityLog` - Activity logging model

### Views (Blade Templates)

All views use custom HTML/CSS (no Bootstrap or Tailwind dependencies):

**Admin Views:**

-   `admin/users/index.blade.php` - User list
-   `admin/users/create.blade.php` - Create user
-   `admin/users/edit.blade.php` - Edit user
-   `admin/configuration/index.blade.php` - System configuration

**Teacher Views:**

-   `teacher/quizzes/index.blade.php` - Quiz list
-   `teacher/quizzes/create.blade.php` - Create quiz
-   `teacher/quizzes/edit.blade.php` - Edit quiz & manage questions
-   `teacher/grading/index.blade.php` - Submissions list
-   `teacher/grading/show.blade.php` - Grade submission

**Student Views:**

-   `student/quizzes/index.blade.php` - Available quizzes
-   `student/quizzes/show.blade.php` - Take quiz
-   `student/results/index.blade.php` - Results list
-   `student/results/show.blade.php` - View detailed results

## Usage Guide

### Creating a Quiz (Teacher)

1. Log in as a teacher
2. Navigate to "My Quizzes"
3. Click "Create New Quiz"
4. Fill in quiz details (title, course, points, deadline, etc.)
5. Click "Create Quiz"
6. Add questions to the quiz
7. Publish the quiz when ready

### Taking a Quiz (Student)

1. Log in as a student
2. Navigate to "Available Quizzes"
3. Click "Take Quiz" on an available quiz
4. Answer all questions
5. Click "Submit Quiz"
6. View your results immediately (auto-graded portions)

### Grading Submissions (Teacher)

1. Log in as a teacher
2. Navigate to "Grading"
3. Click "Grade" on a pending submission
4. Review student answers
5. Adjust points if needed (for essay questions)
6. Add overall feedback
7. Click "Save Grade & Feedback"

### Managing Users (Admin)

1. Log in as an admin
2. Navigate to "Users"
3. Click "Add New User" to create accounts
4. Assign appropriate roles (admin, teacher, student)
5. Edit or delete users as needed

## Business Rules Implementation

### Deadline Enforcement

-   Students cannot submit quizzes after the `available_until` deadline
-   System checks deadline before accepting submissions
-   Past-deadline quizzes are marked as unavailable

### Activity Logging

-   All major actions are logged in `activity_logs` table
-   Logs include: user, action, entity type/ID, description, timestamp, IP address
-   Visible to admins in the Configuration page

### Data Retention

-   Quiz submissions are never automatically deleted
-   Historical grades are preserved
-   Activity logs provide audit trail
-   Soft delete can be implemented if needed

### Access Control

-   Role-based access control via middleware
-   Policies for quiz and submission access
-   Teachers can only manage their own quizzes
-   Students can only view their own submissions

## Security Features

-   Password hashing with bcrypt
-   CSRF protection on all forms
-   Role-based authorization
-   Policy-based resource access
-   Activity logging for auditing

## Customization

### Adding New Question Types

1. Add new type to `questions` migration enum
2. Update Question model validation
3. Add rendering logic in quiz show view
4. Add grading logic in Student QuizController

### Modifying Grading System

Edit `QuizSubmission::calculateGrade()` method to implement custom grading algorithms.

### Styling

All CSS is inline in `layouts/app.blade.php`. Modify the `<style>` section to customize appearance.

## Troubleshooting

### Migrations Fail

```bash
php artisan migrate:fresh
```

### Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Permission Issues

Ensure `storage` and `bootstrap/cache` directories are writable:

```bash
chmod -R 775 storage bootstrap/cache
```

## License

This project is open-source software licensed under the MIT license.

## Support

For issues or questions, please create an issue in the repository.
