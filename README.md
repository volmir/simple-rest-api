# simple-rest-api

A phone book running on the REST API.

### Installation

```sh
$ cd /path/to/htdocs
$ git clone https://github.com/volmir/air-api-interface.git
```

### Usage

```sh
$ curl -X GET http://example.com/api/users
$ curl -X GET http://example.com/api/users/1
$ 
$ curl -X POST \
$   http://example.com/api/users \
$   -H 'cache-control: no-cache' \
$   -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
$   -F name=Alex \
$   -F 'phone=044 598-39-27'
$ 
$ curl -X PUT http://example.com/api/users
$ curl -X PATCH http://example.com/api/users
$ curl -X DELETE http://example.com/api/users
```
