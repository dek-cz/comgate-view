<?php

declare(strict_types=1);

namespace DekApps\Comgate\Loader;

use DekApps\Comgate\ILoader;
use DekApps\Comgate\Model\MethodItemContainer;
use DekApps\Comgate\Model\MethodItem;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

final class HttpLoader implements ILoader
{

    private ClientInterface $client;
    private string $merchant;
    private string $secret;
    private string $lang;
    private string $uri;
    private ?\stdClass $body = null;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    private function getBody(ResponseInterface $origin): ?\stdClass
    {
        if ($this->body === null) {
            $body = $origin->getBody();
            $body->rewind();
            $content = $body->getContents();
            $this->body = json_decode($content);
            ;
        }
        return $this->body;
    }

    protected function parseData(ResponseInterface $origin): ?\stdClass
    {
        $ret = null;
        if ($origin->getStatusCode() === 200) {
            $ret = $this->getBody($origin);
        } // else log error
        return $ret;
    }

    public function fetch(array $options = []): MethodItemContainer
    {
        $data = [
            'merchant' => $this->merchant,
            'secret' => $this->secret,
            'lang' => $this->lang === 'cz' ? 'cs' : $this->lang,
            'type' => 'json',
        ];
        $options = array_merge($options, [
            'form_params' => $data,
        ]);
        $res = $this->client->request('POST', $this->uri, $options);

        $parsed = $this->parseData($res);

        return $this->cast($parsed);
    }

    protected function cast(\stdClass $res): MethodItemContainer
    {
        $ret = new MethodItemContainer();
        if (isset($res->methods) && is_array($res->methods)) {
            foreach ($res->methods as $m) {
                $ret->addItem(new MethodItem($m->id, $m->name, $m->logo, $m->description));
            }
        }
        return $ret;
    }

    public function setMerchant(string $merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    public function setSecret(string $secret)
    {
        $this->secret = $secret;
        return $this;
    }

    public function setLang(string $lang)
    {
        $this->lang = $lang;
        return $this;
    }

    public function setUri(string $uri)
    {
        $this->uri = $uri;
        return $this;
    }

}
