<?php

namespace App\Model;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model {

    protected $table = 'images';

    protected $fillable = [
        'file_location',
    ];

    public function events(): MorphToMany
    {
        return $this->morphedByMany(Event::class, 'image_ables');
    }

    public function locations(): MorphToMany
    {
        return $this->morphedByMany(Location::class, 'image_ables');
    }

    public function performers(): MorphToMany
    {
        return $this->morphedByMany(Performer::class, 'image_ables');
    }

    /**
     * @throws Exception
     */
    public static function uploadFile($file, $model): bool
    {
        if(!self::validateFile($file))
            return false;

        $name = bin2hex(random_bytes(24)) . "." . explode(".",$file["name"])[1];
        $uploadFolder = dirname(__DIR__, 3) . "\\resources\\uploads\\".$name;

        if(!move_uploaded_file( $file['tmp_name'], $uploadFolder ))
            return false;

        $image = Image::create(['file_location' => $name]);
        $model->images()->attach($image);
        return true;
    }

    private static function validateFile($file): bool
    {
        if(!isset($file))
            return false;

        $maxsize = 2097152;
        $acceptable = array(
            'application/pdf',
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/png'
        );

        if (($file['size'] >= $maxsize) || ($file["size"] == 0)) {
            return false;
        }

        if (!in_array($file['type'], $acceptable) && (!empty($file["type"]))) {
            return false;
        }

        return true;
    }
}
