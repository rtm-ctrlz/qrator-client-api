<?php

namespace Qrator\APIClient;

use Exception;
use Qrator\APIClient\Exception\{
    AccessExcetion,
    ApiException,
    CommunicationException,
    ProtocolException
};

abstract class Base
{

    const BASE_URI = 'https://api.qrator.net/request/%s/%d';
    const SUCCESS = 'Successful';
    const OBJECT_CALL = 'base';

    /**
     * Entity ID
     * @var int
     */
    protected $id = 0;

    /**
     * IP address to bind on for outgoing requests
     * @var string
     */
    protected $bindIP = '';

    /**
     * User-Agent to send in headers
     * @var string
     */
    protected $userAgent = '';

    public function __construct(int $id, string $userAgent = 'Q.API client')
    {
        $this->id = $id;
        $this->userAgent = $userAgent;
    }

    /**
     * Magic call wrapper for "custom" requests
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     * @throws Exception
     * @throws ApiException
     * @throws CommunicationException
     * @throws AccessExcetion
     * @throws ProtocolException
     */
    public function __call(string $method, array $arguments = [])
    {
        return $this->call($method, count($arguments) == 0 ? NULL : $arguments);
    }

    /**
     * Get IP on interface to bind for outgoing requests
     *
     * @return string
     */
    public function getBindIP(): string
    {
        return $this->bindIP;
    }

    /**
     * Set IP on interface to bind for outgoing requests
     *
     * @param string $bindIP
     * @return self
     */
    public function setBindIP(string $bindIP): self
    {
        $this->bindIP = $bindIP;
        return $this;
    }

    /**
     * Get current User-Agent value
     *
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Set User-Agent value
     *
     * @param string $userAgent
     * @return self
     */
    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @param string $method
     * @param array $params
     * @return mixed
     * @throws Exception
     * @throws ApiException
     * @throws CommunicationException
     * @throws AccessExcetion
     * @throws ProtocolException
     */
    public function call(string $method, $params = NULL, int $id = NULL)
    {

        # Set up Curl
        $hCurl = curl_init();
        curl_setopt_array($hCurl, array(
            CURLOPT_URL            => sprintf(static::BASE_URI, static::OBJECT_CALL, $this->id),
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST           => TRUE,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'User-Agent: ' . $this->userAgent,
            ],
            CURLOPT_POSTFIELDS     => json_encode([
                'method' => $method,
                'params' => $params,
                'id'     => $id ?? time()
            ]),
        ));

        if ($this->bindIP != '') {
            if (!curl_setopt($hCurl, CURLOPT_INTERFACE, $this->bindIP)) {
                throw new CommunicationException('Qrator.API call error: failed to set outgoung interface');
            }
        }
        # Execute
        $sResult = curl_exec($hCurl);

        $httpCode = curl_getinfo($hCurl, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            switch ($httpCode) {
                case 200:
                    break;
                case AccessExcetion::HTTP_CODE:
                    throw new AccessExcetion('Qrator.API access forbidden');
                default:
                    throw new ApiException('Qrator.API error: HTTP error', $httpCode);
            }
        }
        if ($sResult === FALSE) {
            throw new CommunicationException('Qrator.API call error: ' . curl_error($hCurl), curl_errno($hCurl));
        }

        # Check the result
        $aResult = json_decode($sResult, TRUE);
        if (is_array($aResult)) {
            $result = $aResult['result'] ?? NULL;
            $error = $aResult['error'] ?? NULL;
            if (is_null($result)) {
                if (is_null($error)) {
                    throw new ProtocolException('Qrator.API unknown response');
                }
                throw new ApiException('Qrator.API error: ' . $error, 200);
            }
            if ($result === static::SUCCESS) {
                return TRUE;
            }
            return $result;
        }
        throw new ProtocolException('Qrator.API unknown response');
    }

    public function ping(): string
    {
        $this->call(__FUNCTION__);
    }

}
