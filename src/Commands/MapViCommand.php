<?php

namespace Jmnn\MapVi\Commands;

use Illuminate\Console\Command;
use JMap;

class MapViCommand extends Command
{
    protected $signature = 'map:vi {--search=Ha noi}';

    protected $description = 'Map vi';

    public function handle()
    {

        $address = $this->__getData();

        $result = JMap::build($address,$this->option('search'));

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

    private function __getData()
    {
        return (array) json_decode((file_get_contents(__DIR__.'/data.json')),true);
    }


}
