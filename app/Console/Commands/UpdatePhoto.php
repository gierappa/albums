<?php

namespace App\Console\Commands;

use App\Photo;
use Illuminate\Console\Command;

class UpdatePhoto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:update {ids* : Photos Ids}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a single photo or multiple photos property';

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
        $photos = Photo::findMany($this->argument('ids'));

        $property = $this->choice('Select property to change', [
            'title',
            'description',
            'author'
        ], 'title');

        $newValue = $this->ask("New {$property} value");

        foreach ($photos as $photo) {
            $photo->{$property} = $newValue;
            $photo->save();
        }

        $this->info('Modified photos:');
        dd($photos->toArray());
        return true;
    }
}
