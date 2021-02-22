<?php

namespace adamCameron\myApp\test\functional;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ExampleComTest extends TestCase
{
    /** @coversNothing */
    public function testExampleDotComReturnsExpectedContent()
    {
        $expectedContent = "Example Domain";


        $client = new Client([
            'base_uri' => 'http://example.com/'
        ]);

        $response = $client->get('index.html');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $html = $response->getBody();
        $document = new \DOMDocument();
        $document->loadHTML($html);

        $xpathDocument = new \DOMXPath($document);

        $hasTitle = $xpathDocument->query('/html/head/title[text() = "' . $expectedContent . '"]');
        $this->assertCount(1, $hasTitle);

        $hasHeading = $xpathDocument->query('/html/body/div/h1[text() = "' . $expectedContent . '"]');
        $this->assertCount(1, $hasHeading);
    }
}
