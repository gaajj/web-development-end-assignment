CREATE DATABASE IF NOT EXISTS assignmentdb;

USE assignmentdb;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role VARCHAR(10) DEFAULT 'user',
    profile_picture VARCHAR(255) DEFAULT 'upload/default.png'
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