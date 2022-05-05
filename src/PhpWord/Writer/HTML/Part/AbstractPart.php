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

namespace Alireza1250ssss\PhpWord\Writer\HTML\Part;

use Laminas\Escaper\Escaper;
use Alireza1250ssss\PhpWord\Exception\Exception;
use Alireza1250ssss\PhpWord\Writer\AbstractWriter;

/**
 * @since 0.11.0
 */
abstract class AbstractPart
{
    /**
     * @var \Alireza1250ssss\PhpWord\Writer\AbstractWriter
     */
    private $parentWriter;

    /**
     * @var \Laminas\Escaper\Escaper
     */
    protected $escaper;

    public function __construct()
    {
        $this->escaper = new Escaper();
    }

    /**
     * @return string
     */
    abstract public function write();

    /**
     * @param \Alireza1250ssss\PhpWord\Writer\AbstractWriter $writer
     */
    public function setParentWriter(AbstractWriter $writer = null)
    {
        $this->parentWriter = $writer;
    }

    /**
     * @throws \Alireza1250ssss\PhpWord\Exception\Exception
     *
     * @return \Alireza1250ssss\PhpWord\Writer\AbstractWriter
     */
    public function getParentWriter()
    {
        if ($this->parentWriter !== null) {
            return $this->parentWriter;
        }
        throw new Exception('No parent WriterInterface assigned.');
    }
}
