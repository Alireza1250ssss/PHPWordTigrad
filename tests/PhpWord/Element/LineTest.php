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

namespace Alireza1250ssss\PhpWord\Element;

/**
 * Test class for Alireza1250ssss\PhpWord\Element\Line
 *
 * @coversDefaultClass \Alireza1250ssss\PhpWord\Element\Line
 * @runTestsInSeparateProcesses
 */
class LineTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Create new instance
     */
    public function testConstruct()
    {
        $oLine = new Line();

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\Line', $oLine);
        $this->assertNull($oLine->getStyle());
    }

    /**
     * Get style name
     */
    public function testStyleText()
    {
        $oLine = new Line('lineStyle');

        $this->assertEquals('lineStyle', $oLine->getStyle());
    }

    /**
     * Get style array
     */
    public function testStyleArray()
    {
        $oLine = new Line(
            array(
                'width'            => \Alireza1250ssss\PhpWord\Shared\Converter::cmToPixel(14),
                'height'           => \Alireza1250ssss\PhpWord\Shared\Converter::cmToPixel(4),
                'positioning'      => 'absolute',
                'posHorizontalRel' => 'page',
                'posVerticalRel'   => 'page',
                'flip'             => true,
                'marginLeft'       => \Alireza1250ssss\PhpWord\Shared\Converter::cmToPixel(5),
                'marginTop'        => \Alireza1250ssss\PhpWord\Shared\Converter::cmToPixel(3),
                'wrappingStyle'    => \Alireza1250ssss\PhpWord\Style\Image::WRAPPING_STYLE_SQUARE,
                'beginArrow'       => \Alireza1250ssss\PhpWord\Style\Line::ARROW_STYLE_BLOCK,
                'endArrow'         => \Alireza1250ssss\PhpWord\Style\Line::ARROW_STYLE_OVAL,
                'dash'             => \Alireza1250ssss\PhpWord\Style\Line::DASH_STYLE_LONG_DASH_DOT_DOT,
                'weight'           => 10,
            )
        );

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Line', $oLine->getStyle());
    }
}
