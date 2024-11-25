# Web Development 1 End Assignment - Daan Tas
This repository contains the web development 1 end assignment.

It contains:
* NGINX webserver
* PHP FastCGI Process Manager with PDO MySQL support
* MariaDB (GPL MySQL fork)
* PHPMyAdmin

## Installation

1. Install Docker Desktop on Windows or Mac, or Docker Engine on Linux.
1. Clone the project

## Usage

In a terminal, from the cloned project folder, run:
```bash
docker compose up
```

NGINX will now serve files in the app/public folder. Visit localhost in your browser to check.
PHPMyAdmin is accessible on localhost:8080

If you want to stop the containers, press Ctrl+C. 

Or run:
```bash
docker compose down
```

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