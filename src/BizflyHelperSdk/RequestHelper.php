<?php

namespace BizflyHelperSdk;

use BizflyCrmSdk\CrmClient;
use BizflyCrmSdk\Enum\Param;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use http\Exception\RuntimeException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestHelper
{
    private $apiUrl;
    private $apiVersion;
    private $auth;
    private $debug;
    private $transport;
    private $caBundle;

    /** @var LoggerInterface */
    private $logger;

    /** @var RequestInterface */
    private $lastRequest;

    /** @var ResponseInterface */
    private $lastResponse;

    public function __construct(AuthHelper $authHelper,ConfigHelper $configHelper)
    {
        $this->apiUrl = $configHelper->getConfig('sdk_domain');
        $this->apiVersion = CrmClient::VERSION;
        $this->transport = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false ),'verify' => false));
        $this->auth = $authHelper;
        $this->debug = $configHelper->getConfig('debug');
    }


    public function getCaBundle()
    {
        return $this->caBundle;
    }

    public function setCaBundle($caBundle)
    {
        $this->caBundle = $caBundle;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface|null $logger
     * @return void
     */
    public function setLogger(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }
    /**
     * @return ResponseInterface
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * @return ResponseInterface
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @param $path
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($path, array $params = [])
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * @param $path
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($path, array $params = [])
    {
        return $this->request('PUT', $path, $params);
    }

    /**
     * @param $path
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($path, array $params = [])
    {
        return $this->request('POST', $path, $params);
    }

    /**
     * @param $path
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($path, array $params = [])
    {
        return $this->request('DELETE', $path, $params);
    }

    // private

    /**
     * @param $method
     * @param $path
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request($method, $path, array $params = [])
    {
        if ('GET' === $method) {
            $path = $this->prepareQueryString($path, $params);
        }

        $request = new Request($method, $this->prepareUrl($path));

        return $this->send($request, $params);
    }

    /**
     * @param RequestInterface $request
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function send(RequestInterface $request, array $params = [])
    {
        $this->lastRequest = $request;

        $options = $this->prepareOptions(
            $request->getMethod(),
            $request->getRequestTarget(),
            $params
        );

         $this->lastResponse = $response = $this->transport->send($request, $options);

        if ($this->logger && $response) {
            $this->logWarnings($response);
        }

        return $response;
    }

    /**
     * @param $path
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function prepareQueryString($path, array &$params = [])
    {
        if (!$params) {
            return $path;
        }

        // omit two_factor_token
        $query = array_diff_key($params, [Param::TWO_FACTOR_TOKEN => true]);
        $params = array_intersect_key($params, [Param::TWO_FACTOR_TOKEN => true]);

        $path .= false === strpos($path, '?') ? '?' : '&';
        $path .= http_build_query($query, '', '&');

        return $path;
    }

    /**
     * @param $path
     * @return string
     */
    private function prepareUrl($path)
    {
        return $this->apiUrl . '/' . ltrim($path, '/');
    }

    private function prepareOptions($method, $path, array $params = [])
    {
        $options = [];

        if ($this->caBundle) {
            $options[RequestOptions::VERIFY] = $this->caBundle;
        }

        // omit two_factor_token
        $data = array_diff_key($params, [Param::TWO_FACTOR_TOKEN => true]);
        if ($data) {
            $options[RequestOptions::JSON] = $data;
            $body = json_encode($data);
        } else {
            $body = '';
        }

        $defaultHeaders = [
            'User-Agent' => 'crm.bizfly.vn/php-sdk/' . CrmClient::VERSION,
            'CB-VERSION' => $this->apiVersion,
            'Content-Type' => 'application/json',
        ];

        if (isset($params[Param::TWO_FACTOR_TOKEN])) {
            $defaultHeaders['CB-2FA-TOKEN'] = $params[Param::TWO_FACTOR_TOKEN];
        }

        $options[RequestOptions::HEADERS] = $defaultHeaders + $this->auth->getRequestHeaders(
                $method,
                $path,
                $body
            );

        return $options;
    }

    /**
     * @param $response
     * @return string | mixed
     */

    private function logWarnings($response)
    {
        $body = (string)$response->getBody();
        if (false === strpos($body, '"warnings"')) {
            return;
        }

        $data = json_decode($body, true);
        if (!isset($data['warnings'])) {
            return;
        }

        foreach ($data['warnings'] as $warning) {
            $this->logger->warning(isset($warning['url'])
                ? sprintf('%s (%s)', $warning['message'], $warning['url'])
                : $warning['message']);
        }
    }

    /**
     * @param $response
     * @return string | mixed
     */
    public function decode($response)
    {
        if($response){
            return json_decode($response->getBody(), true);
        }else{
            return [];
        }

    }

    /**
     * @param $url
     * @return string
     */
    public function setApiUrl($url){
        $this->apiUrl = $url;
    }

    /**
     * @return string
     */
    public function getApiUrl(){
        return $this->apiUrl;
    }
}
