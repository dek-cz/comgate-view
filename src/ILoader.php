<?php

namespace DekApps\Comgate;

use DekApps\Comgate\Model\MethodItemContainer;

interface ILoader
{

    public function fetch(array $options = []): MethodItemContainer;
    public function setMerchant(string $merchant);
    public function setSecret(string $secret);
    public function setLang(string $lang);
    public function setUri(string $uri);
}
