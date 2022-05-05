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

use Alireza1250ssss\PhpWord\Element\Footer;
use Alireza1250ssss\PhpWord\Writer\RTF;

/**
 * Test class for Alireza1250ssss\PhpWord\Writer\RTF\Element subnamespace
 */
class HeaderFooterTest extends \PHPUnit\Framework\TestCase
{
    public function testNoHeaderNoFooter()
    {
        $phpWord = new \Alireza1250ssss\PhpWord\PhpWord();
        $parentWriter = new RTF($phpWord);
        $section = $phpWord->addSection();
        $section->addText('Doc without header or footer');
        $contents = $parentWriter->getWriterPart('Document')->write();
        $this->assertEquals(0, preg_match('/\\\\header[rlf]?\\b/', $contents));
        $this->assertEquals(0, preg_match('/\\\\footer[rlf]?\\b/', $contents));
        $this->assertEquals(0, preg_match('/\\\\titlepg\\b/', $contents));
        $this->assertEquals(0, preg_match('/\\\\facingp\\b/', $contents));
    }

    public function testNoHeaderYesFooter()
    {
        $phpWord = new \Alireza1250ssss\PhpWord\PhpWord();
        $parentWriter = new RTF($phpWord);
        $section = $phpWord->addSection();
        $footer = $section->addFooter();
        $footer->addText('Auto footer');
        $section->addText('Doc without header but with footer');
        $contents = $parentWriter->getWriterPart('Document')->write();
        $this->assertEquals(0, preg_match('/\\\\header[rlf]?\\b/', $contents));
        $this->assertEquals(1, preg_match('/\\\\footer[rlf]?\\b/', $contents));
        $this->assertEquals(0, preg_match('/\\\\titlepg\\b/', $contents));
        $this->assertEquals(0, preg_match('/\\\\facingp\\b/', $contents));
    }

    public function testEvenHeaderFirstFooter()
    {
        $phpWord = new \Alireza1250ssss\PhpWord\PhpWord();
        $phpWord->getSettings()->setEvenAndOddHeaders(true);
        $parentWriter = new RTF($phpWord);
        $section = $phpWord->addSection();
        $footer = $section->addFooter(Footer::FIRST);
        $footer->addText('First footer');
        $footer = $section->addHeader(Footer::EVEN);
        $footer->addText('Even footer');
        $footer = $section->addHeader(Footer::AUTO);
        $footer->addText('Odd footer');
        $section->addText('Doc with even/odd header and first footer');
        $contents = $parentWriter->getWriterPart('Document')->write();
        $this->assertEquals(1, preg_match('/\\\\headerr\\b/', $contents));
        $this->assertEquals(1, preg_match('/\\\\headerl\\b/', $contents));
        $this->assertEquals(0, preg_match('/\\\\header[f]?\\b/', $contents));
        $this->assertEquals(1, preg_match('/\\\\footerf\\b/', $contents));
        $this->assertEquals(0, preg_match('/\\\\footer[rl]?\\b/', $contents));
        $this->assertEquals(1, preg_match('/\\\\titlepg\\b/', $contents));
        $this->assertEquals(1, preg_match('/\\\\facingp\\b/', $contents));
    }
}
