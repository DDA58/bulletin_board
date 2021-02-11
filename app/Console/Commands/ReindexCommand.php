<?php

namespace App\Console\Commands;

use Elasticsearch\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all adverts to Elasticsearch';

    /**
     * The console command description.
     *
     * @var \Elasticsearch\Client
     */
    private $elasticsearch;

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start command!'."\n");
        $files = File::files(app_path('Models'));

        foreach ($files as $file) {
            $reflection = new \ReflectionClass('App\Models\\'.str_replace('.php', '', $file->getFilename()));
            $traits = $reflection->getTraits();
            $matches  = preg_grep ('/\\HasFulltextSearchFilter/', array_keys($traits));
            if(!count($matches))
                continue;

            $className = $reflection->getName();
            $this->info("Indexing all {$reflection->getShortName()}.");

            foreach ($className::cursor() as $entityToIndex)
            {
                $this->elasticsearch->index([
                    'index' => $entityToIndex->getSearchIndex(),
                    'type' => $entityToIndex->getSearchType(),
                    'id' => $entityToIndex->getKey(),
                    'body' => $entityToIndex->getDataBySearchFields(),
                ]);
            }
            $this->info("{$reflection->getShortName()} ended.");
        }
        $this->info("\nDone!");
    }
}
