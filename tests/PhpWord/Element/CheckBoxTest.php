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
 * Test class for Alireza1250ssss\PhpWord\Element\CheckBox
 *
 * @runTestsInSeparateProcesses
 */
class CheckBoxTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Construct
     */
    public function testConstruct()
    {
        $oCheckBox = new CheckBox();

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\CheckBox', $oCheckBox);
        $this->assertNull($oCheckBox->getText());
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Font', $oCheckBox->getFontStyle());
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Paragraph', $oCheckBox->getParagraphStyle());
    }

    /**
     * Get name and text
     */
    public function testCheckBox()
    {
        $oCheckBox = new CheckBox('chkBox', 'CheckBox');

        $this->assertEquals('chkBox', $oCheckBox->getName());
        $this->assertEquals('CheckBox', $oCheckBox->getText());
    }

    /**
     * Get font style
     */
    public function testFont()
    {
        $oCheckBox = new CheckBox('chkBox', 'CheckBox', 'fontStyle');
        $this->assertEquals('fontStyle', $oCheckBox->getFontStyle());

        $oCheckBox->setFontStyle(array('bold' => true, 'italic' => true, 'size' => 16));
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Font', $oCheckBox->getFontStyle());
    }

    /**
     * Font style as object
     */
    public function testFontObject()
    {
        $font = new Font();
        $oCheckBox = new CheckBox('chkBox', 'CheckBox', $font);
        $this->assertEquals($font, $oCheckBox->getFontStyle());
    }

    /**
     * Get paragraph style
     */
    public function testParagraph()
    {
        $oCheckBox = new CheckBox('chkBox', 'CheckBox', 'fontStyle', 'paragraphStyle');
        $this->assertEquals('paragraphStyle', $oCheckBox->getParagraphStyle());

        $oCheckBox->setParagraphStyle(array('alignment' => Jc::CENTER, 'spaceAfter' => 100));
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Paragraph', $oCheckBox->getParagraphStyle());
    }
}
