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

namespace Alireza1250ssss\PhpWord\Writer\HTML\Element;

use Laminas\Escaper\Escaper;
use Alireza1250ssss\PhpWord\Element\AbstractElement as Element;
use Alireza1250ssss\PhpWord\Writer\AbstractWriter;

/**
 * Abstract HTML element writer
 *
 * @since 0.11.0
 */
abstract class AbstractElement
{
    /**
     * Parent writer
     *
     * @var \Alireza1250ssss\PhpWord\Writer\AbstractWriter
     */
    protected $parentWriter;

    /**
     * Element
     *
     * @var \Alireza1250ssss\PhpWord\Element\AbstractElement
     */
    protected $element;

    /**
     * Without paragraph
     *
     * @var bool
     */
    protected $withoutP = false;

    /**
     * @var \Laminas\Escaper\Escaper|\Alireza1250ssss\PhpWord\Escaper\AbstractEscaper
     */
    protected $escaper;

    /**
     * Write element
     */
    abstract public function write();

    /**
     * Create new instance
     *
     * @param \Alireza1250ssss\PhpWord\Writer\AbstractWriter $parentWriter
     * @param \Alireza1250ssss\PhpWord\Element\AbstractElement $element
     * @param bool $withoutP
     */
    public function __construct(AbstractWriter $parentWriter, Element $element, $withoutP = false)
    {
        $this->parentWriter = $parentWriter;
        $this->element = $element;
        $this->withoutP = $withoutP;
        $this->escaper = new Escaper();
    }

    /**
     * Set without paragraph.
     *
     * @param bool $value
     */
    public function setWithoutP($value)
    {
        $this->withoutP = $value;
    }
}
