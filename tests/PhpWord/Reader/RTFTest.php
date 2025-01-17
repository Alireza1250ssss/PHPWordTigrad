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

namespace Alireza1250ssss\PhpWord\Reader;

use Alireza1250ssss\PhpWord\IOFactory;

/**
 * Test class for Alireza1250ssss\PhpWord\Reader\RTF
 *
 * @coversDefaultClass \Alireza1250ssss\PhpWord\Reader\RTF
 * @runTestsInSeparateProcesses
 */
class RTFTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test load
     */
    public function testLoad()
    {
        $filename = __DIR__ . '/../_files/documents/reader.rtf';
        $phpWord = IOFactory::load($filename, 'RTF');
        $this->assertInstanceOf('Alireza1250ssss\\PhpWord\\PhpWord', $phpWord);
    }

    /**
     * Test load exception
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Cannot read
     */
    public function testLoadException()
    {
        $filename = __DIR__ . '/../_files/documents/foo.rtf';
        IOFactory::load($filename, 'RTF');
    }
}
