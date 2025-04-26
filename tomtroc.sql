-- Table users
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       email VARCHAR(100) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL,
                       avatar_url VARCHAR(255) NULL,
                       bio TEXT NULL,
                       created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table books
CREATE TABLE books (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       ownerId INT NOT NULL,
                       title VARCHAR(255) NOT NULL,
                       author VARCHAR(255) NOT NULL,
                       imageUrl VARCHAR(255) NULL,
                       description TEXT NULL,
                       status ENUM('Available','Unavailable') NOT NULL DEFAULT 'Available',
                       created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                       FOREIGN KEY (ownerId) REFERENCES users(id) ON DELETE CASCADE
);

-- Table conversations
CREATE TABLE conversations (
                               id INT AUTO_INCREMENT PRIMARY KEY,
                               user1Id INT NOT NULL,
                               user2Id INT NOT NULL,
                               startDate DATETIME DEFAULT CURRENT_TIMESTAMP,
                               FOREIGN KEY (user1Id) REFERENCES users(id) ON DELETE CASCADE,
                               FOREIGN KEY (user2Id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table messages
CREATE TABLE messages (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          conversationId INT NOT NULL,
                          senderId INT NOT NULL,
                          recipientId INT NOT NULL,
                          content TEXT NOT NULL,
                          timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
                          isRead TINYINT(1) NOT NULL DEFAULT 0,
                          FOREIGN KEY (conversationId) REFERENCES conversations(id) ON DELETE CASCADE,
                          FOREIGN KEY (senderId)       REFERENCES users(id)         ON DELETE CASCADE,
                          FOREIGN KEY (recipientId)    REFERENCES users(id)         ON DELETE CASCADE
);
