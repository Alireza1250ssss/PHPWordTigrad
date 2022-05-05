<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace Alireza1250ssss\PhpWord\Writer\Word2007\Style;

use Alireza1250ssss\PhpWord\Settings;
use Alireza1250ssss\PhpWord\TestHelperDOCX;

/**
 * Test class for Alireza1250ssss\PhpWord\Writer\Word2007\Style\Section
 *
 * @coversDefaultClass \Alireza1250ssss\PhpWord\Writer\Word2007\Style\Section
 * @runTestsInSeparateProcesses
 */
class SectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Executed before each method of the class
     */
    public function tearDown()
    {
        TestHelperDOCX::clear();
    }

    public function testMarginInInches()
    {
        $unit = Settings::getMeasurementUnit();
        Settings::setMeasurementUnit(\Alireza1250ssss\PhpWord\Settings::UNIT_INCH);

        $phpWord = new \Alireza1250ssss\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->getStyle()->setMarginTop(0.1)->setMarginBottom(0.4)->setMarginLeft(0.2)->setMarginRight(0.3);
        $section->addText('test');
        $doc = TestHelperDOCX::getDocument($phpWord, 'Word2007');
        Settings::setMeasurementUnit($unit);

        $path = '/w:document/w:body/w:sectPr/w:pgMar';
        $this->assertEquals('144', $doc->getElementAttribute($path, 'w:top'));
        $this->assertEquals('432', $doc->getElementAttribute($path, 'w:right'));
        $this->assertEquals('576', $doc->getElementAttribute($path, 'w:bottom'));
        $this->assertEquals('288', $doc->getElementAttribute($path, 'w:left'));
    }
}
