<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use File;

class dbstore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dbstore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is only for update the database or content file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*for limit extend*/
        ini_set('memory_limt','2040M');
        ini_set('max_execution_time',600);

        /*delete the upload folder*/
        File::deleteDirectory(base_path('public/uploads'));

        /*upload the folder*/
        $zip = new \ZipArchive();
        $zip->open(base_path('public/uploads.zip'));
        $zip->extractTo('public');

        /*delete the all table from database*/
        Schema::disableForeignKeyConstraints();
        foreach (DB::select('SHOW TABLES') as $table){
            $table_array = get_object_vars($table);
            Schema::drop($table_array[key($table_array)]);
        }

        /*upload the sql file in database*/
        $sql_path = base_path('demo.sql');
        DB::unprepared(file_get_contents($sql_path));
        echo 'Operation done';
    }
}
