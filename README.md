# Hypersign Wordpress plugin


![image](https://user-images.githubusercontent.com/15328561/117573635-aa44a180-b0f6-11eb-8090-f7f2526d7475.png)


### Flow

* We can not integrate hypersign sdk in wp-backend because we can not write whole sdk in php -  WP supports PHP.
* When a user opens the login page, the `wb-frontend` request a new challenge from `wp-backend`. The `wp-backend` requests that from `HS-WP-Server` by sending `AppID` and `AppSecret`.  
* The `HS-WP-Server` connects with `HS-Subscription server` to verify the `AppID` and `AppSecret`.  
* The `HS-WP-Server` then sends a new challenge along with other metadata like did, schema etc to the `WP-backend` or to the Hypersign plugin.
* The `Hypersign-plugin` at `WP-frontend` displays the QR code.
* The user scans the QR code and generates verifiable presentation
  * Meanwhile `Hypersign-plugin` at `WP-frontend` keep polling the `WP-backend` about this challenge.
* The user sends the VP to the `WP-backend`, the   `WP-backend` then again interacts with `HS-WP-Server` to verify the VP.
* The `HS-WP-Server`  verifies the VP and sends the userdata back to  `WP-backend` . 
* The  `WP-backend`  responds to the polling request from frontend.
* The  `WP-backend`  checks if this user is already present in the db, if not it creates a new user in the db.

Note:

* The admin of the app has to comes to developer portal and get `AppID` and `AppSecret`.  
* The admin then installs the `Hypersign WordPress Plugin` in the app.

## Installation 


```
cd /var/www/html/wp-content/plugins/
git clone https://github.com/hypersign-protocol/hs-wordpress-plugin hypersign-auth
```


## /auth

### Request

```js

POST 192.168.43.43/index.php/wp-json/hs/api/v2/challenge
Body: {
    "user": 123,
    "name": "Vishwas anand",
    "email": "vishu1@gmail.com"
}
```

### Response

```js
[
    {
        "user": 123,
        "name": "Vishwas anand",
        "email": "vishu1@gmail.com"
    },
    {
        "challenge": "7d5a355f-40da-4635-91ad-ec4c15ebed00"
    }
]

```

## /challenge

### Request

```js
GET 192.168.43.43/index.php/wp-json/hs/api/v2/challenge

```

### Response

```js
{
    "status": 200,
    "message": "success",
    "error" : null
}
```