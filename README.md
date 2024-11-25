# Web Development 1 End Assignment
This project contains the setup for a web application using the following technologies:

* NGINX Web Server
* PHP with FastCGI Process Manager (PDO MySQL support)
* MariaDB (MySQL fork)
* PHPMyAdmin

## Installation
1. Install Docker.
1. Clone repository.

## Usage
1. In a terminal, from the project folder, run:
```bash
docker compose up
```
This will start the application and NGINX will serve files from the `app/public` directory. Visit `localhost` in your browser to view the application.
1. PHPMyAdmin is accessible on port `8080` at `localhost:8080`.
1. To stop the container, press `Ctrl+C` or run:
```bash
docker compose down
```