# Разворачивания проекта

1. Cклонировать репозиторий
```
git clone --branch=dev git@github.com:djeday/facepass.git
```
2. Перейти в папку проекта и выполнить скрипт
```
   sh ./build.sh
```

# REST запросы
1. Получить всех пользователей
```
GET http://127.0.0.1:8080/api/v1/users/all
```
2. Получить информацию о пользователе по ID
```
GET http://127.0.0.1:8080/api/v1/users/{id}
```

# Консольные команды
Импорт пользователей из Facebook
   ```
   php artisan importUsers
   ```
