# Tasks API

Testing task for developer's ability

## Installation

After downloading or git pull

- Step 1: install php dependencies 
```bash
composer Install
```

- Step 2: install js and assets 
```bash
npm install
```
- Step 3: Create .env file and set database details 
- Step 4: generate key
```bash
php artisan key:generate
```
- Step 5: set queue connection in .env as database 
```bash
QUEUE_CONNECTION=database
```

- Step 6: Run migrations with seeder
```bash
php artisan migrate --seed
```

- Step 7: start php server (optional)
```bash
php artisan serve
```

- Step 8: click login link and login with details 
```bash
User: brijesh@test.com
pass: test
```
- Step 9: to import api data go to "API Data" menu and click on refresh icon, this will create jobs in database and then run the worker with command 
```bash
php artisan queue:work
```
this command will start the importing process

Note: while worker running you can click refresh button to keep the database updated from api data.

## License
[MIT](https://choosealicense.com/licenses/mit/)