<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests;

use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;

/**
 * This is the helpers test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HelpersTest extends AbstractTestCase
{
    public function testAcfHideOnScreen()
    {
        $items = acf_hide_on_screen(['great', 'scott']);
        $this->assertSame([0 => 'great', 1 => 'scott'], $items);
    }

    public function testAcfLocationQuery()
    {
        $location = acf_location_query('post_type', '==', 'mcfly');
        $this->assertSame(['param' => 'post_type', 'operator' => '==', 'value' => 'mcfly'], $location);
    }

    public function testBrowser()
    {
        $this->assertInstanceOf(Browser::class, browser());
        $this->assertSame(Browser::UNKNOWN, browser()->getName());
    }

    public function testEnv()
    {
        $this->assertSame('testing', env('WP_ENV'));
        putenv('WP_THEME=marty');
        $this->assertSame('marty', env('WP_THEME'));
        $this->assertSame('mcfly', env('WP_DEBUG', 'mcfly'));
    }

    public function testOs()
    {
        $this->assertInstanceOf(Os::class, os());
        $this->assertSame(Os::UNKNOWN, os()->getName());
    }
}