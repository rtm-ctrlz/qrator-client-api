<?php

namespace Qrator\APIClient;

use Qrator\APIClient\Base;

class Service extends Base
{

    const OBJECT_CLASS = 'service';

    public function service_status_get(): string
    {
        $this->call(__FUNCTION__);
    }

    public function service_ip_test(array $ipList): array
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function service_ip_get(): array
    {
        $this->call(__FUNCTION__);
    }

    public function service_ip_set(array $ipList): bool
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function service_ports_test(array $portList): array
    {
        $this->call(__FUNCTION__, $portList);
    }

    public function service_ports_get(): array
    {
        $this->call(__FUNCTION__);
    }

    public function service_ports_set(rray $portList): array
    {
        $this->call(__FUNCTION__, $portList);
    }

    public function whitelist_get(): array
    {
        $this->call(__FUNCTION__);
    }

    public function whitelist_append(array $ipList): bool
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function whitelist_remove(array $ipList): bool
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function whitequeue_append(array $ipList): bool
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function blacklist_append(array $ipList): bool
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function blacklist_remove(array $ipList): bool
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function blacklist_check(string $ip): string
    {
        $this->call(__FUNCTION__, $ip);
    }

    public function blacklist_status(string $ip): string
    {
        $this->call(__FUNCTION__, $ip);
    }

    public function blacklist_flush(): bool
    {
        $this->call(__FUNCTION__);
    }

    public function statistics_get(): array
    {
        $this->call(__FUNCTION__);
    }

    public function ip_status(string $ip): string
    {
        $this->call(__FUNCTION__, $ip);
    }

}
