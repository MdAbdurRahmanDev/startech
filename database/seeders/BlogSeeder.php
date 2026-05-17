<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Create Expert Category
        $expertCategory = BlogCategory::updateOrCreate(
            ['slug' => 'expert'],
            [
                'name' => 'Expert Suggestions & Tips',
                'description' => 'Expert guides, hardware troubleshooting, and servicing tips for your gadgets.',
                'status' => 1,
                'sort_order' => 1
            ]
        );

        // Create General Category
        $generalCategory = BlogCategory::updateOrCreate(
            ['slug' => 'general-tech'],
            [
                'name' => 'General Tech',
                'description' => 'General tech news, discussions, and updates.',
                'status' => 1,
                'sort_order' => 2
            ]
        );

        // Add Blog Posts under Expert category
        $posts = [
            [
                'title' => 'How to Prevent Laptop Overheating',
                'excerpt' => 'Is your laptop running hot? Learn the most effective tips to keep your laptop cool and boost performance.',
                'content' => '<h2>Why Laptops Overheat</h2><p>Laptops pack powerful hardware into tiny spaces. Over time, dust buildup and dried-out thermal paste can cause thermal throttling.</p><h2>Top Prevention Tips</h2><ul><li>Keep the vents clear by using the laptop on flat, hard surfaces.</li><li>Clean dust from the fans regularly using compressed air.</li><li>Use a high-quality cooling pad if you run heavy applications.</li><li>Repaste the CPU and GPU every 1-2 years if you are a power user.</li></ul>',
                'author' => 'Imtiaz Ahmed (Hardware Specialist)',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Projector Maintenance Guide',
                'excerpt' => 'Extend your projector\'s lamp life and get crystal-clear images with our ultimate projector care guide.',
                'content' => '<h2>Projector Care Basics</h2><p>Projectors generate significant heat, making proper air circulation vital. Follow these practices to save your investment.</p><h2>Essential Steps</h2><ol><li><strong>Clean the dust filters:</strong> Washable or replaceable filters must be cleaned every 100 hours of use.</li><li><strong>Never unplug immediately:</strong> Allow the projector fan to cool down completely before switching off primary power.</li><li><strong>Watch the placement:</strong> Ensure at least 50cm of clearance around exhaust vents.</li></ol>',
                'author' => 'Sohanur Rahman (AV Expert)',
                'featured' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Desktop PC Cleaning Tips',
                'excerpt' => 'A dusty PC is a slow PC. Here is step-by-step guidance to safely clean your desktop components.',
                'content' => '<h2>Preparing for Clean-up</h2><p>Before starting, disconnect all cables and move your PC to an open, well-ventilated space. Ground yourself to avoid electrostatic damage.</p><h2>Safe Cleaning Routine</h2><ul><li>Use compressed air to blow out dust from radiators, fans, and the power supply.</li><li>Hold fan blades in place to prevent them from spinning excessively while cleaning.</li><li>Wipe the case interior with an isopropyl-alcohol damp microfiber cloth.</li></ul>',
                'author' => 'Mahmudul Hasan (System Builder)',
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Signs of a Failing Hard Drive',
                'excerpt' => 'Don\'t wait for data loss! Recognize these early warning signs of a failing SSD or HDD before it is too late.',
                'content' => '<h2>Critical Warning Signs</h2><p>Data drives give subtle warnings before total failure. Learn to read these symptoms early:</p><ul><li>Frequent, unexplained system crashes or blue screens (BSOD).</li><li>Extremely slow file access times or missing folders.</li><li>Strange clicking, grinding, or whirring noises (HDD specific).</li><li>S.M.A.R.T errors during system boot-up.</li></ul><p>Always maintain a regular 3-2-1 backup strategy for crucial data.</p>',
                'author' => 'Asif Khan (Data Recovery Team)',
                'featured' => false,
                'sort_order' => 4,
            ]
        ];

        foreach ($posts as $post) {
            Blog::updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'blog_category_id' => $expertCategory->id,
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'author' => $post['author'],
                    'featured' => $post['featured'],
                    'status' => 1,
                    'sort_order' => $post['sort_order'],
                    'published_at' => now(),
                ]
            );
        }
    }
}
