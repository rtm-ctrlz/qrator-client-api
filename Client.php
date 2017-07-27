<?php

namespace Qrator\APIClient;

use Qrator\APIClient\Base;

class Client extends Base
{

    const OBJECT_CLASS = 'client';

    public function domains_get(): array
    {
        return $this->call(__FUNCTION__);
    }

    public function prefix_list(): array
    {
        return $this->call(__FUNCTION__);
    }

    public function prefix_announce_status(string $prefix): string
    {
        return $this->call(__FUNCTION__, $prefix);
    }

    public function prefix_announce_on(string $prefix): bool
    {
        return $this->call(__FUNCTION__, $prefix);
    }

    public function prefix_announce_off(string $prefix): bool
    {
        return $this->call(__FUNCTION__, $prefix);
    }

    public function source_ips_get(): array
    {
        return $this->call(__FUNCTION__);
    }

}
