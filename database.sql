CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('student','admin') DEFAULT 'student'
);

CREATE TABLE exams (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  exam_date DATE,
  fee DECIMAL(10,2)
);

CREATE TABLE registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  exam_id INT,
  payment_status ENUM('pending','paid') DEFAULT 'pending',
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (exam_id) REFERENCES exams(id)
);

-- Sample Data
INSERT INTO users (name, email, password, role) 
VALUES ('Test Student', 'student@test.com', '12345', 'student');

INSERT INTO exams (title, exam_date, fee) 
VALUES ('Math Exam', '2025-09-15', 500.00);
