<?php

namespace seregazhuk\PinterestBot\Helpers\Providers\Traits;

use Iterator;
use seregazhuk\PinterestBot\Helpers\Pagination;

trait HasFollowers
{
    use ProviderTrait;

    /**
     * @param array  $data
     * @param string $resourceUrl
     * @param int    $batchesLimit
     *
     * @return Iterator
     */
    public function getFollowData($data, $resourceUrl, $batchesLimit = 0)
    {
        $requestData = array_merge([$data, $resourceUrl]);

        return (new Pagination($this))->run('getPaginatedData', $requestData, $batchesLimit);
    }
}