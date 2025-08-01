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

1. Clone this repo. 
    ```bash
     git clone https://github.com/AyushMahatara/BlogPost.git
    ```
3. `cd BlogPost`
4. `composer install`
5. `copy and paste .env.example`
6. `rename the copied file '.env copy.example' to '.env'`
7. `php artisan key:generate`
8. Set **database config** on `.env` file `optional`
9. `php artisan migrate --seed`
10. `php artisan serve`
11. Click on the link to open the `Application` 
#### Note: While running migration it asks for db to create as we are using sqlite just type 'yes'. There is only one Seeder file as this is a small project.

1.  `php artisan shiled:generate --all`
2.  `php artisan shield:super-admin`
3.  Choose which email would like to make Super Admin 
#### Note: Use ID example for `admin@example.com` type 1.

1.  Access the Dashboard by typing `/admin` in the url example `http://127.0.0.1:8000/admin`

## Credential 

- Email: `admin@example.com` Password: `password123`
- Email: `user@example.com` Password: `password123`
- Email: `guest@example.com` Password: `password123`

#### Note: After logging in with Super Admin email, don't forget to give Permission to the Roles. For Email please edit .env file as needed.
