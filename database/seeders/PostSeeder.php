<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();

        $posts = [
            [
                'title' => 'Getting Started with Laravel 11: A Complete Guide',
                'body' => 'Laravel 11 brings exciting new features and improvements to the popular PHP framework. In this comprehensive guide, we\'ll explore the key changes, new features, and how to get started with your first Laravel 11 project. Laravel has always been known for its elegant syntax and powerful features, and version 11 continues this tradition. The new version includes improved performance, better developer experience, and several new features that make development even more enjoyable. First, let\'s talk about the installation process. Laravel 11 requires PHP 8.2 or higher, so make sure your development environment is up to date. You can install Laravel using Composer with the command: composer create-project laravel/laravel my-app.
                One of the most significant improvements in Laravel 11 is the enhanced routing system. The new routing engine is faster and more flexible, allowing for better organization of your application\'s routes. The middleware system has also been improved, making it easier to apply middleware to groups of routes.
                Another exciting feature is the improved Eloquent ORM. Laravel 11 includes better relationship handling, improved query performance, and new methods that make database interactions more intuitive. The new query builder also includes better support for complex joins and subqueries.
                Testing has always been a strong point of Laravel, and version 11 makes it even better. The new testing features include improved HTTP testing, better database testing tools, and enhanced assertion methods that make writing tests more straightforward.
                Performance is another area where Laravel 11 shines. The framework now includes better caching mechanisms, optimized database queries, and improved memory usage. These improvements make Laravel applications faster and more scalable.
                In conclusion, Laravel 11 is a significant step forward for the framework. Whether you\'re a seasoned Laravel developer or just getting started, version 11 offers something for everyone.',
                'status' => 'published',
                'categories' => ['Web Development', 'Programming'],
            ],
            [
                'title' => 'The Future of Artificial Intelligence in 2025',
                'body' => 'Artificial Intelligence continues to evolve at an unprecedented pace. As we move through 2025, we\'re seeing remarkable advancements that are reshaping industries and changing how we interact with technology.
                Machine Learning has become more accessible than ever before. Tools and frameworks that once required PhD-level expertise are now available to developers with basic programming skills. This democratization of AI is leading to innovative applications across various sectors.
                Natural Language Processing has made significant strides. Large Language Models are becoming more sophisticated, capable of understanding context, nuance, and even humor. This progress is revolutionizing customer service, content creation, and human-computer interaction.
                Computer Vision applications are expanding beyond traditional use cases. From medical diagnostics to autonomous vehicles, AI-powered vision systems are becoming more accurate and reliable. The integration of AI with IoT devices is creating smart environments that can adapt to human behavior.
                However, with great power comes great responsibility. The ethical implications of AI development cannot be ignored. Issues such as bias in algorithms, privacy concerns, and job displacement need to be addressed as AI becomes more prevalent in our daily lives.
                The future of AI looks promising, but it requires careful consideration of its impact on society. As developers and technologists, we have a responsibility to create AI systems that benefit humanity while minimizing potential harm.',
                'status' => 'published',
                'categories' => ['Artificial Intelligence', 'Technology'],
            ],
            [
                'title' => 'Modern CSS Techniques: Grid, Flexbox, and Beyond',
                'body' => 'CSS has evolved tremendously over the years, and modern CSS techniques allow developers to create complex layouts with ease. In this post, we\'ll explore some of the most powerful CSS features available today.
                CSS Grid has revolutionized how we approach layout design. Unlike traditional layout methods, Grid allows you to create two-dimensional layouts with precise control over both rows and columns. The grid-template-areas property makes it intuitive to visualize and create complex layouts.
                Flexbox remains one of the most useful CSS features for one-dimensional layouts. Whether you\'re centering content, creating navigation bars, or building responsive components, Flexbox provides a flexible and powerful solution. The combination of justify-content and align-items properties makes centering trivial.
                CSS Custom Properties (variables) have become essential for maintainable stylesheets. They allow you to define reusable values and create dynamic themes. Combined with calc() functions, custom properties enable sophisticated design systems.
                Modern CSS also includes powerful features like CSS Container Queries, which allow components to adapt based on their container size rather than the viewport. This enables truly modular, responsive design patterns.
                Animation and transitions in CSS have also improved significantly. With features like CSS Motion Path and improved transforms, creating smooth, performant animations is easier than ever.
                The future of CSS looks bright with upcoming features like CSS Nesting, Cascade Layers, and improved color functions. These additions will make CSS even more powerful and developer-friendly.',
                'status' => 'published',
                'categories' => ['Web Development', 'Technology'],
            ],
            [
                'title' => 'Building Scalable APIs with Node.js and Express',
                'body' => 'Creating APIs that can handle thousands of concurrent requests requires careful planning and implementation. Node.js and Express provide an excellent foundation for building scalable APIs, but there are several best practices you should follow.
                First, let\'s talk about architecture. A well-structured API follows the MVC (Model-View-Controller) pattern or similar architectural principles. Separating concerns makes your code more maintainable and testable. Consider using a layered architecture with controllers, services, and data access layers.
                Database optimization is crucial for API performance. Use connection pooling to manage database connections efficiently. Implement proper indexing strategies and consider using read replicas for heavy read operations. MongoDB and PostgreSQL both offer excellent scaling options.
                Caching is another critical aspect of API scalability. Implement multiple layers of caching: application-level caching with Redis, HTTP caching with proper headers, and CDN caching for static resources. This can dramatically reduce response times and server load.
                Rate limiting protects your API from abuse and ensures fair usage among clients. Implement rate limiting at multiple levels: per-user, per-IP, and globally. Tools like express-rate-limit make this straightforward to implement.
                Error handling and logging are essential for maintaining scalable APIs. Implement centralized error handling and use structured logging with tools like Winston. This makes debugging and monitoring much easier as your API grows.
                Security should never be an afterthought. Implement proper authentication and authorization, validate all inputs, use HTTPS everywhere, and keep dependencies updated. Regular security audits are essential for production APIs.
                Monitoring and observability become crucial as your API scales. Implement health checks, metrics collection, and distributed tracing. Tools like Prometheus, Grafana, and Jaeger can provide valuable insights into your API\'s performance.',
                'status' => 'published',
                'categories' => ['Web Development', 'Programming'],
            ],
            [
                'title' => 'DevOps Best Practices for Modern Development Teams',
                'body' => 'DevOps has transformed how development teams build, deploy, and maintain applications. Implementing DevOps practices can significantly improve development velocity, application reliability, and team collaboration.
                Continuous Integration and Continuous Deployment (CI/CD) form the backbone of modern DevOps practices. Automated testing, building, and deployment pipelines ensure that code changes are thoroughly tested and deployed consistently. Tools like Jenkins, GitLab CI, and GitHub Actions make implementing CI/CD pipelines straightforward.
                Infrastructure as Code (IaC) revolutionizes how we manage infrastructure. Tools like Terraform, CloudFormation, and Ansible allow teams to define infrastructure using code, making it versionable, reviewable, and reproducible. This approach eliminates configuration drift and makes disaster recovery much easier.
                Containerization with Docker has become standard practice for application deployment. Containers provide consistency across development, testing, and production environments. Container orchestration platforms like Kubernetes add scalability, self-healing, and advanced deployment strategies.
                Monitoring and observability are critical for maintaining reliable systems. Implement comprehensive monitoring that covers application metrics, infrastructure health, and user experience. The three pillars of observability - metrics, logs, and traces - provide complete visibility into system behavior.
                Security must be integrated throughout the development lifecycle, not bolted on afterward. Implement security scanning in CI/CD pipelines, use security-focused linting tools, and regularly audit dependencies for vulnerabilities. The shift-left security approach catches issues early when they\'re cheaper to fix.
                Collaboration tools and practices are essential for DevOps success. Use version control for everything, implement code review processes, and maintain good documentation. Chat-based collaboration tools like Slack or Microsoft Teams can integrate with development tools to keep everyone informed.
                The key to successful DevOps implementation is starting small and iterating. Choose one area to improve, measure the results, and gradually expand DevOps practices across your organization.',
                'status' => 'published',
                'categories' => ['DevOps', 'Technology'],
            ],
            [
                'title' => 'Mobile Development Trends: Flutter vs React Native',
                'body' => 'The mobile development landscape continues to evolve, with cross-platform frameworks gaining significant traction. Two frameworks dominate this space: Flutter and React Native. Let\'s explore their strengths, weaknesses, and use cases.
                Flutter, Google\'s UI toolkit, has gained impressive adoption since its stable release. Built with Dart, Flutter compiles to native code and provides excellent performance. The framework\'s widget-based architecture makes it easy to create custom, pixel-perfect UIs that look consistent across platforms.
                React Native, Facebook\'s framework, leverages JavaScript and React concepts familiar to web developers. It uses native components under the hood, which means apps feel truly native. The large JavaScript ecosystem and extensive third-party library support make development faster for teams already familiar with React.
                Performance is a key consideration for mobile apps. Flutter\'s compilation to native code generally provides better performance, especially for graphics-intensive applications. React Native\'s bridge architecture can introduce performance bottlenecks, though recent improvements like the New Architecture (Fabric and TurboModules) address many of these issues.
                Developer experience varies between the frameworks. React Native benefits from hot reloading and a large pool of JavaScript developers. Flutter\'s hot reload is exceptionally fast, and its comprehensive widget library reduces the need for third-party dependencies.
                Platform-specific features require different approaches in each framework. React Native often requires native modules for complex platform features, which can complicate development. Flutter provides platform channels that make native integration more straightforward.
                Community and ecosystem support are crucial for long-term success. React Native has a larger, more mature ecosystem with extensive third-party libraries. Flutter\'s ecosystem is growing rapidly, and Google\'s strong backing provides confidence in its future.
                The choice between Flutter and React Native often depends on team expertise, project requirements, and long-term goals. Both frameworks are excellent choices for cross-platform development, and the "best" choice depends on your specific context.',
                'status' => 'published',
                'categories' => ['Mobile Development', 'Technology'],
            ],
            [
                'title' => 'Cybersecurity Fundamentals for Developers',
                'body' => 'Security should be a primary concern for every developer, regardless of the type of application being built. Understanding fundamental security principles and implementing them from the start can prevent costly security breaches and protect user data.
                The principle of least privilege is fundamental to secure application design. Users and systems should only have access to the resources they absolutely need to perform their functions. This limits the potential damage if an account is compromised and reduces the attack surface of your application.
                Input validation is one of the most important security practices. Never trust user input, whether it comes from forms, APIs, or file uploads. Implement both client-side and server-side validation, with server-side validation being non-negotiable for security. Use parameterized queries to prevent SQL injection and validate file uploads carefully.
                Authentication and authorization must be implemented correctly. Use strong password policies, implement multi-factor authentication where possible, and use secure session management. JWT tokens should be properly validated and have appropriate expiration times. Consider using established authentication services rather than rolling your own.
                Encryption protects data both in transit and at rest. Use HTTPS for all communications, encrypt sensitive data in databases, and use proper key management practices. Never store passwords in plain text - use strong hashing algorithms like bcrypt with appropriate salt values.
                Regular security updates are crucial for maintaining application security. Keep all dependencies, frameworks, and runtime environments updated. Use tools like npm audit, bundle-audit, or similar to identify vulnerable dependencies. Implement automated dependency updates where possible.
                Security testing should be integrated into your development process. Use static analysis tools to identify potential security issues in code. Implement dynamic testing to find runtime security vulnerabilities. Consider penetration testing for critical applications.
                Logging and monitoring help detect and respond to security incidents. Log security-relevant events, but be careful not to log sensitive information. Implement anomaly detection to identify unusual patterns that might indicate an attack. Have an incident response plan ready for when security issues occur.',
                'status' => 'published',
                'categories' => ['Cybersecurity', 'Programming'],
            ],
            [
                'title' => 'Data Science with Python: From Beginner to Advanced',
                'body' => 'Python has become the de facto language for data science, thanks to its simplicity and powerful ecosystem of libraries. Whether you\'re just starting or looking to advance your skills, this guide covers the essential concepts and tools.
                Getting started with data science requires understanding the fundamental libraries. NumPy provides the foundation for numerical computing, offering efficient array operations and mathematical functions. Pandas builds on NumPy to provide powerful data structures and analysis tools, making data manipulation intuitive and efficient.
                Data visualization is crucial for understanding and communicating insights. Matplotlib offers fine-grained control over visualizations, while Seaborn provides beautiful statistical visualizations with less code. For interactive visualizations, Plotly and Bokeh offer web-based charting capabilities.
                Machine learning with scikit-learn makes implementing algorithms straightforward. The library provides consistent APIs for classification, regression, clustering, and dimensionality reduction. Feature engineering, model selection, and evaluation metrics are all included in this comprehensive package.
                Deep learning has revolutionized many areas of data science. TensorFlow and PyTorch are the leading frameworks, each with their strengths. TensorFlow offers production-ready deployment options and Keras for high-level model building. PyTorch provides dynamic computation graphs and an intuitive research-focused API.
                Jupyter Notebooks have become the standard environment for data science work. They allow for interactive development, easy visualization, and excellent documentation capabilities. JupyterLab extends this with a more IDE-like experience while maintaining notebook functionality.
                Real-world data science projects involve more than just algorithms. Data cleaning often takes 80% of the time, requiring skills in handling missing values, outliers, and inconsistent formats. Feature engineering can make the difference between a mediocre and excellent model.
                Best practices include version control for code and data, reproducible environments with tools like conda or Docker, and proper documentation. As projects grow, consider workflow management tools like Apache Airflow for complex data pipelines.
                The field of data science continues to evolve rapidly. Staying current requires continuous learning, participating in the community through platforms like Kaggle, and working on diverse projects to build a strong portfolio.',
                'status' => 'published',
                'categories' => ['Data Science', 'Programming'],
            ],
            [
                'title' => 'Starting Your Tech Career: A Roadmap for Success',
                'body' => 'Breaking into the tech industry can seem daunting, but with the right approach and dedication, it\'s absolutely achievable. This roadmap will guide you through the essential steps to launch a successful career in technology.
                First, identify your area of interest within tech. The industry is vast, encompassing software development, data science, cybersecurity, UX/UI design, product management, and many other specializations. Research different roles, their responsibilities, and required skills to find what aligns with your interests and strengths.
                Building foundational skills is crucial regardless of your chosen path. For software development, start with programming fundamentals and choose a language based on your goals. Python is excellent for beginners and versatile across many domains. JavaScript is essential for web development. Consider online platforms like freeCodeCamp, Codecademy, or The Odin Project for structured learning.
                Creating a portfolio showcases your skills to potential employers. Build projects that demonstrate your abilities and solve real problems. For developers, this means creating applications with clean code and good documentation. For designers, showcase your design process and thinking. Make your work accessible through platforms like GitHub, Behance, or a personal website.
                Networking is invaluable in the tech industry. Attend local meetups, join online communities, and engage with professionals on LinkedIn and Twitter. Many opportunities come through connections rather than cold applications. Don\'t be afraid to reach out to people for informational interviews - most tech professionals are happy to help newcomers.
                Gaining practical experience can happen in various ways. Contribute to open source projects to work with experienced developers and build your reputation. Look for internships, even if you\'re changing careers. Consider freelance projects or building applications for local businesses. Any real-world experience adds credibility to your resume.
                Preparing for interviews requires both technical and soft skills preparation. Practice coding problems on platforms like LeetCode or HackerRank. Prepare for behavioral questions using the STAR method. Research companies thoroughly and prepare thoughtful questions about their technology stack and culture.
                Continuous learning is essential in tech. The industry evolves rapidly, and staying current with new technologies, frameworks, and best practices is crucial for long-term success. Set aside time regularly for learning and experimenting with new tools.
                Don\'t let imposter syndrome hold you back. Everyone starts somewhere, and the tech community is generally supportive of newcomers who show enthusiasm and dedication. Focus on continuous improvement rather than perfection, and remember that even experienced professionals are constantly learning.',
                'status' => 'published',
                'categories' => ['Career', 'Technology'],
            ],
            [
                'title' => 'Building a Successful Tech Startup in 2025',
                'body' => 'The startup landscape has evolved significantly, with new technologies and changing market dynamics creating both opportunities and challenges. Building a successful tech startup in 2025 requires understanding these changes and adapting accordingly.
                Idea validation is more critical than ever in today\'s competitive market. Before building anything, validate your assumptions through customer interviews, surveys, and market research. Create a minimum viable product (MVP) to test your core hypothesis with real users. Tools like landing page builders and no-code platforms make it easier than ever to test ideas quickly and cheaply.
                Technology choices can make or break an early-stage startup. Choose proven technologies that allow for rapid development and easy scaling. Consider using cloud services to minimize infrastructure overhead. Microservices architecture can provide flexibility, but monoliths are often better for early-stage startups due to their simplicity.
                Building the right team is crucial for startup success. In the early stages, look for versatile individuals who can wear multiple hats. Cultural fit is as important as technical skills - startups require people who thrive in uncertain, fast-paced environments. Consider remote work to access global talent pools.
                Funding options have diversified beyond traditional venture capital. Bootstrapping allows you to maintain control but limits growth speed. Angel investors can provide valuable mentorship along with capital. Venture capital offers larger amounts but comes with pressure for rapid growth. Alternative funding like revenue-based financing is becoming more popular.
                Customer acquisition strategies must be data-driven and efficient. In today\'s environment, organic growth through product-market fit is more valuable than paid acquisition. Focus on retention metrics as much as acquisition - it\'s much cheaper to keep existing customers than acquire new ones. Build virality into your product where possible.
                Operational efficiency becomes important earlier than many founders realize. Implement good financial controls, use metrics dashboards to track key performance indicators, and establish processes that can scale. Tools like Stripe for payments, Segment for analytics, and various CRM systems can provide enterprise-grade capabilities to small teams.
                The regulatory environment is increasingly complex, especially for startups dealing with user data, financial services, or healthcare. Understanding compliance requirements early can prevent costly pivots later. Consider working with specialized legal counsel familiar with your industry.
                Mental health and work-life balance are increasingly recognized as crucial for long-term success. Building a sustainable company requires sustainable practices. Encourage time off, maintain reasonable working hours, and create a culture that values both achievement and well-being.
                åSuccess metrics have evolved beyond just growth and revenue. Sustainable unit economics, customer satisfaction, and environmental impact are increasingly important to investors and customers alike. Build measurement and reporting into your operations from day one.',
                'status' => 'published',
                'categories' => ['Startup', 'Technology'],
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'body' => $postData['body'],
                'status' => $postData['status'],
                'user_id' => $users->random()->id,
                'created_at' => now()->subDays(rand(1, 30)),
            ]);

            $categoryIds = [];
            foreach ($postData['categories'] as $categoryName) {
                $category = $categories->firstWhere('name', $categoryName);
                if ($category) {
                    $categoryIds[] = $category->id;
                }
            }
            $post->categories()->attach($categoryIds);
        }

        $draftPosts = [
            [
                'title' => 'Advanced React Patterns and Best Practices',
                'body' => 'This is a draft post about advanced React patterns that is still being written...',
                'status' => 'draft',
                'categories' => ['Web Development'],
            ],
            [
                'title' => 'Machine Learning for Beginners: Getting Started Guide',
                'body' => 'A comprehensive guide for beginners who want to start their machine learning journey...',
                'status' => 'draft',
                'categories' => ['Artificial Intelligence', 'Data Science'],
            ],
        ];

        foreach ($draftPosts as $postData) {
            $post = Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'body' => $postData['body'],
                'status' => $postData['status'],
                'user_id' => $users->random()->id,
                'created_at' => now()->subDays(rand(1, 10)),
            ]);

            $categoryIds = [];
            foreach ($postData['categories'] as $categoryName) {
                $category = $categories->firstWhere('name', $categoryName);
                if ($category) {
                    $categoryIds[] = $category->id;
                }
            }
            $post->categories()->attach($categoryIds);
        }

        $this->command->info('Posts seeded successfully!');
    }
}
