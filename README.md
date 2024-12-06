# To-Do List JSON API

This project is a simple **To-Do List JSON API** built using Laravel. It has been containerized with Docker for easy deployment and management.

## Features

- Manage to-do items using a JSON-based API.
- Pre-configured with Docker and Docker Compose for seamless setup.
- Integrated services:
  - **Mailpit** for local email testing.
  - **phpMyAdmin** and **Adminer** for database management.

## Prerequisites

Ensure the following tools are installed on your system:

- [Docker](https://docs.docker.com/engine/install/)
- [Docker Compose](https://docs.docker.com/compose/install/#install-compose)

## Deployment

### Initial Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/Thavarshan/gapstars-task.git
   cd gapstars-task
   ```
2. Build and start the containers:
   ```bash
   docker compose up -d --build
   ```
3. Fix permissions for necessary directories:
   ```bash
   docker compose exec phpmyadmin chmod 777 /sessions
   docker compose exec php bash
   chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
   chmod -R 775 /var/www/storage /var/www/bootstrap/cache
   ```
4. Install dependencies:
   ```bash
   composer setup
   ```

### Starting the App (Subsequent Runs)

To start the app after the initial setup:
```bash
docker compose up -d
```

## Accessing the Application

- **Laravel API**: [http://localhost](http://localhost)
- **Mailpit**: [http://localhost:8025](http://localhost:8025)
- **phpMyAdmin**: [http://localhost:8080](http://localhost:8080)
  - Server: `db`
  - Username: `tasks`
  - Password: `tasks`
  - Database: `tasks`
- **Adminer**: [http://localhost:9090](http://localhost:9090)
  - Server: `db`
  - Username: `tasks`
  - Password: `tasks`
  - Database: `tasks`

## Basic Docker Commands

- Build or rebuild services:
  ```bash
  docker compose build
  ```
- Create and start containers:
  ```bash
  docker compose up -d
  ```
- Stop and remove containers, networks:
  ```bash
  docker compose down
  ```
- Stop all services:
  ```bash
  docker compose stop
  ```
- Restart service containers:
  ```bash
  docker compose restart
  ```
- Run a command inside a container:
  ```bash
  docker compose exec [container] [command]
  ```

## API Usage

- The API endpoints can be accessed at [http://localhost](http://localhost).
- Refer to the `routes/api.php` file for available routes.

## License

This project is licensed under the [MIT License](LICENSE).
