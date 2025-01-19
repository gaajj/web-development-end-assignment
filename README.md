# TechBlog
I deviated a bit from my initial use case because I ran out of time.

## Usage
To start the application, use:
```bash
docker compose up -d
```

To stop, use:
```bash
docker compose down
```

To reset the database, use:
```bash
docker compose down --volumes
```

## Example Users
All dummy users have the same password as username, here are some examples:
```
username: admin
password: admin
```
```
username: user
password: user
```
