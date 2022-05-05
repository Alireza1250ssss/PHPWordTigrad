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

namespace Alireza1250ssss\PhpWord\Writer\RTF;

use Alireza1250ssss\PhpWord\Writer\RTF;

/**
 * Test class for Alireza1250ssss\PhpWord\Writer\RTF\Element subnamespace
 */
class ElementTest extends \PHPUnit\Framework\TestCase
{
    public function removeCr($field)
    {
        return str_replace("\r\n", "\n", $field->write());
    }

    /**
     * Test unmatched elements
     */
    public function testUnmatchedElements()
    {
        $elements = array('Container', 'Text', 'Title', 'Link', 'Image', 'Table', 'Field');
        foreach ($elements as $element) {
            $objectClass = 'Alireza1250ssss\\PhpWord\\Writer\\RTF\\Element\\' . $element;
            $parentWriter = new RTF();
            $newElement = new \Alireza1250ssss\PhpWord\Element\PageBreak();
            $object = new $objectClass($parentWriter, $newElement);

            $this->assertEquals('', $object->write());
        }
    }

    public function testPageField()
    {
        $parentWriter = new RTF();
        $element = new \Alireza1250ssss\PhpWord\Element\Field('PAGE');
        $field = new \Alireza1250ssss\PhpWord\Writer\RTF\Element\Field($parentWriter, $element);

        $this->assertEquals("{\\field{\\*\\fldinst PAGE}{\\fldrslt}}\\par\n", $this->removeCr($field));
    }

    public function testNumpageField()
    {
        $parentWriter = new RTF();
        $element = new \Alireza1250ssss\PhpWord\Element\Field('NUMPAGES');
        $field = new \Alireza1250ssss\PhpWord\Writer\RTF\Element\Field($parentWriter, $element);

        $this->assertEquals("{\\field{\\*\\fldinst NUMPAGES}{\\fldrslt}}\\par\n", $this->removeCr($field));
    }

    public function testDateField()
    {
        $parentWriter = new RTF();
        $element = new \Alireza1250ssss\PhpWord\Element\Field('DATE', array('dateformat' => 'd MM yyyy H:mm:ss'));
        $field = new \Alireza1250ssss\PhpWord\Writer\RTF\Element\Field($parentWriter, $element);

        $this->assertEquals("{\\field{\\*\\fldinst DATE \\\\@ \"d MM yyyy H:mm:ss\"}{\\fldrslt}}\\par\n", $this->removeCr($field));
    }

    public function testIndexField()
    {
        $parentWriter = new RTF();
        $element = new \Alireza1250ssss\PhpWord\Element\Field('INDEX');
        $field = new \Alireza1250ssss\PhpWord\Writer\RTF\Element\Field($parentWriter, $element);

        $this->assertEquals("{}\\par\n", $this->removeCr($field));
    }

    public function testTable()
    {
        $parentWriter = new RTF();
        $element = new \Alireza1250ssss\PhpWord\Element\Table();
        $width = 100;
        $width2 = 2 * $width;
        $element->addRow();
        $tce = $element->addCell($width);
        $tce->addText('1');
        $tce = $element->addCell($width);
        $tce->addText('2');
        $element->addRow();
        $tce = $element->addCell($width);
        $tce->addText('3');
        $tce = $element->addCell($width);
        $tce->addText('4');
        $table = new \Alireza1250ssss\PhpWord\Writer\RTF\Element\Table($parentWriter, $element);
        $expect = implode("\n", array(
            '\\pard',
            "\\trowd \\cellx$width \\cellx$width2 ",
            '\\intbl',
            '{\\cf0\\f0 1}\\par',
            '\\cell',
            '\\intbl',
            '{\\cf0\\f0 2}\\par',
            '\\cell',
            '\\row',
            "\\trowd \\cellx$width \\cellx$width2 ",
            '\\intbl',
            '{\\cf0\\f0 3}\\par',
            '\\cell',
            '\\intbl',
            '{\\cf0\\f0 4}\par',
            '\\cell',
            '\\row',
            '\\pard',
            '',
            ));

        $this->assertEquals($expect, $this->removeCr($table));
    }

    public function testTextRun()
    {
        $parentWriter = new RTF();
        $element = new \Alireza1250ssss\PhpWord\Element\TextRun();
        $element->addText('Hello ');
        $element->addText('there.');
        $textrun = new \Alireza1250ssss\PhpWord\Writer\RTF\Element\TextRun($parentWriter, $element);
        $expect = "\\pard\\nowidctlpar {{\\cf0\\f0 Hello }{\\cf0\\f0 there.}}\\par\n";
        $this->assertEquals($expect, $this->removeCr($textrun));
    }

    public function testTextRunParagraphStyle()
    {
        $parentWriter = new RTF();
        $element = new \Alireza1250ssss\PhpWord\Element\TextRun(array('spaceBefore' => 0, 'spaceAfter' => 0));
        $element->addText('Hello ');
        $element->addText('there.');
        $textrun = new \Alireza1250ssss\PhpWord\Writer\RTF\Element\TextRun($parentWriter, $element);
        $expect = "\\pard\\nowidctlpar \\sb0\\sa0{{\\cf0\\f0 Hello }{\\cf0\\f0 there.}}\\par\n";
        $this->assertEquals($expect, $this->removeCr($textrun));
    }

    public function testTitle()
    {
        $parentWriter = new RTF();
        $phpWord = new \Alireza1250ssss\PhpWord\PhpWord();
        $phpWord->addTitleStyle(1, array(), array('spaceBefore' => 0, 'spaceAfter' => 0));
        $section = $phpWord->addSection();
        $element = $section->addTitle('First Heading', 1);
        $elwrite = new \Alireza1250ssss\PhpWord\Writer\RTF\Element\Title($parentWriter, $element);
        $expect = "\\pard\\nowidctlpar \\sb0\\sa0{\\outlinelevel0{\\cf0\\f0 First Heading}\\par\n}";
        $this->assertEquals($expect, $this->removeCr($elwrite));
    }
}
