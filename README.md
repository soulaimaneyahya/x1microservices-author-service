# Author service

Generate key
```sh
php -r "echo 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;"
```

Running
```sh
php -S localhost:8001 -t public
```
