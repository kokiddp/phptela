<?php

namespace KokiDDP\PHPTela\Model\Responses;

use KokiDDP\PHPTela\Model\Activity;

class ActivityResponse extends BaseResponse
{
  private Activity $data;

  public function __construct(string $status, Activity $data, ?string $message = null) {
    parent::__construct($status, $message);
    $this->data = $data;
  }

  /**
   * Get the value of data
   * 
   * @return Activity
   */
  public function get(): Activity
  {
    return $this->data;
  }
}