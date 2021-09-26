<?php

namespace Syedali\magicid\Commands;

use Illuminate\Console\Command;

class MagicCommand extends Command {

    protected $signature = 'db:addmagicid';

    protected $description = 'This command will add primary key and auto-increment';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {

    	\App::make("\Syedali\magicid\Controllers\DatabaseupdateController")->database_update();
        echo 'Successully Executed !';
    }

}
