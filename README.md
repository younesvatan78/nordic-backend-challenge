# Overview
A wallet micro-service to get the balance of each user's wallet and add money to their wallet.
# Usage
Run tests:
```
php artisan test
```
and to test the API:
Use ```[GET] localhost:8000/api/wallet/balance/{user_id}``` to get the wallet balance of the user, where user_id is the id of user.

Use ```[POST] localhost:8000/api/wallet/add-money``` with the user_id and amount fields required in the body of your request.

To simplify your usage you can use these two curl requests:
```curl --location '127.0.0.1:8000/api/wallet/balance/1'``` To get wallet balance 

To add money to the wallet (supports negative values too):
```curl --location '127.0.0.1:8000/api/wallet/add-money' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'user_id=1' \
--data-urlencode 'amount=50'
```
