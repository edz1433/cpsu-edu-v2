<?php

use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Illuminate\Support\Facades\DB;

class CrawlWebsite extends Command
{
    protected $signature = 'crawl:cpsu';
    protected $description = 'Crawl cpsu.edu.ph content';

    public function handle()
    {
        Crawler::create()
            ->setCrawlObserver(new class extends CrawlObserver {
                public function crawled($url, $response, $foundOnUrl = null) {
                    $content = strip_tags($response->getBody()->getContents());
                    DB::table('contents')->updateOrInsert(
                        ['url' => (string) $url],
                        ['title' => substr($content, 0, 120), 'body' => substr($content, 0, 10000)]
                    );
                }
            })
            ->startCrawling('https://cpsu.edu.ph');
    }
}
