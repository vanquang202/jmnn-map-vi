<?php

namespace Jmnn\MapVi\Commands;

use Illuminate\Console\Command;
use Str;

class MapViCommand extends Command
{
    protected $signature = 'map:vi {--search=Ha noi}';

    protected $description = 'Map vi';

    public function __construct(private Str $str)
    {
        parent::__construct();
    }

    public function handle()
    {

        $address = (array) json_decode((file_get_contents(__DIR__.'/data.json')),true);
        $result = array_filter($address,function ($data) {
            $name = $this->__convertString($data['name']);
            return (bool) $this->__macth($this->option('search'),$name);
        });

        if(count($result) > 0)  $this->table(['Id','Name'], $result);
        else $this->table(['Id','Name'], [['Empty','Empty']]);

        return $this->__success();
    }

    private function __success() : int
    {
        return Command::SUCCESS;
    }

    private function __fail() : int
    {
        return Command::FAILURE;
    }

    private function __convertString($data)
    {
        return $this->str::squish($this->str::slug($data,' '));
    }

    private function __macth($search , $str)
    {
        $patternString = implode(")|(",array_map(function ($data) {
            return $this->__convertString($data);
        },explode(",",$search)));
        $pattern = '/('.$patternString.')/i';
        return (bool) preg_match($pattern,$str);
    }
}
