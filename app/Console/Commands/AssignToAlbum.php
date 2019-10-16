<?php


namespace App\Console\Commands;

use App\Album;
use App\Photo;
use Illuminate\Console\Command;

class AssignToAlbum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'album:assign {id : Album Id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign selected photos to album';

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
        $album = Album::find($this->argument('id'));

        if(!$album) {
            $this->error('Album not found');
        }

        $photosIds = $this->ask('Provide photos ids (separated by a space) to be assigned to the album');
        $photosIdsArray = explode(" ", $photosIds);

        $validator = \Validator::make(
            ['photos_ids' => $photosIdsArray],
            ['photos_ids.*' => 'required|int'],
            ['photos_ids.*' => 'No ids provided.']
        );

        if ($validator->fails()) {
           $this->error($validator->errors()->first());
           return false;
        }

        $photos = Photo::findMany($photosIds);

        $album->photos()->saveMany($photos);

        $album->photos;
        $this->info('Album photos:');
        dd($album->toArray());
        return true;
    }
}
