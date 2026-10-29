<?php

namespace App\Services;

use App\Models\Announcement;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class AnnouncementQrCode
{
    public function previewUrl(Announcement $announcement): string
    {
        return rtrim(config('app.url'), '/').route('web.announcements.show', $announcement, false);
    }

    public function svg(Announcement $announcement): string
    {
        $url = $this->previewUrl($announcement);
        $writer = new Writer(new ImageRenderer(new RendererStyle(600), new SvgImageBackEnd));
        $svg = $writer->writeString($url);

        return preg_replace('/(<svg\b[^>]*>)/', '$1<title>'.htmlspecialchars($url, ENT_XML1 | ENT_QUOTES, 'UTF-8').'</title>', $svg, 1);
    }
}
