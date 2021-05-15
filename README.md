# Hypersign Wordpress plugin

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
    "email": "vishu.anand1@gmail.com"
}
```

### Response

```js
[
    {
        "user": 123,
        "name": "Vishwas anand",
        "email": "vishu.anand1@gmail.com"
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
    "QRType": "REQUEST_CRED",
    "serviceEndpoint": "http://192.168.43.43/index.php/wp-json/hs/api/v2/auth?challenge=7d5a355f-40da-4635-91ad-ec4c15ebed00",
    "schemaId": "sch_3008d429-47fa-41fb-a2b0-6d9c294553d2",
    "appDid": "did:hs:e463b0d2-a721-40f4-8328-63886b175a0c",
    "appName": "Wordpress Auth Server",
    "challenge": "7d5a355f-40da-4635-91ad-ec4c15ebed00"
}
```