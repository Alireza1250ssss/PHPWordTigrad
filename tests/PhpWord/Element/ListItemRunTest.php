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
 * Test class for Alireza1250ssss\PhpWord\Element\ListItemRun
 *
 * @runTestsInSeparateProcesses
 */
class ListItemRunTest extends \PHPUnit\Framework\TestCase
{
    /**
     * New instance
     */
    public function testConstruct()
    {
        $oListItemRun = new ListItemRun();

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\ListItemRun', $oListItemRun);
        $this->assertCount(0, $oListItemRun->getElements());
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Paragraph', $oListItemRun->getParagraphStyle());
    }

    /**
     * New instance with string
     */
    public function testConstructString()
    {
        $oListItemRun = new ListItemRun(0, null, 'pStyle');

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\ListItemRun', $oListItemRun);
        $this->assertCount(0, $oListItemRun->getElements());
        $this->assertEquals('pStyle', $oListItemRun->getParagraphStyle());
    }

    /**
     * New instance with string
     */
    public function testConstructListString()
    {
        $oListItemRun = new ListItemRun(0, 'numberingStyle');

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\ListItemRun', $oListItemRun);
        $this->assertCount(0, $oListItemRun->getElements());
    }

    /**
     * New instance with array
     */
    public function testConstructArray()
    {
        $oListItemRun = new ListItemRun(0, null, array('spacing' => 100));

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\ListItemRun', $oListItemRun);
        $this->assertCount(0, $oListItemRun->getElements());
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\Paragraph', $oListItemRun->getParagraphStyle());
    }

    /**
     * Get style
     */
    public function testStyle()
    {
        $oListItemRun = new ListItemRun(1, array('listType' => \Alireza1250ssss\PhpWord\Style\ListItem::TYPE_NUMBER));

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Style\\ListItem', $oListItemRun->getStyle());
        $this->assertEquals(\Alireza1250ssss\PhpWord\Style\ListItem::TYPE_NUMBER, $oListItemRun->getStyle()->getListType());
    }

    /**
     * getDepth
     */
    public function testDepth()
    {
        $iVal = rand(1, 1000);
        $oListItemRun = new ListItemRun($iVal);

        $this->assertEquals($iVal, $oListItemRun->getDepth());
    }

    /**
     * Add text
     */
    public function testAddText()
    {
        $oListItemRun = new ListItemRun();
        $element = $oListItemRun->addText('text');

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\Text', $element);
        $this->assertCount(1, $oListItemRun->getElements());
        $this->assertEquals('text', $element->getText());
    }

    /**
     * Add text non-UTF8
     */
    public function testAddTextNotUTF8()
    {
        $oListItemRun = new ListItemRun();
        $element = $oListItemRun->addText(utf8_decode('ééé'));

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\Text', $element);
        $this->assertCount(1, $oListItemRun->getElements());
        $this->assertEquals('ééé', $element->getText());
    }

    /**
     * Add link
     */
    public function testAddLink()
    {
        $oListItemRun = new ListItemRun();
        $element = $oListItemRun->addLink('https://github.com/PHPOffice/PHPWord');

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\Link', $element);
        $this->assertCount(1, $oListItemRun->getElements());
        $this->assertEquals('https://github.com/PHPOffice/PHPWord', $element->getSource());
    }

    /**
     * Add link with name
     */
    public function testAddLinkWithName()
    {
        $oListItemRun = new ListItemRun();
        $element = $oListItemRun->addLink('https://github.com/PHPOffice/PHPWord', 'PHPWord on GitHub');

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\Link', $element);
        $this->assertCount(1, $oListItemRun->getElements());
        $this->assertEquals('https://github.com/PHPOffice/PHPWord', $element->getSource());
        $this->assertEquals('PHPWord on GitHub', $element->getText());
    }

    /**
     * Add text break
     */
    public function testAddTextBreak()
    {
        $oListItemRun = new ListItemRun();
        $oListItemRun->addTextBreak(2);

        $this->assertCount(2, $oListItemRun->getElements());
    }

    /**
     * Add image
     */
    public function testAddImage()
    {
        $src = __DIR__ . '/../_files/images/earth.jpg';

        $oListItemRun = new ListItemRun();
        $element = $oListItemRun->addImage($src);

        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\Element\\Image', $element);
        $this->assertCount(1, $oListItemRun->getElements());
    }
}
