<?php

namespace MailerLiteApi\Tests;

use MailerLiteApi\MailerLite;

/**
 * Class WebhooksTest
 *
 * @package MailerLiteApi\Tests
 */
class WebhooksTest extends MlTestCase
{
    protected $webhooksApi;

    protected function setUp(): void
    {
        $this->webhooksApi = (new MailerLite(API_KEY))->webhooks();
    }

    /** @test **/
    public function check_webhooks_data()
    {
        $webhooks = $this->webhooksApi->get();

        $this->assertTrue(is_numeric($webhooks[0]->id) && isset($webhooks[0]->event) && isset($webhooks[0]->url));
    }

    /** @test **/
    public function create_webhook()
    {
        $webhook = $this->webhooksApi->create(['url' => 'https://demo.mailerlite.com/test-webhook', 'event' => 'subscriber.create	']);

        $this->assertTrue($webhook->url == 'https://demo.mailerlite.com/test-webhook' && $webhook->event == 'subscriber.create');

        $this->webhooksApi->delete($webhook->id);
    }

}
