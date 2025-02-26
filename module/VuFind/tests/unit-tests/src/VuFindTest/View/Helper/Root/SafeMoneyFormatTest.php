<?php

/**
 * SafeMoneyFormat view helper Test Class
 *
 * PHP version 8
 *
 * Copyright (C) Villanova University 2010.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category VuFind
 * @package  Tests
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development:testing:unit_tests Wiki
 */

namespace VuFindTest\View\Helper\Root;

use VuFind\View\Helper\Root\SafeMoneyFormat;

/**
 * SafeMoneyFormat view helper Test Class
 *
 * @category VuFind
 * @package  Tests
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development:testing:unit_tests Wiki
 */
class SafeMoneyFormatTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test the helper
     *
     * @return void
     */
    public function testFormatting()
    {
        // test default currency in en_US locale
        $smf = new SafeMoneyFormat(
            new \VuFind\Service\CurrencyFormatter(null, 'en_US'),
            new \Laminas\View\Helper\EscapeHtml()
        );
        $this->assertEquals('$3.00', $smf(3));
        $this->assertEquals('€3.00', $smf(3, 'EUR'));

        // test override default currency
        $smf = new SafeMoneyFormat(
            new \VuFind\Service\CurrencyFormatter('EUR', 'en_US'),
            new \Laminas\View\Helper\EscapeHtml()
        );
        $this->assertEquals('€3.00', $smf(3));
        $this->assertEquals('$3.00', $smf(3, 'USD'));
    }
}
