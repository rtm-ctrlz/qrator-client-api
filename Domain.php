<?php

namespace Qrator\APIClient;

use Qrator\APIClient\Base;

class Domain extends Base
{

    const OBJECT_CLASS = 'domain';

    public function domain_status_get(): string
    {
        $this->call(__FUNCTION__);
    }

    public function domain_ip_test(): array
    {
        $this->call(__FUNCTION__);
    }

    public function domain_ip_get(): array
    {
        $this->call(__FUNCTION__);
    }

    public function domain_ip_get_list(): array
    {
        $this->call(__FUNCTION__);
    }

    public function domain_ip_set(array $UpstreamConfiguration): bool
    {
        $this->call(__FUNCTION__, $UpstreamConfiguration);
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

    public function whitequeue_flush(): bool
    {
        $this->call(__FUNCTION__);
    }

    public function whitequeue_get(): array
    {
        $this->call(__FUNCTION__);
    }

    public function whitequeue_get_max_size(): int
    {
        $this->call(__FUNCTION__);
    }

    public function whitequeue_get_size(): int
    {
        $this->call(__FUNCTION__);
    }

    public function whitequeue_remove(array $ipList): bool
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function whitequeue_set_max_size(int $size): bool
    {
        $this->call(__FUNCTION__, $size);
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

    public function troubleshoot_traceroute(string $ip): string
    {
        $this->call(__FUNCTION__, $ip);
    }

    public function test_iplist(array $ipList): array
    {
        $this->call(__FUNCTION__, $ipList);
    }

    public function test_timediplist(array $timedIpList): array
    {
        $this->call(__FUNCTION__, $timedIpList);
    }

}
