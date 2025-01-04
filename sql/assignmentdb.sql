CREATE DATABASE IF NOT EXISTS assignmentdb;

USE assignmentdb;

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` ENUM('user', 'admin') DEFAULT 'user',
  `profile_picture` varchar(255) DEFAULT 'upload/default.png',
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
    `created-at` timestamp DEFAULT current_timestamp(),
    `is_deleted` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES users(`id`),
    FOREIGN KEY (`post_id`) REFERENCES posts(`id`)
);

INSERT INTO users (username, password, email) VALUES
    ("admin", "$2y$12$majf1c5yGQjVzcqiaTwSH.rNUHDULi9DegudTKT53TeGQqWtfe/GG", "admin@example.com"), /* admin:admin */
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