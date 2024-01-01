<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop\Products;
use App\Models\Blog\BlogList;

class SitemapController extends Controller
{
    public function generate()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        // Dodaj statyczne ścieżki
        $staticRoutes = [
            '/wspolpraca' => 'monthly',
            '/o-naszej-firmia' => 'monthly',
            '/kolekcje' => 'monthly',
            '/faq' => 'monthly',
            '/kontakt' => 'monthly',
            '/polityka-prywatnosci' => 'monthly',
            '/regulamin' => 'monthly',
            '/blog' => 'monthly',
            '/logowanie' => 'monthly',
            '/rejestracja' => 'monthly',
            '/odzyskiwanie-hasla' => 'monthly',
            '/resetowanie-hasla' => 'monthly',
            '/sklep' => 'monthly',
            '/koszyk' => 'monthly',
            '/strona-zamowienia' => 'monthly',
            '/podziekowanie-za-zamowienie' => 'monthly',
            '/status-zamowienia' => 'monthly'
        ];

        foreach ($staticRoutes as $path => $changefreq) {
            $this->addUrl($xml, 'https://soyfragrance.com' . $path, '2023-10-10T00:00:00+00:00', $changefreq, 0.8);
        }

        // Pobierz dynamiczne wpisy z modelu Wpisy
        $entries = BlogList::all();

        // Dodaj dynamiczne strony na podstawie danych z modelu Wpisy (na końcu sitemapu)
        foreach ($entries as $entry) {
            $url = 'https://soyfragrance.com/artykul/' . $entry->id;
            $lastmod = $entry->updated_at->toIso8601String();
            $this->addUrl($xml, $url, $lastmod, 'weekly', 0.6);
        }

        $products = Products::all();

        foreach ($products as $product) {
            $url = 'https://soyfragrance.com/strona-produktu/' . $product->id;
            $lastmod = $product->updated_at->toIso8601String();
            $this->addUrl($xml, $url, $lastmod, 'weekly', 0.6);
        }

        $xml->endElement();
        $xmlContent = $xml->outputMemory();

        return response($xmlContent)->header('Content-Type', 'text/xml');
    }

    private function addUrl(\XMLWriter $xml, $loc, $lastmod, $changefreq, $priority)
    {
        $xml->startElement('url');
        $xml->writeElement('loc', $loc);
        $xml->writeElement('lastmod', $lastmod);
        $xml->writeElement('changefreq', $changefreq);
        $xml->writeElement('priority', $priority);
        $xml->endElement();
    }
}
