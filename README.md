## Description
A simple transaction report API with Laravel Framework

## How to run and Test
```bash
git clone https://github.com/mvonline/hastobe.git
cd hastobe
cp .env.example .env
composer install
php artisan key:generate
php artisan l5-swagger:generate
php artisan serve
php artisan test
```

### Run with Docker
```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan test
```
------------
### Endpoints
- [POST] http://127.0.0.1:8000/api/rate
- Doc path (Swagger) http://127.0.0.1:8000/api/documentation

##### Sample Payload 
```json
{
  "rate": {
    "energy": 0.3,
    "time": 2,
    "transaction": 1
  },
  "cdr": {
    "meterStart": 1204307,
    "timestampStart": "2021-04-05T10:04:00Z",
    "meterStop": 1215230,
    "timestampStop": "2021-04-05T11:27:00Z"
  }
}
```
##### Sample Response
```json
{
    "overall": 7.04,
    "components": {
        "energy": 3.277,
        "time": 2.767,
        "transaction": 1
    }
}
```

## Improvement Suggestions
- Add StationId in payload for the purpose of statistial analysis
- Introduce a separete endpoint to set/change the rate and dedicate this one to records
- Return response in a more convenient and expressive form based on JsonApi
- Send time as timestamp or Human Readable standard
- Return UUID or TransactionId for accounting purpose
- For Monthly Billing or pay With Credit Card maybe Batch or Async based on Message queue Suggested
- Rate Limit
- Cache Rate Values
- Dockerize
- Swagger Documentation
- Authentication and Authorization

## Contact
* masoud.vafaei@gmail.com
* Whatsapp: +989359815396
