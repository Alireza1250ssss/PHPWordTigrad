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

use Alireza1250ssss\PhpWord\SimpleType\Jc;
use Alireza1250ssss\PhpWord\Style\Font;

/**
 * Test class for Alireza1250ssss\PhpWord\Element\Text
 *
 * @runTestsInSeparateProcesses
 */
class TextTest extends \PHPUnit\Framework\TestCase
{
    /**
     * New instance
     */
    public function testConstruct()
    {
        $oText = new Text();

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\Text', $oText);
        $this->assertNull($oText->getText());
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Font', $oText->getFontStyle());
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Paragraph', $oText->getParagraphStyle());
    }

    /**
     * Get text
     */
    public function testText()
    {
        $oText = new Text('text');

        $this->assertEquals('text', $oText->getText());
    }

    /**
     * Get font style
     */
    public function testFont()
    {
        $oText = new Text('text', 'fontStyle');
        $this->assertEquals('fontStyle', $oText->getFontStyle());

        $oText->setFontStyle(array('bold' => true, 'italic' => true, 'size' => 16));
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Font', $oText->getFontStyle());
    }

    /**
     * Get font style as object
     */
    public function testFontObject()
    {
        $font = new Font();
        $oText = new Text('text', $font);
        $this->assertEquals($font, $oText->getFontStyle());
    }

    /**
     * Get paragraph style
     */
    public function testParagraph()
    {
        $oText = new Text('text', 'fontStyle', 'paragraphStyle');
        $this->assertEquals('paragraphStyle', $oText->getParagraphStyle());

        $oText->setParagraphStyle(array('alignment' => Jc::CENTER, 'spaceAfter' => 100));
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Paragraph', $oText->getParagraphStyle());
    }
}
