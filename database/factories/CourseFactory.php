<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
     return [
            'title' => $this->faker->sentence(3), // ৩ শব্দের একটি র‍্যান্ডম বাক্য (যেমন: "Learn Laravel Basics")
            'description' => $this->faker->paragraph(), // একটি প্যারাগ্রাফ পরিমাণ র‍্যান্ডম লেখা
       ];
        
    }
}
