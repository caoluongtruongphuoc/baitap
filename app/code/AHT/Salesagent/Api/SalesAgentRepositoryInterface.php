<?php
namespace AHT\Salesagent\Api;

use AHT\Salesagent\Api\Data\SalesAgentInterface;

interface SalesAgentRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @param string $skuKey
     * @return mixed|null
     */
    public function getList($skuKey);
}
