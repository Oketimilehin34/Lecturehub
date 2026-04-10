# LectureHub 🎓

LectureHub is a web-based platform designed for students and lecturers to manage and access academic materials efficiently. Built with PHP and MySQL, it features a secure authentication system and an organized dashboard for lecture notes.

## 🚀 Features
- **Student Authentication:** Secure registration and login system with a "Show Password" toggle.
- **Lecturer Portal:** Dedicated access for lecturers to manage academic content.
- **Material Management:** A searchable interface for course materials, organized by course code and topic.
- **Secure File Access:** Integrated download system for lecture notes (PDFs, Docs, Images).
- **Responsive Design:** Built with Bootstrap 5 for a seamless experience across mobile and desktop.

## 🛠️ Tech Stack
- **Backend:** PHP 8.x
- **Database:** MySQL
- **Frontend:** HTML5, CSS3 (Bootstrap 5), JavaScript
- **Icons:** Bootstrap Icons

## 📋 Database Setup
To get the database running locally:
1. Open phpMyAdmin and create a database named `lecturehub`.
2. Run the following SQL to create the necessary tables:
   ```sql
   CREATE TABLE students (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE lecturers (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE lecture_materials (
       id INT AUTO_INCREMENT PRIMARY KEY,
       course_code VARCHAR(20),
       course_title VARCHAR(255),
       lecture_no INT,
       topics VARCHAR(255),
       file_name VARCHAR(255),
       created_at VARCHAR(50),
       updated_at VARCHAR(50)
   );