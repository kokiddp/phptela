<?php

namespace KokiDDP\PHPTela;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use KokiDDP\PHPTela\Model\Activity;
use KokiDDP\PHPTela\Model\User;
use KokiDDP\PHPTela\Model\Responses\ActivityResponse;
use KokiDDP\PHPTela\Model\Responses\ActivitiesListResponse;
use KokiDDP\PHPTela\Model\Responses\LoginResponse;
use KokiDDP\PHPTela\Model\Responses\ResetPasswordResponse;

class TelaClient
{
  private Client $client;
  private string $apiUrl;

  public function __construct(bool $sandbox = false)
  {
    $this->apiUrl = $this->getApiUrl($sandbox);
    $this->client = new Client([
      'base_uri' => $this->apiUrl,
      'headers' => [
        'Content-Type' => 'application/json',
        'Accept' => '*/*',
        'Accept-Encoding' => 'gzip, deflate, br',
        'Connection' => 'keep-alive',
      ],
    ]);
  }

  /**
   * Get the API URL.
   * 
   * @param bool $sandbox
   * @return string
   */
  private function getApiUrl(bool $sandbox = false): string
  {
    return $sandbox ? 'https://teladevbe.kicky.cloud/' : 'https://telabe.kicky.cloud/';
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

    return new ActivityResponse($data['status'], new Activity($data['data']), $data['message'] ?? $data['errorMessage']);
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

    return new ActivitiesListResponse($data['status'],$events, $data['message'] ?? $data['errorMessage']);
  }

  /**
   * Login
   * 
   * @param string $email
   * @param string $password
   * @return LoginResponse
   * @throws GuzzleException
   */
  public function login(string $email, string $password): LoginResponse
  {
    $response = $this->client->post('', [
      'json' => [
        'lucca_req' => [
          'type' => 'sign_in',
          'email' => $email,
          'pwd' => $password,
        ],
      ],
    ]);

    $data = json_decode($response->getBody()->getContents(), true);

    return new LoginResponse($data['status'], isset($data['data']) && $data['data'] ? new User($data['data']) : null, $data['message'] ?? $data['errorMessage']);
  }

  /**
   * Reset password
   * 
   * @param string $email
   * @return ResetPasswordResponse
   * @throws GuzzleException
   */
  public function resetPassword(string $email): ResetPasswordResponse
  {
    $response = $this->client->post('', [
      'json' => [
        'lucca_req' => [
          'type' => 'reset_password',
          'email' => $email,
        ],
      ],
    ]);

    $data = json_decode($response->getBody()->getContents(), true);

    print_r($data);

    return new ResetPasswordResponse($data['status'], $data['message'] ?? $data['errorMessage']);
  }
}
