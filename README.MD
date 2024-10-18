# PHPTela - CulturaTela PHP API Wrapper

PHPTela is a simple PHP client library for interacting with the CulturaTela API. It provides methods to retrieve activities and activity lists from the CulturaTela service.

## Installation

You can install PHPTela via Composer. Run the following command:

```bash
composer require kokiddp/phptela
```

## Requirements

- PHP 8.1 or higher

## Usage

### 1. Initialize the client

To use the client, you need to instantiate the `TelaClient` class:

```php
use KokiDDP\PHPTela\TelaClient;

$client = new TelaClient();
```

### 2. Get an activity by its ID

To retrieve an activity by its activityID, use the `getActivity` method:

```php
$activityId = 'your_activity_id';
$response = $client->getActivity($activityId);
$activity = $response->get();
echo $activity->title;
```

### 3. Get all activities

To retrieve all activities, use the `getAllActivities` method:

```php
$response = $client->getAllActivities();
$activities = $response->get();
foreach ($activities as $activity) {
    echo $activity->title;
}
```

### 4. Work with the collection

A few handy methods are included:

```php
$response = $client->getAllActivities();
$activities = $response->filterByTitle('something')->get();
$activities = $response->filterByType('Museo')->get();
$activities = $response->search('keyword')->get();
$activities = $response->filterByCity('Lucca')->get();
$activities = $response->filterByDates(new CarbonImmutable('now'), new CarbonImmutable('next month'))->get();
$activities = $response->orderByStartDate()->get();
```

The methods can be chained:

```php
$response = $client->getAllActivities();
$activities = $response
    ->filterByType('Evento')
    ->filterByCity('Lucca')
    ->filterByDates(new CarbonImmutable('now'), new CarbonImmutable('next month'))
    ->orderByStartDate()
    ->get();
```

A generic filter method that accepts a callable is included:

```php
$response = $client->getAllActivities();
$activities = $response
    ->where(fn(Activity $activity) => $activity->isOpen)
    ->get();
```

## License

This library is licensed under the GPL-3.0-or-later License. See the [LICENSE](LICENSE.MD) file for details.

## Authors

- Gabriele Coquillard @ ELK-Lab - [Email](mailto:gabriele@elk-lab.com)
