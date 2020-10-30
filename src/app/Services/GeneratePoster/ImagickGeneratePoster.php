<?php


namespace App\Services\GeneratePoster;


use App\Services\GeneratePoster\Interfaces\GeneratePosterInterface;
use Illuminate\Database\Eloquent\Model;
use Imagick;
use ImagickDraw;
use ImagickPixel;
use ImagickException;

class ImagickGeneratePoster implements GeneratePosterInterface
{
    /**
     * @param Model $image
     * @param array $posterData
     * @throws ImagickException
     */
    public function generate(Model $image, array $posterData): string
    {
        $imagePath = 'storage' . $image->path . $image->name;

        $imagick = new Imagick();
        $imagick->readImage($imagePath);

        $imageHeight = $imagick->getImageHeight();
        $imageWidth = $imagick->getImageWidth();

        $strokeColor = new ImagickPixel('white');
        $fillColor = new ImagickPixel('white');

        $title = new ImagickDraw();
        $title->setFillColor($fillColor);
        $title->setGravity(Imagick::GRAVITY_SOUTH);
        $title->setFontSize(36);
        $title->setFont(public_path('fonts/arial.ttf'));
        $titleText = strtoupper($posterData['title']);

        $horizontalLine = new ImagickDraw();
        $horizontalLine->setStrokeColor($strokeColor);
        $horizontalLine->setStrokeWidth(2);
        $horizontalLine->setFillColor($fillColor);
        $horizontalLine->line(40, $imageHeight + 120, $imageWidth + 40, $imageHeight + 120);

        $description = new ImagickDraw();
        $description->setFillColor($fillColor);
        $description->setGravity(Imagick::GRAVITY_SOUTH);
        $description->setFontSize(16);
        $description->setFont(public_path('fonts/arial.ttf'));

        $descriptionText = $posterData['text'];

        $imagick->setImageBackgroundColor("#{$posterData['bg_color']}");
        $imagick->borderImage("#{$posterData['bg_color']}", 40, 30);
        $imagick->extentImage(
            $imagick->getImageWidth(),
            $imagick->getImageHeight() + 170,
            0,
            0
        );

        $imagick->annotateimage($title, 0, 120, 0, $titleText);
        $imagick->drawImage($horizontalLine);
        $imagick->annotateimage($description, 0, 75, 0, $descriptionText);

        //when editing, overwrite existing image, else create a new one
        if (isset($posterData['poster_name'])) {
            $posterName = $posterData['poster_name'];
        } else {
            $posterName = uniqid('poster_') . '_' . $image->name;
        }

        $imagick->writeImage('storage' . $image->path . $posterName);

        return $posterName;
    }
}
