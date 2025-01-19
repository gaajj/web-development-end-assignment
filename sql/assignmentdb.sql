CREATE DATABASE IF NOT EXISTS assignmentdb;

USE assignmentdb;

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` ENUM('user', 'admin') DEFAULT 'user',
  `profile_picture` varchar(255) DEFAULT 'default.png',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

CREATE TABLE `posts` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `date_posted` datetime DEFAULT current_timestamp(),
    `upvote_count` INT DEFAULT 0,
    `downvote_count` INT DEFAULT 0,
    `author_id` INT NOT NULL,
    `is_deleted` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`author_id`) REFERENCES users(`id`)
);

CREATE TABLE `likes` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `user_id` INT DEFAULT NULL,
    `post_id` INT DEFAULT NULL,
    `created_at` timestamp DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES users(`id`),
    FOREIGN KEY (`post_id`) REFERENCES posts(`id`)
);

CREATE TABLE `comments` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `user_id` INT DEFAULT NULL,
    `post_id` INT DEFAULT NULL,
    `content` TEXT,
    `created_at` timestamp DEFAULT current_timestamp(),
    `is_deleted` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES users(`id`),
    FOREIGN KEY (`post_id`) REFERENCES posts(`id`)
);

-- Users Table Insertions
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_picture`) VALUES
    (1, 'admin', '$2y$12$majf1c5yGQjVzcqiaTwSH.rNUHDULi9DegudTKT53TeGQqWtfe/GG', 'admin@example.com', 'admin', NULL),
    (2, 'user', '$2y$12$ydpt94dLBPuTITkDU4eUTOpDLECJtH5iLdDM2kaVqIMZTvRv6dVbu', 'user@example.com', NULL, '678d50afe60be_Cat_November_2010-1a.jpg.png'),
    (3, 'bart', '$2y$12$2S.m5AXGkn4dbAeEZVchBu03guY1Z9WvNah9Pmi/5r269Jgt8Ep7e', 'bart@example.com', NULL, '678d4eba67caa_image.png'),
    (4, 'alice', '$2y$12$D83me2a7pUaT69EkMpIvEe/7CoYuDYu4Iay0.Oi0um1FPzg5LyE4G', 'alice@example.com', NULL, '678d509481f1d_NationalGeographic_1468962_16x9.png'),
    (5, 'bob', '$2y$12$HnjNR3DyPGc7W9hMT0.JJ.EA4WFdCzY8KyqqWiRKTYM8hrfrFXcSS', 'bob@example.com', NULL, NULL),
    (6, 'charlie', '$2y$12$PHFLhXiG269lYkcxYKx2hu3ANyYUwn06A4qge8x.oBxAdiD2rUls6', 'charlie@example.com', NULL, '678d50afe60be_Cat_November_2010-1a.jpg.png'),
    (7, 'david', '$2y$12$TumS687lKQ2UBuWfc7Vvt.tIRmBB.UVOv1U44drFFNpnbslRmSawG', 'david@example.com', NULL, '678d509481f1d_NationalGeographic_1468962_16x9.png'),
    (8, 'eve', '$2y$12$WR6iJzWpsXqY8beee4zq7OYwOJmRKan.CpawqLoU1zdGflBheCbIK', 'eve@example.com', NULL, NULL),
    (9, 'frank', '$2y$12$siy0/JOOQ1DRs3C/gsnt..gAo0Ptpb11W.9qPnZPWP3MTuxkCNjBi', 'frank@example.com', NULL, '678d4eba67caa_image.png'),
    (10, 'grace', '$2y$12$06il3PZoDn3LvqzYiQxjmuUkx8QJr0xxYhWKklLNbo5UscQAAsRuS', 'grace@example.com', NULL, '678d50afe60be_Cat_November_2010-1a.jpg.png');

-- Posts Table Insertions
INSERT INTO `posts` (`title`, `content`, `author_id`) VALUES
    ('How to Learn SQL', 'SQL is a fundamental skill for database management. Start by learning the basic commands like SELECT, INSERT, UPDATE, DELETE.', 1),
    ('My First Post on Technology', 'This post is about the impact of artificial intelligence in modern software development.', 2),
    ('Web Development Tips', 'Web development can be fun and challenging. Here are some tips to make your journey smoother.', 3),
    ('The Future of AI', 'AI is changing the world in so many ways. From self-driving cars to machine learning, the possibilities are endless.', 4),
    ('Tech Innovations in 2025', 'In 2025, we expect to see significant improvements in AI and quantum computing.', 5),
    ('The Importance of Version Control', 'Version control systems like Git are essential for managing code changes and collaborating with teams.', 6),
    ('Getting Started with Docker', 'Docker simplifies application deployment by containerizing your apps. Here’s how to get started.', 7),
    ('Introduction to Machine Learning', 'Machine learning is a subset of AI that focuses on building systems that learn from data.', 8),
    ('The Rise of NoSQL Databases', 'NoSQL databases like MongoDB and Cassandra are gaining popularity for their flexibility and scalability.', 9),
    ('Best Practices for API Design', 'Designing APIs requires careful planning to ensure they are scalable, secure, and easy to use.', 10),
    ('Hacker man', '<script>alert(''XSS'')</script>', 7);

-- Comments Table Insertions
INSERT INTO comments (user_id, post_id, content) VALUES
    -- Comments for Post 1: 'How to Learn SQL'
    (2, 1, 'Great tips! I really need to improve my SQL skills.'),
    (3, 1, 'I found the SELECT command quite difficult at first, but practice makes it easier!'),
    (4, 1, 'SQL is a must-learn for anyone working with databases!'),
    (5, 1, 'SQL is such a powerful tool for data analysis!'),
    (6, 1, 'I recommend practicing joins and subqueries to get a deeper understanding.'),

    -- Comments for Post 2: 'My First Post on Technology'
    (5, 2, 'AI is fascinating, but I think it will also bring challenges for job markets.'),
    (6, 2, 'Yes, AI is amazing, but I believe it needs to be regulated for ethical reasons.'),
    (7, 2, 'AI will change the way we interact with technology forever!'),
    (8, 2, 'The potential of AI in healthcare excites me the most.'),

    -- Comments for Post 3: 'Web Development Tips'
    (7, 3, 'Web development has indeed become more streamlined with modern tools like React and Vue.'),
    (8, 3, 'Totally agree! But I struggle with JavaScript sometimes.'),
    (9, 3, 'Great tips! CSS frameworks like Tailwind have been super helpful for me.'),
    (10, 3, 'JavaScript can be tricky, but once you get it, it’s so rewarding.'),

    -- Comments for Post 4: 'The Future of AI'
    (9, 4, 'AI is definitely the future, but we need to tread carefully with its applications.'),
    (10, 4, 'Absolutely, AI could do wonders in healthcare and education!'),
    (1, 4, 'AI is evolving so fast; I’m curious about its impact on education.'),
    (2, 4, 'We must also think about the ethical implications of AI.'),

    -- Comments for Post 5: 'Tech Innovations in 2025'
    (1, 5, 'I can’t wait for the advancements in quantum computing!'),
    (2, 5, 'Quantum computing will completely transform data encryption!'),
    (3, 5, '2025 is going to be a revolutionary year for tech!'),
    (4, 5, 'I hope quantum computing becomes accessible for more industries.'),

    -- Comments for Post 6: 'The Importance of Version Control'
    (5, 6, 'Version control saved me from losing hours of work!'),
    (6, 6, 'Git is such an essential tool for teamwork in software development.'),
    (7, 6, 'Learning Git commands can be tough, but they’re worth it.'),
    (8, 6, 'Version control is a game-changer for managing large projects.'),

    -- Comments for Post 7: 'Getting Started with Docker'
    (9, 7, 'Docker makes deployment so much easier. Highly recommend!'),
    (10, 7, 'Containerization is the future of application development.'),
    (1, 7, 'Learning Docker has streamlined my workflow significantly.'),
    (2, 7, 'The concept of containers was confusing at first but is amazing!'),

    -- Comments for Post 8: 'Introduction to Machine Learning'
    (3, 8, 'Machine learning is such an exciting field with endless possibilities.'),
    (4, 8, 'The potential of ML in predictive analytics is incredible!'),
    (5, 8, 'I’m currently learning supervised learning, and it’s fascinating.'),
    (6, 8, 'ML models like neural networks blow my mind every time!'),

    -- Comments for Post 9: 'The Rise of NoSQL Databases'
    (7, 9, 'NoSQL databases are perfect for scalable web applications.'),
    (8, 9, 'I love using MongoDB for projects with unstructured data.'),
    (9, 9, 'The flexibility of NoSQL makes it a great choice for modern apps.'),
    (10, 9, 'Cassandra is another great NoSQL database for high-availability systems.'),

    -- Comments for Post 10: 'Best Practices for API Design'
    (1, 10, 'Good API design is essential for building scalable applications.'),
    (2, 10, 'I always ensure APIs are well-documented for easier integration.'),
    (3, 10, 'Security in API design should never be overlooked.'),
    (4, 10, 'REST APIs have been my go-to for most of my projects.'),

    (4, 11, 'What the flip !? ');