<?php

namespace KokiDDP\PHPTela\Model\Responses;

use KokiDDP\PHPTela\Model\Activity;
use Illuminate\Support\Collection;

class ActivitiesListResponse extends BaseResponse
{
  private Collection $data;

  public function __construct(string $status, array $data, ?string $message = null)
  {
    parent::__construct($status, $message);
    $this->data = collect($data);
  }

  /**
   * Get all the activities.
   *
   * @return Activity[]
   */
  public function get(): array
  {
    return $this->data->all();
  }

  /**
   * Get activities Collection.
   * 
   * @return Collection
   */
  public function getCollection(): Collection
  {
    return $this->data;
  }

  /**
   * Filter the activities with a callback.
   *
   * @param callable $callback
   * @return self
   */
  public function where(callable $callback): self
  {
    $this->data = $this->data->filter($callback)->values();
    return $this;
  }

  /**
   * Filter the activities by title.
   *
   * @param string $title
   * @return self
   */
  public function filterByTitle(string $title): self
  {
    $this->data = $this->data
      ->filter(fn(Activity $activity) => stripos($activity->title, $title) !== false)
      ->values();
    return $this;
  }

  /**
   * Search the activities by title and description.
   *
   * @param string $keyword
   * @return self
   */
  public function search(string $keyword): self
  {
    $this->data = $this->data
      ->filter(fn(Activity $activity) =>
        stripos($activity->title, $keyword) !== false ||
        stripos($activity->description, $keyword) !== false
      )
      ->values();
    return $this;
  }

  /**
   * Filter the activities by type.
   *
   * @param string $type
   * @return self
   */
  public function filterByType(string $type): self
  {
    $this->data = $this->data
      ->where('type', $type)
      ->values();
    return $this;
  }

  /**
   * Filter the activities by city.
   *
   * @param string $city
   * @return self
   */
  public function filterByCity(string $city): self
  {
    $this->data = $this->data
      ->filter(fn(Activity $activity) => $activity->info->city === $city)
      ->values();
    return $this;
  }

  /**
   * Order the activities by start date.
   *
   * @param bool $ascending
   * @return self
   */
  public function orderByStartDate(bool $ascending = true): self
  {
    $this->data = $this->data
      ->sortBy(
        fn(Activity $activity) => $activity->startDate ? new CarbonImmutable($activity->startDate) : null,
        SORT_REGULAR,
        !$ascending
      )
      ->values();
    return $this;
  }

  /**
   * Filter the activities by dates
   * 
   * @param \DateTimeImmutable $startDate
   * @param \DateTimeImmutable|null $endDate
   * @return self
   */
  public function filterByDates(\DateTimeImmutable $startDate, ?\DateTimeImmutable $endDate = null): self
  {
    $this->data = $this->data
      ->filter(fn(Activity $activity) => $activity->startDate
        ? new \DateTimeImmutable($activity->startDate) >= $startDate
        : false
      )
      ->filter(fn(Activity $activity): string|null => $endDate !== null && $activity->endDate
        ? new \DateTimeImmutable($activity->endDate) <= $endDate
        : null
      )
      ->values();
    return $this;
  }
}
