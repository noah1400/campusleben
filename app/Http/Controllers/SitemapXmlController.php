<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use App\Models\Event;

class SitemapXmlController extends Controller
{
    public function index() {
        $events = Event::all();
        return SitemapGenerator::create('https://www.campusleben-es.de')
            ->getSitemap()
            ->add(Event::all())
            ->toResponse(request());
    }
}
