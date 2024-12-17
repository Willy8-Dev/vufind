<?php

/**
 * Trait for tests involving Laminas Translator.
 *
 * PHP version 8
 *
 * Copyright (C) Villanova University 2010-2023.
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

namespace VuFindTest\Feature;

use Laminas\Mvc\I18n\Translator;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Trait for tests involving Laminas Translator.
 *
 * @category VuFind
 * @package  Tests
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development:testing:unit_tests Wiki
 */
trait TranslatorTrait
{
    /**
     * Get mock translator.
     *
     * @param array  $translations Key => value translation map.
     * @param string $locale       Locale, default to 'en'
     *
     * @return MockObject&Translator
     */
    protected function getMockTranslator(array $translations, string $locale = 'en'): MockObject&Translator
    {
        $callback = function ($str, $domain) use ($translations) {
            return $translations[$domain][$str] ?? $str;
        };
        $translator = $this->getMockBuilder(Translator::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['translate'])
            ->addMethods(['getLocale'])
            ->getMock();
        $translator->expects($this->any())->method('translate')->willReturnCallback($callback);
        $translator->expects($this->any())->method('getLocale')->willReturn($locale);
        return $translator;
    }
}
