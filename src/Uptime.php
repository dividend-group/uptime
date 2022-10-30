<?php

namespace DividendGroup\Uptime;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Uptime
{
    public static function ping(array $servers)
    {
        return Uptime::process($servers);
    }

    private static function process($input = null)
    {
        $script = realpath(__DIR__ . '/../scripts/572982bbc4f29ee92ae2d65a9edc2453d2c9170c.py');
        $input = ($input) ? json_encode($input) : null;

        $process = new Process(['python', $script], null, [
            'SYSTEMROOT' => getenv('SYSTEMROOT'),
            'PATH' => getenv("PATH"),
            'APP_ENV' => false,
            'SYMFONY_DOTENV_VARS' => false,
        ],
        input: $input);

        $process->run();
        
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    
        $data = $process->getOutput(); 
        return json_decode($data);
    }
}
