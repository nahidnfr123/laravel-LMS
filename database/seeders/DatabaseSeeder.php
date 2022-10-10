<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'admin user',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
            'role' => 'admin',
            'phone' => '01212121212',
        ]);

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
        Section::create(['course_id' => $course1->id, 'title' => 'Chapter 1']);
        Section::create(['course_id' => $course1->id, 'title' => 'Chapter 2']);
        Section::create(['course_id' => $course1->id, 'title' => 'Chapter 3']);
        Section::create(['course_id' => $course1->id, 'title' => 'Chapter 4']);
        Section::create(['course_id' => $course1->id, 'title' => 'Chapter 5']);

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
    }
}
