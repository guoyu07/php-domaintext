<?php

namespace Kumatch\DomainText;

use Symfony\Component\Yaml\Yaml;

class Registry
{

    /** @var array[]  */
    protected $domainTexts = array();

    /**
     * @param string $domainName
     * @param array $texts
     */
    public function register($domainName, array $texts = array())
    {
        $this->domainTexts[$domainName] = $texts;
    }

    /**
     * @param string $domainName
     * @param bool $mutable
     * @throws InvalidArgumentException
     * @return ImmutableDomain|MutableDomain
     */
    public function getDomain($domainName, $mutable = false)
    {
        if (!isset($this->domainTexts[$domainName])) {
            throw new InvalidArgumentException();
        }

        $domainTexts = $this->domainTexts[$domainName];

        if ($mutable) {
            return new MutableDomain($domainTexts);
        } else {
            return new ImmutableDomain($domainTexts);
        }
    }

    /**
     * @return string[]
     */
    public function getNames()
    {
        return array_keys($this->domainTexts);
    }


    /**
     * @param $filename
     * @throws InvalidArgumentException
     */
    public function load($filename)
    {
        if (!is_file($filename)) {
            throw new InvalidArgumentException($filename . ': domains file not exists');
        }

        $extname = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        switch ($extname) {
            case "json":
                $domains = $this->loadJSONFile($filename);
                break;
            case "ini":
                $domains = $this->loadINIFile($filename);
                break;
            case "yml":
            case "yaml":
                $domains = $this->loadYAMLFile($filename);
                break;
            default:
                throw new InvalidArgumentException($filename . ': domains file format is not supported.');
        }

        if (!$domains || !is_array($domains)) {
            throw new InvalidArgumentException($filename . ': invalid domains file format.');
        }

        foreach ($domains as $name => $texts) {
            $this->register($name, $texts);
        }
    }

    /**
     * @param $filename
     * @return array
     */
    protected function loadJSONFile($filename)
    {
        $assoc = true;

        return json_decode(file_get_contents($filename), $assoc);
    }

    /**
     * @param $filename
     * @return array
     */
    protected function loadINIFile($filename)
    {
        $processSections = true;

        return parse_ini_file($filename, $processSections);
    }

    /**
     * @param $filename
     * @return array
     */
    protected function loadYAMLFile($filename)
    {
        return Yaml::parse($filename);
    }
}