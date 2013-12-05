<?php

namespace Kumatch\DomainText;

class MutableDomain extends Domain
{
    /**
     * @param $text
     * @param $result
     * @throws InvalidArgumentException
     */
    public function set($text, $result)
    {
        if (!$this->isValidText($text)) {
            throw new InvalidArgumentException();
        }

        $this->texts[$text] = $result;
    }
}