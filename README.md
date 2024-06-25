<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Feed Copy CLI Tool

## Overview

This project provides a command-line tool for copying specific entries from a production database to a development database, ensuring that only the necessary data is copied. This is particularly useful for investigating bugs that only occur with production data without having to copy the entire production database.

## Features

- Copy a specific feed entry and its associated data.
- Option to copy only certain source entries (e.g., Instagram or TikTok).
- Option to include a specific number of posts associated with the feed.
- Unit tests to ensure the functionality of the CLI tool.

## Requirements

- PHP 8.2 or higher
- Laravel 11 or higher
- Composer

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/amiralikh/copy-command-tool.git
    cd copy-command-tool
    ```

2. **Install dependencies:**

    ```sh
    composer install
    ```

3. **Set up environment:**

   Copy the `.env.example` to `.env` and update the database configurations.

    ```sh
    cp .env.example .env
    ```

4. **Run migrations:**

    ```sh
    php artisan migrate
    ```

5. **Run tests to ensure everything is set up correctly:**

    ```sh
    php artisan test
    ```

## Usage

The command-line tool provides several options for copying data:

- Copy a feed with ID 123:

    ```sh
    php artisan copy:feed 123
    ```

- Copy a feed with ID 123 and its Instagram source:

    ```sh
    php artisan copy:feed 123 --only=instagram
    ```

- Copy a feed with ID 123, its Instagram source, and 5 associated posts:

    ```sh
    php artisan copy:feed 123 --only=instagram --include-posts=5
    ```

### Command Options

- `--only`: Specifies which source to copy (`instagram` or `tiktok`).
- `--include-posts`: Specifies the number of posts to copy.

## Testing

The project includes comprehensive unit tests to ensure the functionality of the CLI tool. The tests cover various scenarios, including:

- Copying a feed without any sources or posts.
- Copying a feed with Instagram or TikTok sources.
- Copying a feed with a specified number of posts.
- Handling non-existent feed IDs.

Run the tests using Pest:

```sh
php artisan test
```

### Example Tests

The test suite includes the following scenarios:

- copies a feed without any sources or posts
- copies feed with instagram source only
- copies feed with tiktok source only
- copies feed with posts only
- copies feed with instagram source and specified number of posts
- copies feed with tiktok source and specified number of posts
- copies feed with all sources and posts
- fails when feed does not exist
- copies feed with zero posts when include-posts is zero
- copies feed with instagram source and specified number of posts explicitly

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes.

## License

This project is licensed under the MIT License.

## Contact

For any questions or support, please open an issue or contact [amirali-kh@live.com](mailto:amirali-kh@live.com).
