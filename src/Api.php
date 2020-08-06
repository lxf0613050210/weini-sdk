<?php


namespace Seekx2y\WeiniSDK;

use Hanson\Foundation\AbstractAPI;
use Hanson\Foundation\Foundation;

class Api extends AbstractAPI
{
    const DEV_URL = '121.41.84.251:9090';
    const PRODUCTION_URL = 'http://vip.nysochina.com';

    private $key;
    private $parenter;
    private $url;
    private $interfaceName;
    private $content;

    /**
     * Api constructor.
     * @param Weini $weini
     */
    public function __construct(Weini $weini)
    {
        $config = $weini->getConfig();
        parent::__construct(new Foundation($config));
        $this->key = $config['key'] ?? '';
        $this->parenter = $config['parenter'] ?? '';
        $this->url = $config['debug'] ? static::DEV_URL : static::PRODUCTION_URL;
    }

    /**
     * @param string $interfacename
     * @param string $content
     * @return string
     */
    private function createToken(string $interfacename, string $content): string
    {
        return md5($this->key . date('Y-m-d') . $interfacename . $content);
    }

    /**
     * @param string $api
     * @param string $interfacename
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $api, string $interfacename, array $params)
    {
        $this->interfaceName = $interfacename;
        $this->content =  json_encode($params);
        $response = $this->getHttp()->json($this->url . $api, $params);

        return json_decode(strval($response->getBody()));
    }

    public function middlewares()
    {
        $this->http->addMiddleware($this->headerMiddleware([
            'Content-Type' => 'Content-Type: application/json',
            'interfacename' => $this->interfaceName,
            'parenter' => $this->parenter,
            'token' => $this->createToken($this->interfaceName, $this->content),
            'content' => $this->content,
        ]));
    }
}