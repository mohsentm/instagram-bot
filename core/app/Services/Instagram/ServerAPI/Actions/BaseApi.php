<?php

namespace App\Services\Instagram\ServerAPI\Actions;

use InstagramAPI\Instagram as API;

/**
 * Class BaseApi
 * @package App\Services\Instagram\ServerAPI\Actions
 * @property-read $api
 */
abstract class BaseApi
{
    protected $api;

    public function __construct()
    {
        $this->api = new API();
    }

    public function getUsername(): string
    {
        return $this->api->username;
    }

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function login(string $username, string $password): self
    {
        $this->api->login($username, $password);
        return $this;
    }
}
