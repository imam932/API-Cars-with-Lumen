# API Cars with Lumen

# Documentation
## Setup
1. Clone project
```
git clone https://github.com/imam932/API-Cars-with-Lumen.git

cd API-Cars-with-Lumen
```
2. Create a copy of your .env file
```
cp .env.example .env
```
3. Install Dependencies
```
composer install
```
4. Create an empty database and set in .env file
Example
```
DB_DATABASE=db_cars
DB_USERNAME=root
DB_PASSWORD=
```
5. Migrate Database
```
php artisan migrate
```
6. Seed database
```
php artisan db:seed
```
7. Run service
```
php -S localhost:8000 -t public
```

## Postman Collection
[Link postman](https://github.com/imam932/API-Cars-with-Lumen/blob/master/Cars%20API.postman_collection.json)

## API Test with Postman
set environtment url `{{base_url}}` with value `http://localhost:8000/api/`
1. Auth
    * Login
    ```
    POST {{base_url}}auth/login
    ```
    with body
    ```json
    {
        "email": "owner@gmail.com",
        "password": "test12345"
    }
    ```

    Response
    ```json
    {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9jYXJzLnRlc3Q6ODA4MFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY4ODE3Njk3OSwiZXhwIjoxNjg4MTgwNTc5LCJuYmYiOjE2ODgxNzY5NzksImp0aSI6IlZhcjd4WkJka1oydng2d1UiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.JhGHMKDrkw4-cXZ328Y5ECF1V-RRVxvQcyB2uft4TC8",
        "token_type": "bearer",
        "user": {
            "id": 1,
            "name": "Owner Imam",
            "email": "owner@gmail.com",
            "email_verified_at": null,
            "is_owner": 1,
            "remember_token": null,
            "created_at": null,
            "updated_at": null
        },
        "expires_in": 86400
    }
    ```

    * Refresh Token
    ```
    POST {{base_url}}auth/refresh/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9jYXJzLnRlc3Q6ODA4MFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY4ODA0MzQ1MywiZXhwIjoxNjg4MDQ3MDUzLCJuYmYiOjE2ODgwNDM0NTMsImp0aSI6IlhKZFh6cUoycWpvbkE0WWgiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.C4aPBKuufA8_prji_o-il1QKcB4SCaimYbYTTVnuNF0
    ```

    Response
    ```json
    {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9jYXJzLnRlc3Q6ODA4MFwvYXBpXC9hdXRoXC9yZWZyZXNoXC9leUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpJVXpJMU5pSjkuZXlKcGMzTWlPaUpvZEhSd09sd3ZYQzlqWVhKekxuUmxjM1E2T0RBNE1Gd3ZZWEJwWEM5aGRYUm9YQzlzYjJkcGJpSXNJbWxoZENJNk1UWTRPREl3TURFNE9Td2laWGh3SWpveE5qZzRNakF6TnpnNUxDSnVZbVlpT2pFMk9EZ3lNREF4T0Rrc0ltcDBhU0k2SW5KeFlYQnZibWMxZFRCVlJqRktSRzhpTENKemRXSWlPakVzSW5CeWRpSTZJakl6WW1RMVl6ZzVORGxtTmpBd1lXUmlNemxsTnpBeFl6UXdNRGczTW1SaU4yRTFPVGMyWmpjaWZRLjNoRkJDRWI4NElwTk5QV2RvNE5sV0N1TkNISXBobkthOGkxcXRSVFVMbFUiLCJpYXQiOjE2ODgyMDAxODksImV4cCI6MTY4ODIwMzgwMCwibmJmIjoxNjg4MjAwMjAwLCJqdGkiOiJWemZQR3FhYmtsSUZHWTdUIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.7Jjo0DkzJYZTaV9D-BvvmD2DEYJ4olFqJb7V6YO-6Lk",
        "token_type": "bearer",
        "user": null,
        "expires_in": 86400
    }
    ```

    * Logout
    ```
    POST {{base_url}}auth/logout
    ```
    Authorize
    ```
    Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9jYXJzLnRlc3Q6ODA4MFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY4ODIwMDE4OSwiZXhwIjoxNjg4MjAzNzg5LCJuYmYiOjE2ODgyMDAxODksImp0aSI6InJxYXBvbmc1dTBVRjFKRG8iLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.3hFBCEb84IpNNPWdo4NlWCuNCHIphnKa8i1qtRTULlU
    ```
    Response
    ```json
    {
        "message": "Successfully logged out"
    }
    ```

2. User
    * Register
    ```
    POST {{base_url}}users/register
    ```
    with body
    ```json
    {
        "name": "Egi Coco",
        "email": "egi@ymail.com",
        "password": "test12345",
        "is_owner": "0"
    }
    ```
    Authorize
    ```
    Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9jYXJzLnRlc3Q6ODA4MFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY4ODIwMDE4OSwiZXhwIjoxNjg4MjAzNzg5LCJuYmYiOjE2ODgyMDAxODksImp0aSI6InJxYXBvbmc1dTBVRjFKRG8iLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.3hFBCEb84IpNNPWdo4NlWCuNCHIphnKa8i1qtRTULlU
    ```
    Response
    ```json
    {
        "message": "Data added successfully"
    }
    ```

    * Profile User
    ```
    GET {{base_url}}users/profile
    ```
    Authorize
    ```
    Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9jYXJzLnRlc3Q6ODA4MFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY4ODIwMDE4OSwiZXhwIjoxNjg4MjAzNzg5LCJuYmYiOjE2ODgyMDAxODksImp0aSI6InJxYXBvbmc1dTBVRjFKRG8iLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.3hFBCEb84IpNNPWdo4NlWCuNCHIphnKa8i1qtRTULlU
    ```
    Response
    ```json
    {
        "id": 1,
        "name": "Owner Imam",
        "email": "owner@gmail.com",
        "email_verified_at": null,
        "is_owner": 1,
        "remember_token": null,
        "created_at": null,
        "updated_at": null
    }
    ```
    
3. Car


## Package

1. lumen framework
2. jwt auth
3. redis
