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

namespace Alireza1250ssss\PhpWord\Writer\RTF\Element;

use Alireza1250ssss\PhpWord\Element\AbstractElement as Element;
use Alireza1250ssss\PhpWord\Escaper\Rtf;
use Alireza1250ssss\PhpWord\Settings;
use Alireza1250ssss\PhpWord\Shared\Text as SharedText;
use Alireza1250ssss\PhpWord\Style;
use Alireza1250ssss\PhpWord\Style\Font as FontStyle;
use Alireza1250ssss\PhpWord\Style\Paragraph as ParagraphStyle;
use Alireza1250ssss\PhpWord\Writer\AbstractWriter;
use Alireza1250ssss\PhpWord\Writer\HTML\Element\AbstractElement as HTMLAbstractElement;
use Alireza1250ssss\PhpWord\Writer\RTF\Style\Font as FontStyleWriter;
use Alireza1250ssss\PhpWord\Writer\RTF\Style\Paragraph as ParagraphStyleWriter;

/**
 * Abstract RTF element writer
 *
 * @since 0.11.0
 */
abstract class AbstractElement extends HTMLAbstractElement
{
    /**
     * Font style
     *
     * @var \Alireza1250ssss\PhpWord\Style\Font
     */
    protected $fontStyle;

    /**
     * Paragraph style
     *
     * @var \Alireza1250ssss\PhpWord\Style\Paragraph
     */
    protected $paragraphStyle;

    public function __construct(AbstractWriter $parentWriter, Element $element, $withoutP = false)
    {
        parent::__construct($parentWriter, $element, $withoutP);

        $this->escaper = new Rtf();
    }

    /**
     * Get font and paragraph styles.
     */
    protected function getStyles()
    {
        /** @var \Alireza1250ssss\PhpWord\Writer\RTF $parentWriter Type hint */
        $parentWriter = $this->parentWriter;

        /** @var \Alireza1250ssss\PhpWord\Element\Text $element Type hint */
        $element = $this->element;

        // Font style
        if (method_exists($element, 'getFontStyle')) {
            $this->fontStyle = $element->getFontStyle();
            if (is_string($this->fontStyle)) {
                $this->fontStyle = Style::getStyle($this->fontStyle);
            }
        }

        // Paragraph style
        if (method_exists($element, 'getParagraphStyle')) {
            $this->paragraphStyle = $element->getParagraphStyle();
            if (is_string($this->paragraphStyle)) {
                $this->paragraphStyle = Style::getStyle($this->paragraphStyle);
            }

            if ($this->paragraphStyle !== null && !$this->withoutP) {
                if ($parentWriter->getLastParagraphStyle() != $element->getParagraphStyle()) {
                    $parentWriter->setLastParagraphStyle($element->getParagraphStyle());
                } else {
                    $parentWriter->setLastParagraphStyle();
                    $this->paragraphStyle = null;
                }
            } else {
                $parentWriter->setLastParagraphStyle();
                $this->paragraphStyle = null;
            }
        }
    }

    /**
     * Write opening
     *
     * @return string
     */
    protected function writeOpening()
    {
        if ($this->withoutP || !$this->paragraphStyle instanceof ParagraphStyle) {
            return '';
        }

        $styleWriter = new ParagraphStyleWriter($this->paragraphStyle);
        $styleWriter->setNestedLevel($this->element->getNestedLevel());

        return $styleWriter->write();
    }

    /**
     * Write text
     *
     * @param string $text
     * @return string
     */
    protected function writeText($text)
    {
        if (Settings::isOutputEscapingEnabled()) {
            return $this->escaper->escape($text);
        }

        return SharedText::toUnicode($text); // todo: replace with `return $text;` later.
    }

    /**
     * Write closing
     *
     * @return string
     */
    protected function writeClosing()
    {
        if ($this->withoutP) {
            return '';
        }

        return '\par' . PHP_EOL;
    }

    /**
     * Write font style
     *
     * @return string
     */
    protected function writeFontStyle()
    {
        if (!$this->fontStyle instanceof FontStyle) {
            return '';
        }

        /** @var \Alireza1250ssss\PhpWord\Writer\RTF $parentWriter Type hint */
        $parentWriter = $this->parentWriter;

        // Create style writer and set color/name index
        $styleWriter = new FontStyleWriter($this->fontStyle);
        if ($this->fontStyle->getColor() != null) {
            $colorIndex = array_search($this->fontStyle->getColor(), $parentWriter->getColorTable());
            if ($colorIndex !== false) {
                $styleWriter->setColorIndex($colorIndex + 1);
            }
        }
        if ($this->fontStyle->getName() != null) {
            $fontIndex = array_search($this->fontStyle->getName(), $parentWriter->getFontTable());
            if ($fontIndex !== false) {
                $styleWriter->setNameIndex($fontIndex);
            }
        }

        // Write style
        $content = $styleWriter->write();

        return $content;
    }
}
