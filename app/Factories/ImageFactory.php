<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/21/15
 * Time: 11:11 PM
 */

namespace Twitter\Factories;

use Intervention\Image\ImageManager;
use Twitter\Image;

class ImageFactory {

    private $interventionImage;

    protected $image, $intervention;

    public function __construct(Image $image, ImageManager $intervention)
    {
        $this->intervention = $intervention;
        $this->image = $image;
    }

    public function create($userId, $image)
    {
        $this->interventionImage = $this->intervention->make($image->getRealPath());

        $filename = [
            'actual' => $this->generatePath(),
            'large' => $this->generatePath('large'),
            'medium' => $this->generatePath('medium'),
            'small' => $this->generatePath('small'),
            'tiny' => $this->generatePath('tiny')
        ];

        $this->interventionImage->save($filename['actual']);
        $this->fit(200)->save($filename['large']);
        $this->fit(48)->save($filename['medium']);
        $this->fit(32)->save($filename['small']);
        $this->fit(24)->save($filename['tiny']);

        $newImage = $this->image->create([
            'user_id' => $userId,
            'actual' => $filename['actual'],
            'large' => $filename['large'],
            'medium' => $filename['medium'],
            'small' => $filename['small'],
            'tiny' => $filename['tiny'],
        ]);

        return $newImage->id;
    }

    private function fit($size)
    {
        return $this->interventionImage->fit($size);
    }

    private function generatePath($size = 'actual')
    {
        $timeCreated = time() * 1000;
        $name = uniqid(rand(), true);
        $mimeType = substr($this->interventionImage->mime(), 6);
        $fullName = "{$name}_{$size}.{$mimeType}";

        if(!file_exists(public_path("images/{$timeCreated}")))
        {
            mkdir(public_path("images/{$timeCreated}"));
        }

        return public_path("images/{$timeCreated}/{$fullName}");
    }
}