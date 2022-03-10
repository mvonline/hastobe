## Description:
use Laravel Framework to develop

## How to run and Test:
- Clone from Repository
- Cd to project folder
----------------
- copy .env.example to .env
- composer install
- php artisan key:generate
- php artisan serve
- php artisan test
-----------------

API path (POST) http://127.0.0.1:8000/api/rate

Doc path (Swagger) http://127.0.0.1:8000/api/documentation

----------------

## Improvements Suggestion
- Add Station Identifire
- Divide into two endpoint a.rate b.cdr Record
- Stanardize response based on JsonApi
- Send time as timestamp or Human Readable standard
- Generate UUID or TransactionId for Accounting purpose
- For Monthly Billing or pay With Credit Card maybe Batch or Async based on Message queue Suggested
- Rate Limit
- Cache Rate Values
- Dockerize
- Swagger Documentation
- Authentication and Autherisation

## Contact
* masoud.vafaei@gmail.com
* Whatsapp: +989359815396
