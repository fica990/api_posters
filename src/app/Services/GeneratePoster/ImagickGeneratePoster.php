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
    const TITLE_FONT_SIZE = 36;
    const TEXT_FONT_SIZE = 16;
    const STROKE_WIDTH = 2;
    const STROKE_COLOR = 'white';
    const FILL_COLOR = 'white';
    const FONT_ARIAL = 'fonts/arial.ttf';

    /**
     * @param Model $image
     * @param array $posterData
     * @throws ImagickException
     */
    public function generate(Model $image, array $posterData): string
    {
        $imagePath = 'storage' . $image->path . $image->name;
        $strokeColor = new ImagickPixel(self::STROKE_COLOR);
        $fillColor = new ImagickPixel(self::FILL_COLOR);

        //load image
        $imagick = new Imagick();
        $imagick->readImage($imagePath);

        //set and customize title, line and text
        $title = $this->setTitle($fillColor);
        $horizontalLine = $this->setHorizontalLine($imagick, $fillColor, $strokeColor);
        $text = $this->setText($fillColor);

        //add image border and bottom "space"
        $this->extentImage($imagick, $posterData);

        //put everything on image
        $imagick->annotateimage($title, 0, 120, 0, strtoupper($posterData['title']));
        $imagick->drawImage($horizontalLine);
        $imagick->annotateimage($text, 0, 75, 0, $posterData['text']);

        //when editing, overwrite existing image, else create a new one
        if (isset($posterData['poster_name'])) {
            $posterName = $posterData['poster_name'];
        } else {
            $posterName = uniqid('poster_') . '_' . $image->name;
        }

        $imagick->writeImage('storage' . $image->path . $posterName);

        return $posterName;
    }

    public function setTitle(ImagickPixel $fillColor): ImagickDraw
    {
        $title = new ImagickDraw();
        $title->setFillColor($fillColor);
        $title->setGravity(Imagick::GRAVITY_SOUTH);
        $title->setFontSize(self::TITLE_FONT_SIZE);
        $title->setFont(public_path(self::FONT_ARIAL));

        return $title;
    }

    public function setHorizontalLine(Imagick $imagick, ImagickPixel $fillColor, ImagickPixel $strokeColor): ImagickDraw
    {
        $imageHeight = $imagick->getImageHeight();
        $imageWidth = $imagick->getImageWidth();

        $horizontalLine = new ImagickDraw();
        $horizontalLine->setStrokeColor($strokeColor);
        $horizontalLine->setStrokeWidth(self::STROKE_WIDTH);
        $horizontalLine->setFillColor($fillColor);
        $horizontalLine->line(40, $imageHeight + 120, $imageWidth + 40, $imageHeight + 120);

        return $horizontalLine;
    }

    public function setText(ImagickPixel $fillColor): ImagickDraw
    {
        $text = new ImagickDraw();
        $text->setFillColor($fillColor);
        $text->setGravity(Imagick::GRAVITY_SOUTH);
        $text->setFontSize(self::TEXT_FONT_SIZE);
        $text->setFont(public_path(self::FONT_ARIAL));

        return $text;
    }

    public function extentImage(Imagick $imagick, array $posterData): void
    {
        $imagick->setImageBackgroundColor("#{$posterData['bg_color']}");
        $imagick->borderImage("#{$posterData['bg_color']}", 40, 30);
        $imagick->extentImage(
            $imagick->getImageWidth(),
            $imagick->getImageHeight() + 170,
            0,
            0
        );
    }
}
