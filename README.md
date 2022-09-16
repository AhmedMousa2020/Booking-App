## About Backend

Booking Web App

## prerequisites

- PHP version 7.3 or higher
- composer installing
- Node installing

## Setup

- Clone repository
- Create '.env' file from sample '.env.example'
- Update DB credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD etc)
- Ensure you have PHP and apache server running. You can get this via 
[Wamp](https://www.wampserver.com/en/) or [Xammp](https://www.apachefriends.org/), 
- Open terminal and run 
  - `composer install && npm install`
  - `php artisan key:generate`
  - `php artisan migrate`
  - `php artisan db:seed` (for dummy data)
  - `php artisan serve`
- Navigate to 'localhost:8000' and see application is running

## Api's Notes

- api link for postman collection
  - your_serve\api\find //find availability for the selected time
    - Attributes: 
      - start_date //eg.(2022-09-16)
      - end_date  //eg.(2022-09-29)
  - your_serve\api\booking  //book
    - Attributes
      - user_id //employee who responsible for booking
      - customer_name
      - email
      - phone
      - hotel_id
      - branch_id
      - room_type //eg.(single,double,suite)
      - room_number
      - customers_room  // the number of customer in one room
      - start_date
      - end_date
  - your_serve\api\update //update booking
    - user_id
    - hotel_id
    - branch_id
    - room_id
    - room_type //eg.(single,double,suite)
    - customers_number // the number of customer in one room
    - start_date
    - end_date
  - your_serve\api\cancel //cancel booking
    - Attributes
      - customer_id 

## database Notes
- admin-login: email => `admin@example.com` , password => `password`

## Additional Notes
- i did't work with sql server becuase bad configration on my machin and thare is no time to figure out what is it 
- i worked with mysql but i put the configration of sql serve database connection commented in .env,config\database.php files
you can uncomment it and test it with your configration (i don't know if it will work) so please
reviwe my work  with mysql 

   


