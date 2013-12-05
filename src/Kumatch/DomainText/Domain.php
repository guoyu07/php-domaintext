<?php

namespace Kumatch\DomainText;

abstract class Domain
{
    protected $texts = array();

    /**
     * @param array $texts
     */
    public function __construct(array $texts = array())
    {
        $this->texts = $texts;
    }

    /**
     * @param $text
     * @throws InvalidArgumentException
     * @return mixed
     */
    public function get($text)
    {
        if (!$this->isValidText($text)) {
            throw new InvalidArgumentException();
        }

        if (isset($this->texts[$text])) {
            return $this->texts[$text];
        } else {
            return $text;
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->texts);
    }

    /**
     * @param $text
     * @return bool
     */
    protected function isValidText($text)
    {
        return (is_scalar($text) && !is_bool($text));
    }
}