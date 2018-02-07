<?php

use App\Common\CommonInterface;
use App\Exception\AppException;
use App\Logger;
use App\Registry\Config;
use Commando\Command;

class App
{
    const CLASS_NAME_PREFIX = "App\\Common\\";
    const ENV_PROD = 'prod';
    const ENV_DEV = 'dev';

    /**
     * @var string
     */
    protected $env;

    public function __construct(string $env)
    {
        $this->env = $env;
        $this->setConfig();
    }

    /**
     * @param Command|null $input
     */
    public function run(Command $input = null): void
    {
        try {
            $className = self::CLASS_NAME_PREFIX . ucfirst($input[0]);
            if (!class_exists($className)) {
                throw new AppException("Wrong class name!");
            }
            $this->doRun(new $className());
        } catch (Exception $exception) {
            $this->writeError($exception->getMessage());
        }
    }

    /**
     * @param CommonInterface $common
     * @return bool
     */
    protected function doRun(CommonInterface $common): bool
    {
        $common->run();
        return true;
    }

    /**
     * @return string
     */
    public function getLogDir() : string
    {
        return dirname(__DIR__) . '/logs';
    }

    /**
     * Set config
     */
    protected function setConfig()
    {
        $configDb = require_once dirname(__DIR__) . '/config/prod.php';
        if($this->env == self::ENV_DEV){
            $configDb = array_merge(
                $configDb,
                require_once dirname(__DIR__) . '/config/dev.php'
            );
        }
        Config::set(Config::DB, $configDb['db']);
    }

    /**
     * @param $text string
     */
    private function writeError($text): void
    {
        Logger::error($text, $this->env);
        if ($this->env !== self::ENV_PROD) {
            echo "ERROR: " . $text, PHP_EOL;
        }
    }

}