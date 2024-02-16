# Microservices Application with Docker

This project consists of two microservices, "users" and "notifications", communicating via a message bus. The services are orchestrated using Docker Compose.

## Overview

The microservices architecture allows for scalable, decoupled, and independently deployable components, enabling efficient development and maintenance of complex systems. In this setup, the "users" service handles user data submission, while the "notifications" service processes and logs the received data.

## Laravel

Laravel is a PHP web application framework used for building the microservices in this project. It provides a robust set of tools and features for developing scalable and maintainable applications.

## Docker Compose Configuration

The `docker-compose.yml` file defines the services and their configurations:

### Services

- **Redis**: Acts as the message broker for communication between microservices.
- **Users Service**: Handles user data submission via POST requests and dispatches events to the message broker.
- **Notifications Service**: Consumes events from the message broker and logs the received data.

### Ports

- **Users Service**: Exposed on port 8000.
- **Notifications Service**: Exposed on port 8001.

### Volumes

- Both services mount volumes for log storage to persist logs outside the containers.

## Task Description

The microservices application follows these requirements:

1. **User Service**:
    - Exposes an endpoint `POST /users` to receive user data (`{"email","firstName","lastName"}`) and stores it.
    - Upon data submission, generates an event and sends it through the message broker to the "notifications" service.

2. **Notifications Service**:
    - Consumes events from the message broker.
    - Logs the received data in a log file.

3. **Test Coverage**:
    - The codebase is covered with unit, integration, and functional tests to ensure reliability and correctness.

## Instructions

### Setup and Testing

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/chimake/microservices_project.git

2. **Navigate to the Project Directory**:
   ```bash
   cd microservices_project

docker-compose build
docker-compose up -d

# For Users Service
docker-compose exec users php artisan test

# For Notifications Service
docker-compose exec notifications php artisan test

# For Users Service
docker-compose exec users cat /var/log/users.log

# For Notifications Service
docker-compose exec notifications cat /var/log/notifications.log

docker-compose down

### API Endpoints
/users
```

