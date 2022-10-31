<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Assignment;
use App\Models\Batch;
use App\Models\Clas;
use App\Models\CommunityCategory;
use App\Models\CommunityTags;
use App\Models\Content;
use App\Models\Course;
use App\Models\Exam;
use App\Models\LiveClass;
use App\Models\Note;
use App\Models\Pdf;
use App\Models\RecordedClass;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \JsonException
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
        ]);

        $admin = User::updateOrCreate(['phone' => '01212121212'], [
            'name' => 'admin user',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
            'role' => 'admin',
            'phone' => '01212121212',
        ]);

        $mayesha = User::updateOrCreate(['phone' => '01212121211'], [
            'name' => 'mayesha',
            'email' => 'mayesha@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'teacher',
            'phone' => '01212121211',
        ]);

        $student1 = User::updateOrCreate(['phone' => '01212121213'], [
            'name' => 'student 1 user',
            'email' => 'student1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'student',
            'phone' => '01212121213',
        ]);

        $student2 = User::updateOrCreate(['phone' => '01212121214'], [
            'name' => 'student 2 user',
            'email' => 'student2@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'student',
            'phone' => '01212121214',
        ]);

        $admin->assignRole('admin');
        $mayesha->assignRole('teacher');
        $student1->assignRole('student');
        $student2->assignRole('student');

        $course1 = Course::create([
            'title' => 'Course 1 (Paid)',
            'subtitle' => 'Course 1',
            'photo' => '/storage/uploads/img/JfPm6wPAI51KgfJvPKUlhnrluICqpPDbfoLgV13N.jpg',
            'description' => 'Course 1',
            'price' => 2000,
            'discounted_price' => 1500,
            'available_at' => Carbon::now(),
            'featured' => true,
        ]);
        $section1 = Section::create(['course_id' => $course1->id, 'title' => 'Chapter 1']);
        Section::create(['course_id' => $course1->id, 'title' => 'Chapter 2']);

        $content1 = Content::create(['section_id' => $section1->id, 'title' => 'Introductory Video', 'type' => 'recorded_class', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content2 = Content::create(['section_id' => $section1->id, 'title' => 'CLASS 1 Note', 'type' => 'note', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content3 = Content::create(['section_id' => $section1->id, 'title' => 'LIVE CLASS 1', 'type' => 'live_class', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content4 = Content::create(['section_id' => $section1->id, 'title' => 'Class 2 Note', 'type' => 'note', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content5 = Content::create(['section_id' => $section1->id, 'title' => 'LIVE CLASS 2', 'type' => 'live_class', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content6 = Content::create(['section_id' => $section1->id, 'title' => 'Pdf Notes', 'type' => 'pdf', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content7 = Content::create(['section_id' => $section1->id, 'title' => 'Exam 1', 'type' => 'exam', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content8 = Content::create(['section_id' => $section1->id, 'title' => 'Exam 2', 'type' => 'exam', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content9 = Content::create(['section_id' => $section1->id, 'title' => 'Assignment 1', 'type' => 'assignment', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);
        $content10 = Content::create(['section_id' => $section1->id, 'title' => 'Assignment 2', 'type' => 'assignment', 'paid' => 1, 'status' => 1, 'available_at' => Carbon::now(),]);

        RecordedClass::create(['content_id' => $content1->id, 'link' => 'https://www.youtube.com/embed/J3nhis7d5Rs']);
        Note::create(['content_id' => $content2->id, 'note' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.']);
        LiveClass::create(['content_id' => $content3->id, 'start_time' => Carbon::now(), 'end_time' => Carbon::now()->addMinutes(120), 'link' => 'https://www.youtube.com/watch?v=J3nhis7d5Rs&list=PLFHz2csJcgk_mM2jEf7t8P678O_jz83on']);
        Note::create(['content_id' => $content4->id, 'note' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.']);
        LiveClass::create(['content_id' => $content5->id, 'start_time' => Carbon::now()->addDay(), 'end_time' => Carbon::now()->addDay()->addMinutes(60), 'link' => 'https://www.youtube.com/watch?v=J3nhis7d5Rs&list=PLFHz2csJcgk_mM2jEf7t8P678O_jz83on']);
        Pdf::create(['content_id' => $content6->id, 'link' => '/storage/uploads/assignments/obMMzPyB29pHWszdEM8rcrIoXZUpdMl4S01R6O8U.pdf']);
        Exam::create([
            'content_id' => $content7->id,
            'duration' => 20,
            'description' => 'Question Description',
            'per_question_mark' => 1,
            'negative_mark' => 0,
            'pass_mark' => 10,
            'result_publish_time' => Carbon::now()->addDays(10),
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addDays(10),
        ]);
        Exam::create([
            'content_id' => $content8->id,
            'duration' => 20,
            'description' => 'Question Description',
            'per_question_mark' => 1,
            'negative_mark' => 0,
            'pass_mark' => 10,
            'result_publish_time' => Carbon::now()->addDays(10),
            'start_time' => Carbon::now()->addDay(),
            'end_time' => Carbon::now()->addDays(10),
        ]);
        Assignment::create(['content_id' => $content9->id, 'start_time' => Carbon::now()->addDay(), 'end_time' => Carbon::now()->addDays(10), 'total_mark' => 20, 'question' => 'Assignment Question']);
        Assignment::create(['content_id' => $content10->id, 'start_time' => Carbon::now()->addDays(2), 'end_time' => Carbon::now()->addDays(12), 'total_mark' => 20, 'question' => 'Assignment Question']);


        $course2 = Course::create([
            'title' => 'Course 2 (Free)',
            'subtitle' => 'Course 2',
            'photo' => '/storage/uploads/img/CXpripqed43xXI8y2rrZ0yZQe6XoxRT8Vcwx7jRQ.jpg',
            'description' => 'Course 2',
            'price' => 0,
            'discounted_price' => 0,
            'available_at' => Carbon::now(),
            'featured' => true,
        ]);
        Section::create(['course_id' => $course2->id, 'title' => 'Chapter 1']);
        Section::create(['course_id' => $course2->id, 'title' => 'Chapter 2']);
        Section::create(['course_id' => $course2->id, 'title' => 'Chapter 3']);


        CommunityCategory::create(['name' => 'Category 1', 'description' => 'Category 1', 'active' => true,]);
        CommunityCategory::create(['name' => 'Category 2', 'description' => 'Category 2', 'active' => true,]);
        CommunityCategory::create(['name' => 'Category 3', 'description' => 'Category 3', 'active' => true,]);

        CommunityTags::create(['name' => 'Tag 1', 'active' => true,]);
        CommunityTags::create(['name' => 'Tag 2', 'active' => true,]);
        CommunityTags::create(['name' => 'Tag 3', 'active' => true,]);
        CommunityTags::create(['name' => 'Tag 4', 'active' => true,]);

        $course2->users()->detach($student1->id);
        $course2->users()->attach($student1->id, ['status' => 'active']);

        $course2->users()->detach($student2->id);
        $course2->users()->attach($student2->id, ['status' => 'active']);

        Subject::create([
            'title' => 'Business Information Technology',
            'short_title' => 'bit',
            'duration' => 4,
            'total_semesters' => 8,
            'semester_duration' => 6,
        ]);

        Semester::create([
            'subject_id' => 1,
            'title' => 'International foundation Year',
            'short_title' => 'ify',
            'duration' => 12,
        ]);
        Semester::create([
            'subject_id' => 1,
            'title' => 'Level 4 Diploma in Computing',
            'short_title' => 'l4dc',
            'duration' => 12,
        ]);
        Semester::create([
            'subject_id' => 1,
            'title' => 'Level 5 Diploma in Computing',
            'short_title' => 'l5dc',
            'duration' => 12,
        ]);
        Semester::create([
            'subject_id' => 1,
            'title' => 'Level 5 Diploma in Computing',
            'short_title' => 'l5dc',
            'duration' => 12,
        ]);

        Topic::create([
            'semester_id' => 1,
            'title' => 'Dynamic Website',
            'short_title' => 'dw',
        ]);

        Topic::create([
            'semester_id' => 1,
            'title' => 'Database Design And Development',
            'short_title' => 'ddd',
        ]);

        Batch::create([
            'semester_id' => 1,
            'subject_id' => 1,
            'batch_id' => 'ify45',
        ]);

        Batch::create([
            'semester_id' => 1,
            'subject_id' => 1,
            'batch_id' => 'ify46',
        ]);


        Clas::create([
            'topic_id' => 1,
            'semester_id' => 1,
            'batch_id' => 1,
            'class_time' => Carbon::now(),
            'duration' => 60,
        ]);
    }
}
