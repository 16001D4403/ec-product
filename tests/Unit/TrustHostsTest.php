<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Middleware\TrustHosts;

class TrustHostsTest extends TestCase
{
    /** @test */
    public function it_returns_correct_trusted_hosts()
    {
        $app = app();
        $trustHosts = new TrustHosts($app);

        $trustedHosts = $trustHosts->hosts();

        $this->assertIsArray($trustedHosts);
        $this->assertCount(1, $trustedHosts);
        $this->assertEquals(['^(.+\.)?localhost$'], $trustedHosts); // Updated expected value
    }
}
