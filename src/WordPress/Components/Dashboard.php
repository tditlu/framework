<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\WordPress\Components;

use WordPlate\Exceptions\InvalidConfigTypeException;

/**
 * This is the dashboard component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Dashboard extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function register()
    {
        $this->action->add('wp_dashboard_setup', [$this, 'setup']);
    }

    /**
     * Remove unwanted dashboard widgets.
     *
     * @throws \WordPlate\Exceptions\InvalidConfigTypeException
     *
     * @return void
     */
    public function setup()
    {
        global $wp_meta_boxes;

        $positions = config('dashboard.widgets');

        if (!is_array($positions)) {
            throw new InvalidConfigTypeException('dashboard.widgets', 'array');
        }

        foreach ($positions as $position => $boxes) {
            foreach ($boxes as $box) {
                unset($wp_meta_boxes['dashboard'][$position]['core'][$box]);
            }
        }
    }
}
