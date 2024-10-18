<?php

namespace KokiDDP\PHPTela;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use KokiDDP\PHPTela\Model\Activity;
use KokiDDP\PHPTela\Model\Responses\ActivityResponse;
use KokiDDP\PHPTela\Model\Responses\ActivitiesListResponse;

class TelaClient
{
  private Client $client;

  public function __construct()
  {
    $this->client = new Client([
      'base_uri' => 'https://telabe.kicky.cloud/',
      'headers' => [
        'Content-Type' => 'application/json',
      ],
    ]);
  }

  /**
   * Get an activity by its ID.
   *
   * @param string $activityId
   * @return ActivityResponse
   * @throws GuzzleException
   */
  public function getActivity(string $activityId): ActivityResponse
  {
    $response = $this->client->post('download', [
      'json' => [
        'lucca_req' => [
          'type' => 'get_activity',
          'activityId' => $activityId,
        ],
      ],
    ]);

    $data = json_decode($response->getBody()->getContents(), true);

    return new ActivityResponse($data['status'], new Activity($data['data']), $data['message']);
  }

  /**
   * Get all activities.
   *
   * @return ActivitiesListResponse
   * @throws GuzzleException
   */
  public function getAllActivities(): ActivitiesListResponse
  {
    $response = $this->client->post('download', [
      'json' => [
        'lucca_req' => [
          'type' => 'get_homepage',
        ],
      ],
    ]);

    $data = json_decode($response->getBody()->getContents(), true);

    $events = array_map(
      fn(array $eventData) => new Activity($eventData),
      $data['data']
    );

    return new ActivitiesListResponse($data['status'],$events, $data['message']);
  }
}
