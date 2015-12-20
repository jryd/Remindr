## Remindr

Remindr is a simple web application built in Laravel 5.1.

It supports registration, email verification, forgotten password, as well as the the setting, viewing, editing and deletion of remindrs.

You simply register and you're good to go in less than a minute.

When a user logs in, it will check their location using geolocation - if none can be found, or the value stored in the database is empty or null, then it will simply use UTC. This means that when the user goes to create a remindr, it is already set to their current date and set using the current time (although this could be changed).

## Getting Started

1) Clone to your PC or server <br />
2) Run install command once you're in the root directory for Remindr; `composer install` <br />
3) Set up your `.env` file with the information to access your database (I used MySQL) <br />
4) Migrate and seed database tables that come with install; `php artisan migrate --seed` <br />
5) Now simply browse to the directory it is hosted in via your browser and voila <br />

To log in using the seeded account, use admin@admin.com and the password admin.
