<?php

namespace App\Model;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\DB;

class Image extends Model {

    protected $table = 'images';

    protected $fillable = [
        'file_location',
    ];

    protected $hidden = [
        'pivot',
        'id',
        'created_at',
        'updated_at',
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

    public static function getImagePath($model): ?string
    {
        return dirname(__DIR__, 3) . "\\resources\\uploads\\".$model->images[0]->file_location;
    }

    /**
     * @throws Exception
     */
    public static function updateFiles($file, $model): bool
    {
        if(!self::validateFile($file))
            return false;

        $oldName = $model->images[0]->file_location;
        $name = bin2hex(random_bytes(24)) . "." . explode(".",$file["name"])[1];
        $uploadFolder = dirname(__DIR__, 3) . "\\resources\\uploads\\".$name;

        if(!move_uploaded_file( $file['tmp_name'], $uploadFolder ))
            return false;

        Image::query()->where('file_location', '=', $oldName)->update([
            'file_location' => $name,
        ]);

        return true;
    }

    /**
     * Clean up hole database with pivot keys
     * @param $fileName
     */
    public static function deleteFile($fileName){
        unlink(dirname(__DIR__, 3) . "\\resources\\uploads\\". $fileName);
        $image = Image::query()->where('file_location', '=', $fileName)->first();
        Capsule::table("image_ables")->where("image_id", "=", $image->id)->delete();
        $image->delete();
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
