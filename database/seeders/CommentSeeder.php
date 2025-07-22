<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $posts = Post::where('status', 'published')->get();

        $comments = [
            'Great article! This really helped me understand the concepts better.',
            'Thanks for sharing this. I\'ve been looking for exactly this information.',
            'Excellent explanation. Do you have any recommendations for further reading?',
            'This is very helpful. I\'ll definitely try implementing this in my next project.',
            'Love the detailed examples. Makes it much easier to follow along.',
            'Could you elaborate more on the performance implications?',
            'This approach worked perfectly for my use case. Thank you!',
            'Really well written and easy to understand. Keep up the great work!',
            'I have a question about the implementation details. Could you provide more examples?',
            'This is exactly what I needed for my current project. Much appreciated!',
            'Interesting perspective. I hadn\'t considered this approach before.',
            'The code examples are very clear and well-commented.',
            'This tutorial saved me hours of research. Thank you so much!',
            'I disagree with some points, but overall a solid article.',
            'Can you recommend any tools that work well with this approach?',
            'This is a comprehensive guide. I\'ll be bookmarking this for future reference.',
            'Great job explaining complex concepts in simple terms.',
            'I\'ve been struggling with this issue, and your solution works perfectly.',
            'Any plans for a follow-up article on advanced techniques?',
            'This article convinced me to try this technology in my next project.',
        ];

        foreach ($posts as $post) {
            $numComments = rand(2, 8);

            for ($i = 0; $i < $numComments; $i++) {
                Comment::create([
                    'body' => $comments[array_rand($comments)],
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'created_at' => now()->subDays(rand(0, 25)),
                ]);
            }
        }

        $this->command->info('Comments seeded successfully!');
    }
}
