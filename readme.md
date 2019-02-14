##### Laravel Version: 5.7.19

# What is this?

This is a very small kick start project to work with laravel passport.
Download it, follow the install instructions and you are ready to register, login, logout and return the logged in user data.

Swagger is already installed. As of the moment I made this project the package I used to generate
swagger didn't support YAML only annotations -- yeah that sucks --.

If you know how to setup YAML with this package or know any other that accepts it a PR will be welcome.

# Install Instructions
To be able to run the project in the local environment please follow these steps:

1. Clone the repository.
1. Set up your .env file
1. Run `composer install`
1. Run `php artisan key:generate`
1. Run `php artisan migrate`
1. Run `php artisan db:seed`
1. Run `php artisan passport:install`
1. Use _postman_ or any other _ADE_ of your choice

# Auth Endpoints

Here are some **example** instructions as to register and login users on the api

- **<your-localhost-name>/api/v1/auth/register**: 

    This endpoint requires two http **HEADERS** and a **BODY**.

    **HEADERS:**

    | KEY | VALUE |
    |-----|-------|
    |Content-Type| application/json|
    |X-Requested-With| XMLHttpRequest|

    **BODY:**
    
        {
            "name":"User Full Name",
            "email":"user@email.com",
            "role_id":2,
            "password":"secret",
            "password_confirmation":"secret"
        }
    
    **RESPONSE:**
    
        {
            "name": "User Full Name",
            "email": "user@email.com",
            "role_id":2,
            "updated_at": "2019-01-17 13:23:27",
            "created_at": "2019-01-17 13:23:27",
            "id": 2
        }
    
    `    HTTP STATUS CODE: 201
    `

- **<your-localhost-name>/api/v1/auth/login**: 

    This endpoint requires two http **HEADERS** and a **BODY**.

    **HEADERS:**

    | KEY | VALUE |
    |-----|-------|
    |Content-Type| application/json|
    |X-Requested-With| XMLHttpRequest|

     **BODY:**
    
         {
          "email":"user@email.com",
          "password":"user-password",
         }
     
     **RESPONSE:**
     
         {
             "accessToken": "some very long random token"
             "token_type": "Bearer",
             "expires_at": "2020-01-17",
             "scopes": [
                 "self"
             ]
         }
     
     `HTTP STATUS CODE: 200`

- **<your-localhost-name>/api/v1/self/me**: 

    This endpoint    requires two **HEADERS**.
    
     **HEADERS:**
    
     | KEY | VALUE |
     |-----|-------|
     |Authorization| Bearer tokenvalue|
     |X-Requested-With| XMLHttpRequest|
    
    **RESPONSE:**
     
          {
           "id": 1,
           "name": "User Full Name",
           "email": "user@email.com",
           "email_verified_at": null,
           "role_id":2,
           "created_at": "2019-01-17 12:49:53",
           "updated_at": "2019-01-17 12:49:53"
          }
     

# Swagger

Swagger is installed in this application to provide auto generated documentation page.

[Downloaded from Github](https://github.com/DarkaOnLine/L5-Swagger)

In order to see the auto generated documentation page you must go to /config/l5-swagger.php
and find `routes.middleware.api` and comment out the `"auth"` middleware.

After that you can access the swagger page through: **<your-locahost-name>/api/documentation**

**ATTENTION: YOU MUST UNCOMMENT THE `"AUTH"` MIDDLEWARE BEFORE PUSHING TO BITBUCKET**

[Helpful Swagger Open Api Annotation Samples](https://github.com/zircote/swagger-php/tree/master/Examples)
