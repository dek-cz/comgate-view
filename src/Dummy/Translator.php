<?php

declare(strict_types=1);

namespace DekApps\Comgate\Dummy;

use Nette\Localization\ITranslator;

/**
 * Fake for defaults
 */
final class Translator implements ITranslator
{

    public function translate($message, ...$parameters): string
    {
        return $message;
    }

}
