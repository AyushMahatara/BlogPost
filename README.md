## About Blog Post 

Blog Post is made using Laravel framework 12. Project Specification:

- [Admin Panel](https://filamentphp.com/docs).
- [Roles and Permission](https://filamentphp.com/plugins/bezhansalleh-shield).
- SoftDeletes for the Post.
- MarkdownEditor for the Post content.
- Blog post created by any user should be approved by Super Admin.
- Mail is sent to user if the Post is Approved.

This is a simple blog application with minimum requirements.

## Installation Steps

Follow this instructions to install the project on your machine:

1. Clone this repo. ```bash
     git clone https://github.com/AyushMahatara/BlogPost.git
    ```
2. `cd BlogPost`
3. `composer install`
4. `copy and paste .env.example`
5. `rename the copied file '.env copy.example' to '.env'`
6. `php artisan key:generate`
7. Set **database config** on `.env` file `optional`
8. `php artisan migrate --seed`
9. `php artisan serve`
10. Click on the link to open the `Application` 
#### Note: While running migration it asks for db to create as we are using sqlite just type 'yes'. There is only one Seeder file as this is a small project.

11. `php artisan shiled:generate --all`
12. `php artisan shield:super-admin`
13. Choose which email would like to make admin 
#### Note: Use ID example for `admin@example.com` type 1.

14. Access the Dashboard by typing `/admin` in the url example `http://127.0.0.1:8000/admin`

## Credential 

- Email: `admin@example.com` Password: `password123`
- Email: `user@example.com` Password: `password123`
- Email: `guest@example.com` Password: `password123`

#### Note: After logging in with Super Admin email, don't forget to give Permission to the Roles.
