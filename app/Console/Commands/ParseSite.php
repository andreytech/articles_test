<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;
use App\Models\Article;


class ParseSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $url = 'https://www.spiegel.de/politik/';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $browser = new HttpBrowser(HttpClient::create());

        $browser->request('GET', $this->url);
        $response = $browser->getResponse();

        $crawler = new Crawler($response);
        $crawler
            ->filter('[data-block-el^="articleTeaser"]')
            ->each(function (Crawler $node, $i) {
                $article = new Article();
                $article->title = $node->filter("[class*='opacity-moderate']")->filter(".align-middle")->text();
                $article->link = $node->filter("a")->attr('href');
                $article->date = Carbon::parse(str_replace('Uhr', '', $node->filter("[data-auxiliary]")->text()))->format('Y-m-d H:i:s');
                $article->excerpt = $node->filter('[data-target-teaser-el^="text"]')->text();
                $article->image_url = $node->filter('[data-image-el^="img"]')->attr('data-src');
                $article->save();
            });
    }
}
