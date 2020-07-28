<?php

declare(strict_types=1);

namespace DekApps\Comgate\Loader;

use DekApps\Comgate\ILoader;
use DekApps\Comgate\Model\MethodItemContainer;
use GuzzleHttp\ClientInterface;

final class HttpLoader implements ILoader
{

    private ClientInterface $client;
    private string $merchant;
    private string $secret;
    private string $lang;
    private string $uri;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetch(array $options = []): MethodItemContainer
    {
        $data = [
            'merchant' => $this->merchant,
            'secret' => $this->secret,
            'lang' => $this->lang,
            'type' => 'json',
        ];
        $options = array_merge($options, [
            'form_params' => $data,
        ]);
        $res = $this->client->request('POST', $this->uri, $options);
        var_dump($res);
        exit;
        //@todo
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
