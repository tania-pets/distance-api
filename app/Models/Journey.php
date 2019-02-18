<?php
namespace App\Models;


/**
 * Just a mock class for a journey object
 */
Class Journey
{

    private $data;

    protected $fillable = ['distance', 'type', 'start_at', 'end_at'];

    const JOURNEY_TYPES = ['walking', 'biking', 'driving', 'flying'];

    public function __construct(array $data)
    {
        /**************************/
         /*Validate data here omitted*/
        /**************************/
        foreach ($this->fillable as $key) {
            $this->data[$key] = $data[$key];
        }

    }

    public function toArray(): array
    {
        return $this->data;
    }




}
