CREATE DATABASE IF NOT EXISTS assignmentdb;

USE assignmentdb;

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` ENUM('user', 'admin') DEFAULT 'user',
  `profile_picture` varchar(255) DEFAULT 'default.png',
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

INSERT INTO users (username, password, email, role) VALUES
    ("admin", "$2y$12$majf1c5yGQjVzcqiaTwSH.rNUHDULi9DegudTKT53TeGQqWtfe/GG", "admin@example.com", "admin"); /* admin:admin */

INSERT INTO users (username, password, email) VALUES
    ("user", "$2y$12$ydpt94dLBPuTITkDU4eUTOpDLECJtH5iLdDM2kaVqIMZTvRv6dVbu", "user@example.com"), /* user:user */
    ("bart", "$2y$12$Fw/xNr5A.TyhECCTUbl.puS.vN6j20c7uHje2vWDK7A7/Xnih1hX6", ""), /* bart:BartDePinda17 */
    ("alice", "$2y$12$D2g7EzSkzFkDfnzPDBQ/mSCaDEbY.k.kGhDgVvfUMkOQlOn8W2iEq", "alice@example.com"), /* alice:Alice12345 */
    ("bob", "$2y$12$0p5VvYZcf6TA8wm6IG9EKeFgozm50c6KpmP59YqjNl6s.TjlYpAeW", "bob@example.com"), /* bob:Bob67890 */
    ("charlie", "$2y$12$7nmcEdglV0l5YXGHh4TtM2MUE4dx6BzjrcD2zsvijOpaTUVGzQ5hG", "charlie@example.com"), /* charlie:Charlie2023 */
    ("david", "$2y$12$VrDLRjTnHZ8S1Bb2sf02deSgbYy7z57tKNVX9n2GoMSeKJ2tdmgjS", "david@example.com"), /* david:David9876 */
    ("eve", "$2y$12$92e9nCUWNm.ay9s9u7a39Od6FgAOmKrFocOdpzfxfJl4zNj.Hgjs6", "eve@example.com"), /* eve:Eve2468 */
    ("frank", "$2y$12$y3zF1nHaHuaDYvHqZ6OFSePUmPOgPCmF3OrQjlxsoZtyIbbRWf.7O", "frank@example.com"), /* frank:Frank12345 */
    ("grace", "$2y$12$z9x9mjysUjUKhBeMjrLZBYwmex0pxbKdbtqgTjTw1qlqRU9wXQDLf", "grace@example.com"); /* grace:Grace789 */

INSERT INTO posts (title, content, author_id) VALUES
    ('How to Learn SQL', 'SQL is a fundamental skill for database management. Start by learning the basic commands like SELECT, INSERT, UPDATE, DELETE.', 1), -- admin
    ('My First Post on Technology', 'This post is about the impact of artificial intelligence in modern software development.', 2), -- user
    ('Web Development Tips', 'Web development can be fun and challenging. Here are some tips to make your journey smoother.', 3), -- bart
    ('The Future of AI', 'AI is changing the world in so many ways. From self-driving cars to machine learning, the possibilities are endless.', 4), -- alice
    ('Tech Innovations in 2025', 'In 2025, we expect to see significant improvements in AI and quantum computing.', 5); -- bob

-- Inserting comments for the first post
INSERT INTO comments (user_id, post_id, content) VALUES
    (2, 1, 'Great tips! I really need to improve my SQL skills.'), -- user commenting on post 1
    (3, 1, 'I found the SELECT command quite difficult at first, but practice makes it easier!'), -- bart commenting on post 1
    (4, 1, 'SQL is a must-learn for anyone working with databases!'); -- alice commenting on post 1

-- Inserting comments for the second post
INSERT INTO comments (user_id, post_id, content) VALUES
    (5, 2, 'AI is fascinating, but I think it will also bring challenges for job markets.'), -- bob commenting on post 2
    (6, 2, 'Yes, AI is amazing, but I believe it needs to be regulated for ethical reasons.'); -- charlie commenting on post 2

-- Inserting comments for the third post
INSERT INTO comments (user_id, post_id, content) VALUES
    (7, 3, 'Web development has indeed become more streamlined with modern tools like React and Vue.'), -- david commenting on post 3
    (8, 3, 'Totally agree! But I struggle with JavaScript sometimes.'); -- eve commenting on post 3

-- Inserting comments for the fourth post
INSERT INTO comments (user_id, post_id, content) VALUES
    (9, 4, 'AI is definitely the future, but we need to tread carefully with its applications.'), -- frank commenting on post 4
    (10, 4, 'Absolutely, AI could do wonders in healthcare and education!'); -- grace commenting on post 4

-- Inserting comments for the fifth post
INSERT INTO comments (user_id, post_id, content) VALUES
    (1, 5, 'I can’t wait for the advancements in quantum computing!'), -- admin commenting on post 5
    (2, 5, 'Quantum computing will completely transform data encryption!'); -- user commenting on post 5



-- AI::
-- Add more users
INSERT INTO users (username, password, email, role) VALUES
    ("john", "$2y$12$majf1c5yGQjVzcqiaTwSH.rNUHDULi9DegudTKT53TeGQqWtfe/GG", "john@example.com", "user"), /* john:john */
    ("jane", "$2y$12$ydpt94dLBPuTITkDU4eUTOpDLECJtH5iLdDM2kaVqIMZTvRv6dVbu", "jane@example.com", "user"), /* jane:jane */
    ("mike", "$2y$12$Fw/xNr5A.TyhECCTUbl.puS.vN6j20c7uHje2vWDK7A7/Xnih1hX6", "mike@example.com", "user"), /* mike:mike */
    ("sarah", "$2y$12$D2g7EzSkzFkDfnzPDBQ/mSCaDEbY.k.kGhDgVvfUMkOQlOn8W2iEq", "sarah@example.com", "user"), /* sarah:sarah */
    ("chris", "$2y$12$0p5VvYZcf6TA8wm6IG9EKeFgozm50c6KpmP59YqjNl6s.TjlYpAeW", "chris@example.com", "user"), /* chris:chris */
    ("lisa", "$2y$12$7nmcEdglV0l5YXGHh4TtM2MUE4dx6BzjrcD2zsvijOpaTUVGzQ5hG", "lisa@example.com", "user"), /* lisa:lisa */
    ("peter", "$2y$12$VrDLRjTnHZ8S1Bb2sf02deSgbYy7z57tKNVX9n2GoMSeKJ2tdmgjS", "peter@example.com", "user"), /* peter:peter */
    ("emily", "$2y$12$92e9nCUWNm.ay9s9u7a39Od6FgAOmKrFocOdpzfxfJl4zNj.Hgjs6", "emily@example.com", "user"), /* emily:emily */
    ("dave", "$2y$12$y3zF1nHaHuaDYvHqZ6OFSePUmPOgPCmF3OrQjlxsoZtyIbbRWf.7O", "dave@example.com", "user"), /* dave:dave */
    ("olivia", "$2y$12$z9x9mjysUjUKhBeMjrLZBYwmex0pxbKdbtqgTjTw1qlqRU9wXQDLf", "olivia@example.com", "user"); /* olivia:olivia */

-- Add more posts
INSERT INTO posts (title, content, author_id) VALUES
    ('The Importance of Version Control', 'Version control systems like Git are essential for managing code changes and collaborating with teams.', 6), -- lisa
    ('Getting Started with Docker', 'Docker simplifies application deployment by containerizing your apps. Here’s how to get started.', 7), -- peter
    ('Introduction to Machine Learning', 'Machine learning is a subset of AI that focuses on building systems that learn from data.', 8), -- emily
    ('The Rise of NoSQL Databases', 'NoSQL databases like MongoDB and Cassandra are gaining popularity for their flexibility and scalability.', 9), -- dave
    ('Best Practices for API Design', 'Designing APIs requires careful planning to ensure they are scalable, secure, and easy to use.', 10), -- olivia
    ('Understanding Blockchain Technology', 'Blockchain is a decentralized ledger technology that powers cryptocurrencies like Bitcoin.', 1), -- admin
    ('The Future of Cloud Computing', 'Cloud computing is transforming how businesses operate by providing scalable and cost-effective solutions.', 2), -- user
    ('Cybersecurity Best Practices', 'Protecting your systems from cyber threats is critical in today’s digital world.', 3), -- bart
    ('The Role of DevOps in Modern Development', 'DevOps bridges the gap between development and operations, enabling faster and more reliable software delivery.', 4), -- alice
    ('Exploring Quantum Computing', 'Quantum computing promises to revolutionize computing by solving problems that are currently intractable.', 5); -- bob

-- Add more comments
INSERT INTO comments (user_id, post_id, content) VALUES
    (1, 6, 'Version control is a lifesaver for team projects!'), -- admin commenting on post 6
    (2, 6, 'I use Git every day, and it’s amazing how much it simplifies collaboration.'), -- user commenting on post 6
    (3, 6, 'Git is a must-learn for any developer.'), -- bart commenting on post 6
    (4, 7, 'Docker has made my life so much easier when deploying apps.'), -- alice commenting on post 7
    (5, 7, 'I’m still learning Docker, but it’s definitely worth the effort.'), -- bob commenting on post 7
    (6, 7, 'Docker is a game-changer for DevOps.'), -- lisa commenting on post 7
    (7, 8, 'Machine learning is fascinating, but it requires a lot of data.'), -- peter commenting on post 8
    (8, 8, 'I’m excited to dive deeper into machine learning algorithms.'), -- emily commenting on post 8
    (9, 8, 'ML is the future of technology!'), -- dave commenting on post 8
    (10, 9, 'NoSQL databases are perfect for handling unstructured data.'), -- olivia commenting on post 9
    (1, 9, 'I’ve been using MongoDB, and it’s incredibly flexible.'), -- admin commenting on post 9
    (2, 9, 'NoSQL is great for scaling applications.'), -- user commenting on post 9
    (3, 10, 'API design is crucial for building scalable systems.'), -- bart commenting on post 10
    (4, 10, 'I always follow RESTful principles when designing APIs.'), -- alice commenting on post 10
    (5, 10, 'API security is just as important as functionality.'), -- bob commenting on post 10
    (6, 11, 'Blockchain is such an innovative technology!'), -- lisa commenting on post 11
    (7, 11, 'I’m curious about how blockchain can be applied outside of cryptocurrencies.'), -- peter commenting on post 11
    (8, 11, 'Blockchain has the potential to disrupt many industries.'), -- emily commenting on post 11
    (9, 12, 'Cloud computing is the backbone of modern applications.'), -- dave commenting on post 12
    (10, 12, 'I love how scalable cloud solutions are.'), -- olivia commenting on post 12
    (1, 12, 'Cloud security is a top priority for businesses.'), -- admin commenting on post 12
    (2, 13, 'Cybersecurity is more important than ever.'), -- user commenting on post 13
    (3, 13, 'I always use multi-factor authentication to secure my accounts.'), -- bart commenting on post 13
    (4, 13, 'Regular security audits are a must.'), -- alice commenting on post 13
    (5, 14, 'DevOps has completely transformed how we deliver software.'), -- bob commenting on post 14
    (6, 14, 'CI/CD pipelines are a game-changer.'), -- lisa commenting on post 14
    (7, 14, 'DevOps requires a cultural shift in organizations.'), -- peter commenting on post 14
    (8, 15, 'Quantum computing is still in its early stages, but the potential is huge.'), -- emily commenting on post 15
    (9, 15, 'I can’t wait to see what breakthroughs quantum computing will bring.'), -- dave commenting on post 15
    (10, 15, 'Quantum computing will revolutionize cryptography.'); -- olivia commenting on post 15