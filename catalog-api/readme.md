# Эндпоинты продуктов

GET /api/products - показать все продукты

GET /api/products/id - показать продукт с этим id

POST /api/products/destroy/id - удалить продукт с этим id

POST /api/products/update/id - удалить продукт с этим id

POST /api/products/add_category/{id}/{categoryId} - Добавить категорию к продукту {id} - id продукта, {categoryId} id категории
delete_category

POST /api/products/delete_category/{id}/{categoryId} - Удалить категорию к продукту {id} - id продукта, {categoryId} id категории

POST /api/products/store

Создать продукт с этими параметрами пост запроса:
```        $name = $request->input('name');
        $color = $request->input('color');
        $description = $request->input('description');
        $amount = $request->input('amount');
```

## Эндпоинты категорий
GET /api/categories - список всех категорий

GET /api/categories/id - получить какие продукты внутри катеогории с этим id

POST /api/categories/make - создать категорию с именем 'name' из параметра POST запроса  

POST categories/destroy/id - удалить категорию с этим ID

## Эндпоинты авторизации
```POST /api/register
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password'
```
В ответ JWT токен, если валидация непрошла значит json ошибку

POST /api/login
login, password

В ответ JWT токен, если credentials неправильные значит даст json ошибку
---

Если ты не отправил JWT в Bearer токен в запросе то тебя будет перекидывать на страницу авторизации