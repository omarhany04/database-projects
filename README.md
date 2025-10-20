# 🗄️ Database Projects

This repository contains various database-driven web applications I have built for learning and practice purposes.  
Each project demonstrates database design, SQL queries, and integration with web technologies like **PHP**, **JavaScript**, **HTML**, and **CSS**, using **MySQL** as the database engine.

---

## 📂 Projects Overview

### 1. Registration App
- A user registration and login system using **PHP** and **MySQL**.  
- Features client-side validation using **JavaScript**.  
- Passwords can be encrypted (MD5).  
- Styled forms with **CSS**.  
- Includes `registration.sql` to create the database and tables.

**Folder:** `Registration App/`

---

### 2. Library App
- A basic **Library Management System**.  
- Database schema includes:  
  - `BOOK`, `CATEGORY`, `PUBLISHER`, `MEMBER`, `BORROWING_BOOK`  
- Demonstrates SQL queries for retrieving, filtering, and managing data.  
- Fully functional PHP web pages for CRUD operations.  
- Includes `library_db.sql` to create the database and tables.

**Folder:** `Library App/`

---

## ⚙️ Technologies Used
- **PHP**  
- **MySQL**  
- **HTML / CSS / JavaScript**  
- **XAMPP** (local server environment)  
- **phpMyAdmin** for database management

---

## 🚀 How to Run a Project
1. Download and install [XAMPP](https://www.apachefriends.org/download.html).  
2. Copy the project folder you want to run into your `htdocs` directory.
3. Start **Apache** and **MySQL** in XAMPP Control Panel.  
4. Open **phpMyAdmin** in your browser to create the database:  http://localhost/phpmyadmin/
5. Import the corresponding SQL file to create the database and tables:  
- `registration.sql` → Registration App  
- `library_db.sql` → Library App  
6. Open your browser and go to the project URL: http://localhost/project-folder/
- Replace `project-folder` with the folder name (`Registration App` or `Library App`).
---

## 📌 Notes
- Keep `config.php` updated with your own database credentials.
- Make sure that any **sensitive information** is not included in files that could be shared publicly.
- Each project is independent and can be run separately.

---
