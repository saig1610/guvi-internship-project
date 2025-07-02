# 💻 GUVI Internship Project – Full Stack Web Application

This project was developed as part of the **GUVI Web Developer Internship** task. It demonstrates a fully functional user system with:

- ✅ Signup with real-time form validation  
- ✅ Login system with authentication  
- ✅ Profile page with user details and edit functionality  
- ✅ Backend using **PHP + MySQL + MongoDB**  
- ✅ Frontend with **HTML, CSS, Bootstrap, jQuery**  
- ✅ AJAX used for all data communication (no form reloads)  
- ✅ LocalStorage used to handle user sessions (No PHP sessions)

---

## 🚀 Features

| Feature                | Technology Used       | Description                                             |
|------------------------|------------------------|---------------------------------------------------------|
| **Signup**            | HTML, JS, PHP, MySQL   | Registers user after validating all inputs             |
| **Login**             | PHP, MySQL             | Verifies user credentials and redirects to profile     |
| **Profile View/Edit** | MongoDB, AJAX, JS      | Displays and updates user profile via AJAX             |
| **UI Design**         | Bootstrap 5, CSS       | Responsive and clean layout across all screens         |
| **Session Handling**  | JavaScript (localStorage) | Email is stored locally to manage session             |

---

📁 Folder Structure
guvi-clean/
├── 📁 assets/                  # Images and background media
│   ├── bg-video.mp4
│   ├── bg.jpg
│   ├── login.jpg
│   ├── placeholder.avif
│   └── profile.jpg
│
├── 📁 js/                      # Frontend JS files
│   ├── signup.js              # Handles signup validation + AJAX
│   ├── login.js               # Login + localStorage session
│   └── profile.js             # Profile fetch & update via AJAX
│
├── 📁 php/                     # Backend PHP scripts
│   ├── config.php             # MySQL + MongoDB DB connection
│   ├── signup.php             # Inserts user into MySQL + MongoDB
│   ├── login.php              # Authenticates via MySQL
│   ├── fetch_profile.php      # Fetches profile from MongoDB
│   ├── update_profile.php     # Updates MongoDB profile
│   └── sync_user_to_mongo.php # Helper to sync MySQL user to MongoDB
│
├── 📁 vendor/                  # Composer-generated MongoDB library
│   └── ...                    # MongoDB PHP dependencies
│
├── signup.html                # User registration page
├── login.html                 # Login page
├── profile.html               # User profile view & edit
├── composer.json              # Composer dependencies
└── composer.lock              # Composer lock file

---

## 🛠️ Technologies Used

- **Frontend**: HTML5, CSS3, Bootstrap, JavaScript, jQuery  
- **Backend**: PHP (PDO for DB operations)  
- **Databases**:
  - 🟢 MySQL (for user authentication)
  - 🟣 MongoDB (for profile data)
- **Others**: AJAX (jQuery), LocalStorage (instead of sessions)

---

## 🧪 How to Run the Project

> 💡 Make sure **XAMPP and MongoDB** are installed.

### 1. Setup

1. Extract `guvi-clean/` to:

2. Start:
- ✅ Apache (XAMPP)
- ✅ MySQL (XAMPP)
- ✅ MongoDB:
  ```bash
  mongod
  ```

3. Open browser and visit:
http://localhost/guvi-clean/signup.html
---

## 📌 Flow Diagram

[Signup] → [MySQL + MongoDB insert]
↓
[Login] → [Validate via MySQL]
↓
[Profile Page]
↓ ↘
[Fetch via MongoDB] [Edit + Save Profile via AJAX → MongoDB]

## 👨‍💻 Developer Info

**Sai Ganesh K**

- 💼 GitHub: [@saig1610](https://github.com/saig1610)  
- 📧 Email: ksaiganesh1610@gmail.com  
