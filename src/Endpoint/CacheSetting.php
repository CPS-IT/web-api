<?php
declare(strict_types=1);

namespace Myracloud\WebApi\Endpoint;

use GuzzleHttp\RequestOptions;

/**
 * Class CacheSetting
 *
 * @package Myracloud\WebApi\Endpoint
 */
class CacheSetting extends AbstractEndpoint
{
    /**
     * @var string
     */
    protected $epName = 'cacheSettings';

    /**
     * @param        $domain
     * @param        $path
     * @param        $ttl
     * @param string $type
     * @param bool   $enabled
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(
        $domain,
        $path,
        $ttl,
        $type = self::MATCHING_TYPE_PREFIX,
        $enabled = true
    ) {
        $uri = $this->uri . '/' . $domain;


        $this->validateMatchingType($type);

        $options[RequestOptions::JSON] =
            [
                "path"    => $path,
                "ttl"     => $ttl,
                "type"    => $type,
                "enabled" => $enabled,
            ];

        /** @var \GuzzleHttp\Psr7\Response $res */
        $res = $this->client->request('PUT', $uri, $options);

        return $this->handleResponse($res);
    }

    /**
     * @param           $domain
     * @param           $id
     * @param \DateTime $modified
     * @param           $path
     * @param           $ttl
     * @param string    $type
     * @param bool      $enabled
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(
        $domain,
        $id,
        \DateTime $modified,
        $path,
        $ttl,
        $type = self::MATCHING_TYPE_PREFIX,
        $enabled = true
    ) {

        $uri = $this->uri . '/' . $domain;

        $this->validateMatchingType($type);

        $options[RequestOptions::JSON] =
            [
                "id"       => $id,
                'modified' => $modified->format('c'),
                "path"     => $path,
                "ttl"      => $ttl,
                "type"     => $type,
                "enabled"  => $enabled,
            ];

        /** @var \GuzzleHttp\Psr7\Response $res */
        $res = $this->client->request('POST', $uri, $options);

        return $this->handleResponse($res);
    }
}