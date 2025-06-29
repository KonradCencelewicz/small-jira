# 🛠 Task Manager - Symfony Project

Task Manager is a web application built with Symfony that allows users to create and manage tasks and subtasks. The project uses Docker for easy environment setup and isolation.

---

## 🗖 Requirements

- [Docker](https://www.docker.com/) with Docker Compose

---

## 🚀 How to Run the Project

1. **Clone the repository:**

   ```bash
   git clone https://github.com/KonradCencelewicz/small-jira.git
   cd small-jira
   ```

2. **Start Docker containers:**

   ```bash
   docker-compose up --build
   ```

3. **(Optional) Load migrations and test data:**

   Run manually inside the container:

   ```bash
   docker exec -it app php bin/console doctrine:migrations:migrate
   docker exec -it app php bin/console doctrine:fixtures:load
   ```

4. **Open the application in your browser:**

   ```
   http://localhost:8000
   ```

5. **Available user for tests:**

   ```
   login: admin@example.com password: qwerty123
   login: user@example.com password: qwerty123
   ```
---

## 🧪 Features

- Task and subtask creation
- Status system with dynamic labels
- Easy change status option (drag&drop)

---

## 👨‍💻 Technologies

- Symfony 6.x
- Doctrine ORM
- Twig
- Docker + Docker Compose
- Bootstrap 5

---

## 📝 License

This project was created for educational purposes. You are free to use and modify it according to your needs.
