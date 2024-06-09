# Voting App

This is a simple voting application built with Laravel 11 and Vue 3. Follow the instructions below to set up and run the application on your local machine.

## Prerequisites

- PHP (version 8.2 or higher)
- Composer
- Node.js and npm

## Installation

1. Clone the repository to your local machine.

    ```sh
    git clone https://github.com/Lipppitt/fidelity-voting.git
    cd fidelity-voting
    ```

2. Install PHP dependencies using Composer.

    ```sh
    composer install
    ```

3. Install JavaScript dependencies using npm.

    ```sh
    npm install
    ```

4. Compile the assets.

    ```sh
    npm run dev
    ```

5. Copy the example environment file and configure your environment variables.

    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

6. Configure Laravel Sanctum.

   - Ensure the `SESSION_DOMAIN` and `SANCTUM_STATEFUL_DOMAINS` are set in your `.env` file. For example:

       ```env
       SESSION_DOMAIN=localhost
       SANCTUM_STATEFUL_DOMAINS=localhost:8000
       ```

   - Publish the Sanctum configuration file.

       ```sh
       php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
       ```

   - Run the Sanctum migrations.

       ```sh
       php artisan migrate
       ```

7. Seed the database.

    ```sh
    php artisan db:seed --class=PollSeeder
    ```

8. Run the development server.

    ```sh
    php artisan serve
    ```

9. Start the queue worker.

    ```sh
    php artisan queue:work
    ```

## Usage

After following the installation steps, you can access the application at `http://localhost:8000`.

## Additional Commands

- To compile assets for production, run:

    ```sh
    npm run production
    ```

- To run database migrations, use:

    ```sh
    php artisan migrate
    ```

- To run tests, use:

    ```sh
    php artisan test
    ```
