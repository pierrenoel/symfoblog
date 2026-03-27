# Symfoblog 🚀

A blog project built with **Symfony** for learning and practice.  
Currently **under development**, perfect for testing Symfony features and learning web development.

---

## 🛠️ Features

- Create, edit, and delete posts
- User management (registration / login)
- Public display of posts
- Comment system for posts
- Categorization of posts
- Simple and intuitive navigation
- Responsive design for desktop and mobile (not yet)
- Admin interface for managing posts, users, and comments

> ⚠️ Some features are still under development and may not be fully functional yet.

---

## ⚡ Quick Installation

### Clone the repository

```bash
git clone https://github.com/<your-username>/symfoblog.git
cd symfoblog

```

### Install dependencies

```bash
composer install
```

### Configure the database

In the .env file:

```bash
DATABASE_URL="mysql://user:password@127.0.0.1:3306/symfoblog"
```

### Create the database

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### Start the server

```bash
symfony server:start
```

Then open http://localhost:8000
in your browser.

### 👩‍💻 Contributing

Contributions are welcome!
Please create separate branches for your features and submit pull requests.
