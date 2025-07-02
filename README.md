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
