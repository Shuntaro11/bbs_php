CREATE TABLE pre_users (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  uniquid VARCHAR(255) NOT NULL,
  urltoken VARCHAR(128) NOT NULL,
  user_name VARCHAR(20) NOT NULL,
  email VARCHAR(255) NOT NULL ,
  password VARCHAR(255) NOT NULL,
  date DATETIME NOT NULL,
  flag TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE users (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  uniquid VARCHAR(255) NOT NULL,
  user_name VARCHAR(20) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(50) NOT NULL,
  content TEXT NOT NULL,
  uniquid VARCHAR(255) NOT NULL,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime DEFAULT CURRENT_TIMESTAMP,
  user_id INT NOT NULL
);

ALTER TABLE posts ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE RESTRICT;