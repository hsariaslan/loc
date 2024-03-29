# League of Champions
League of Champions is a simple fantasy football simulation project build with Laravel + React.

![tournament-teams](public/screenshot-1.png "Tournament Teams")
![generated-fixtures](public/screenshot-2.png "Generated Fixtures")
![simulation](public/screenshot-3.png "Simulation")

## Installation
- `php artisan key:generate`
- Create new database named `league_of_champions` in your local machine.
- `composer install`  
- `cp .env.example .env`  
- Change db credentials in `.env` file with yours.  
- `php artisan migrate --seed`  
- `npm install`  
- Open up 2 terminals and run following commands:  
- `php artisan serve`  
- `npm run dev` 
- See [localhost:8000](http://localhost:8000)
