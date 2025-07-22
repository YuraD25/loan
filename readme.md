## Установка и запуск

1.  **Клонируйте репозиторий:**
    ```bash
    git clone https://github.com/YuraD25/loan.git
    cd loan
    ```

2.  **Соберите и запустите Docker-контейнеры:**
    ```bash
    docker-compose up -d --build
    ```
    При первом запуске Composer установит все PHP-зависимости, а Doctrine создаст базу данных. Это может занять несколько минут.

3.  **Примените миграции базы данных:**
    ```bash
    docker-compose exec php bin/console doctrine:migrations:migrate
    ```
    Введите `yes` для подтверждения.

4.  **Приложение будет доступно по адресу:** `http://localhost:8080`

## Использование API

### 1. Создание нового клиента

**Эндпоинт:** `POST http://localhost:8080/create-new-client`

**Заголовки:**
```
Content-Type: application/json
Accept: application/json
```

**Тело запроса (JSON):**
```json
{
  "firstName": "Petr",
  "lastName": "Pavel",
  "age": 35,
  "region": "PR",
  "city": "Prague",
  "income": 1500,
  "score": 600,
  "pin": "123-45-6789",
  "email": "petr.pavel@example.com",
  "phone": "+420123456789"
}
```

**Пример с `curl`:**
```bash
curl -X POST http://localhost:8080/create-new-client \
-H "Content-Type: application/json" \
-d '{
  "firstName": "Petr",
  "lastName": "Pavel",
  "age": 35,
  "region": "PR",
  "city": "Prague",
  "income": 1500,
  "score": 600,
  "pin": "123-45-6789",
  "email": "petr.pavel@example.com",
  "phone": "+420123456789"
}'
```
**Возможные ответы:**
*   `201 Created` - Клиент успешно создан.
*   `400 Bad Request` - Ошибки валидации данных (неверный формат email, пустое поле и т.д.).

### 2. Выдача нового кредита

**Эндпоинт:** `POST http://localhost:8080/create-new-loan`

**Заголовки:**
```
Content-Type: application/json
```

**Тело запроса (JSON):**
```json
{
  "name": "Personal Loan",
  "clientId": 1,
  "amount": 10000,
  "rate": 10,
  "start_date": "2025-01-01",
  "end_date": "2025-12-31"
}
```
*Примечание: `clientId` должен соответствовать ID существующего клиента в базе данных.*

**Пример с `curl`:**
```bash
curl -X POST http://localhost:8080/create-new-loan \
-H "Content-Type: application/json" \
-d '{
  "name": "Personal Loan",
  "clientId": 1,
  "amount": 10000,
  "rate": 10,
  "start_date": "2025-01-01",
  "end_date": "2025-12-31"
}'
```
**Возможные ответы:**
*   `200 OK` - Кредит одобрен и выдан.
*   `422 Unprocessable Entity` - Заявка отклонена по одному из бизнес-правил (неподходящий возраст, низкий доход и т.д.).

## Инструменты для разработки

### Тесты

Для запуска тестов используйте следующие команды:
```bash
# Запустить все тесты
docker-compose exec php bin/phpunit
```

### Статический анализ и стиль кода

В проекте настроены PHP-CS-Fixer и PHPStan. Для их запуска используйте удобные скрипты Composer:

```bash
# Проверить стиль кода (без исправления)
docker-compose exec php composer check-cs

# Автоматически исправить стиль кода
docker-compose exec php composer fix-cs

# Запустить статический анализ кода (PHPStan)
docker-compose exec php composer analyse

# Запустить все проверки последовательно
docker-compose exec php composer check-all
```

## Просмотр логов

Для просмотра логов в реальном времени (включая уведомления для клиентов) выполните команду:
```bash
docker-compose logs -f php
```
Вы увидите сообщения вида:
`[Дата/время] Уведомление клиенту [Имя клиента]: Кредит одобрен/отклонен.`

## Архитектурное видение

Гибкость добавления новых правил проверки достигается за счет паттерна **Стратегия** и **Принципа Открытости/Закрытости (OCP)**.

1.  **Интерфейс `CreditCheckRuleInterface`**: Определяет контракт для всех правил-валидаторов.
2.  **Классы-правила**: Каждое правило (возраст, доход, регион) реализовано как отдельный класс, реализующий этот интерфейс.
3.  **UseCase**: `IssueLoan` получает коллекцию всех правил благодаря механизму автоконфигурации Symfony. Он последовательно применяет каждое правило, не зная о его конкретной реализации.

Чтобы добавить новое правило, достаточно создать новый класс, реализующий `CreditCheckRuleInterface`. Никаких изменений в существующем коде не потребуется.
