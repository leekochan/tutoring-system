<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Tutor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'username' => '28196',
            'name' => 'Lee Robin Montenegro',
            'password' => Hash::make('1234'),
            'role' => 'tutor',
        ]);

        Tutor::create([
            'tutor_id' => '28196',
            'tutor_name' => 'Lee Robin Montenegro',
        ]);

        Lesson::create([
            'lesson_tutor' => '28196',
            'title' => 'Mathematics in the Modern World',
            'description' => 'Mathematics in the Modern World explores the practical applications of mathematical concepts in everyday life. It delves into topics like statistics, probability, geometry, and financial mathematics, demonstrating how these concepts shape our understanding of the world and inform decision-making.',
            'price' => '1000',
            'duration' => '6',
            'topics' => '4'
        ]);

        User::factory()->create([
            'username' => '28197',
            'name' => 'Kenneth Hulab',
            'password' => Hash::make('1234'),
            'role' => 'tutor',
        ]);

        Tutor::create([
            'tutor_id' => '28197',
            'tutor_name' => 'Kenneth Hulab'
        ]);

        Lesson::create([
            'lesson_tutor' => '28197',
            'title' => 'Software Engineering',
            'description' => 'Software Engineering is the systematic approach to designing, developing, testing, and maintaining software applications. It involves

 1  a blend of technical skills and problem-solving abilities to create efficient and reliable software solutions that meet specific needs.',
            'price' => '2000',
            'duration' => '8',
            'topics' => '3'
        ]);

        User::factory()->create([
            'username' => '28198',
            'name' => 'Albenzar Sagad',
            'password' => Hash::make('1234'),
            'role' => 'student',
        ]);

//        Tutor::create([
//            'tutor_id' => '28198',
//            'tutor_name' => 'Albenzar Sagad'
//        ]);
//
//        Lesson::create([
//            'lesson_tutor' => '28198',
//            'title' => 'Application Development',
//            'description' => 'This is the example description for Application Development',
//            'price' => '2000',
//            'duration' => '60 hours',
//            'topics' => '15 topics'
//        ]);


    }
}
