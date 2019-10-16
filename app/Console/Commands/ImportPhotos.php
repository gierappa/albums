<?php

namespace App\Console\Commands;

use App\Album;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class ImportPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:import {--O|overwrite : Overwrite current photos by new data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import photos';

    /**
     * Progress bar
     *
     * @var ProgressBar
     */
    protected $bar;

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
        $url = "https://jsonplaceholder.typicode.com/photos";
        $overwrite = $this->option('overwrite');

        try {
            $json = file_get_contents($url);
        } catch (\Exception $e) {
            $this->error('Data read failed. Exception: ' . $e->getMessage());
            return false;
        }

        if (!$json) {
            $this->error('Data read is empty.');
        }

        $collection = collect(json_decode($json, true));
        $this->bar = $this->output->createProgressBar($collection->count());
        # Group by albumId to reduce query amount
        $grouped = $collection->groupBy('albumId', true);
        $this->info('Import started - current photos will ' . ($overwrite ? '' : 'NOT') . ' be overwritten');
        $this->bar->start();

        try {
            foreach ($grouped as $albumId => $photos) {
                /** @var Album $album */
                $album = Album::firstOrCreate([
                    'id'   => $albumId,
                    'name' => "Album {$albumId}", //Album name is not specified
                ]);

                if ($overwrite) {
                    $this->overwritePhotos($album, $photos);
                } else {
                    $this->addNewPhotos($album, $photos);
                }
            }
        } catch (\Exception $e) {
            $this->error("\n" . 'Something goes wrong. Exception: ' . $e->getMessage());
            return false;
        }

        $this->info("\n" . 'Import completed.');
        return true;
    }

    /**
     * @param Album      $album
     * @param Collection $photos
     */
    private function overwritePhotos(Album $album, Collection $photos)
    {
        foreach ($photos as $photo) {
            $album->photos()->updateOrCreate(['id' => $photo['id']], $photo);
            $this->bar->advance();
        }
    }

    /**
     * @param Album      $album
     * @param Collection $photos
     */
    private function addNewPhotos(Album $album, Collection $photos)
    {
        foreach ($photos as $photo) {
            $album->photos()->firstOrCreate(['id' => $photo['id']], $photo);
            $this->bar->advance();
        }
    }
}
