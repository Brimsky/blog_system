<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest tech news, reviews, and tutorials covering software, hardware, and emerging technologies.',
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Frontend and backend development, frameworks, tools, and best practices for modern web development.',
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'iOS, Android, and cross-platform mobile app development tutorials and insights.',
            ],
            [
                'name' => 'Artificial Intelligence',
                'slug' => 'artificial-intelligence',
                'description' => 'AI, machine learning, deep learning, and the future of intelligent systems.',
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'DevOps practices, CI/CD, containerization, cloud computing, and infrastructure automation.',
            ],
            [
                'name' => 'Cybersecurity',
                'slug' => 'cybersecurity',
                'description' => 'Security best practices, threat analysis, and protecting digital assets.',
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Data analysis, visualization, big data, and extracting insights from complex datasets.',
            ],
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'description' => 'Programming languages, coding tutorials, algorithms, and software engineering principles.',
            ],
            [
                'name' => 'Startup',
                'slug' => 'startup',
                'description' => 'Entrepreneurship, startup advice, business development, and success stories.',
            ],
            [
                'name' => 'Career',
                'slug' => 'career',
                'description' => 'Career advice, professional development, and navigating the tech industry.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}
