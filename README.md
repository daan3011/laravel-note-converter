
<div align="center">
  <img style="width:500px" src="https://i.imgur.com/ZUBfwUP.png" alt="PHP Google Vision" />

<hr/>



</div>

**Requires PHP 8.0+**

Thanks to [@ahmadmayahi](https://github.com/ahmadmayahi) for building this fun to work with wrapper for the Google Vision Api  
Check out his project here: [php-google-vision](https://github.com/ahmadmayahi/php-google-vision)



Laravel note converter is my first Laravel project.  
I got the idea after one of my sisters complained she had to type over al her handwritten notes into the computer.
Laravel note converter utilizes the OCR (Optical Character Recognition) capabilities of the Google Vision Api to recognize text in images and convert this text to
text that can be copy pasted into any document.

# Contents

- [Functionalities](#functionalities)
- [Installation](#installation)
- [Creating Google Service Account](#creating-google-service-account)
- [Configuration](#configuration)
- [Change api quota](#change-api-quota)
- [Admin dashboard](#admin-dashboard)
- [Generate test data](#generate-test-data)


## Functionalities

Unregistered users
- Convert images to text

<br>

Registered users
- Convert images to text
- Save converted notes
- Edit converted notes
- Share converted notes

<br>

Admin dashboard
- Check api quota
- Change user role to admin
- Change admin role to user
- Search user(s)
- Delete user(s)
- View users note(s)
- Delete users note(s)


## Installation

#### Install necessary composer dependencies

```bash
composer install
```

```bash
composer update
```

#### Install necessary NPM dependencies

```bash
npm install
```

#### Rename .env.example

Rename the file .env.example (found in root) to .env and set database info
```php
DB_CONNECTION=mysql
DB_HOST=HOST
DB_PORT=PORT
DB_DATABASE=DB_NAME
DB_USERNAME=DB_USERNAME
DB_PASSWORD=DB_PASSWORD
```

#### Run database migrations

After the database credentials are set in the .env file run the database migrations with
```php
php artisan migrate
```

## Creating Google Service Account

First, you must [create a Google service account](https://cloud.google.com/iam/docs/creating-managing-service-accounts) and download your JSON key.

## Configuration

Open app\Providers\AppServiceProvider.php and set the path to your Google Vision API JSON key

```php
public function register()
{
    $this->app->singleton(Vision::class, function ($app) {
        $config = (new Config())
            ->setCredentials(config('PATH_TO_JSON_KEY'));

        return Vision::init($config);
    });
}to `sys_get_temp_dir()`
    ->setTempDirPath();
```
PATH_TO_JSON_KEY = Path to the file containing your JSON key

## Change api quota
By default Laravel note converter uses the free tier of the Google Vision api, this allows for 1000 request montly. to change the default ammount of api requestst that can be made open App\Http\Controllers\ConvertController.php and locate the lines
```php
        if ($quota->quota < MAX_API_QUOTA) { // Default 1000
            $vision = app(Vision::class);
            $result = $vision
                ->file($request->noteImg)
                ->imageTextDetection()
                ->getDocument();
```
Change MAX_API_QUOTA to the maximum ammount of requests your tier allows

## Admin dashboard

To access the admin dashboard create a user account and in the database set your role in the users table to admin (user by default) after changing your role you should be automatically redirected to the admin dashboard on login. The admin dashboard is also accesible via the /admin uri (only when role is set to amdmin)

## Generate test data

To generate test data use the provided factories<br>
<br>
Run
```php
php artisan tinker
```
To create notes with associated users run
```php
Note::factory()->count(AMMOUNT_OF_USERS)->create();
```
To create several notes associated with the same user run
```php
Note::factory()->count(AMMOUNT_OF_NOTES)->create(['user_id' => USER_ID]);
```

