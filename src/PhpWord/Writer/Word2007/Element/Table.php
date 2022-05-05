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

namespace Alireza1250ssss\PhpWord\Writer\Word2007\Element;

use Alireza1250ssss\PhpWord\Element\Cell as CellElement;
use Alireza1250ssss\PhpWord\Element\Row as RowElement;
use Alireza1250ssss\PhpWord\Element\Table as TableElement;
use Alireza1250ssss\PhpWord\Shared\XMLWriter;
use Alireza1250ssss\PhpWord\Style\Cell as CellStyle;
use Alireza1250ssss\PhpWord\Style\Row as RowStyle;
use Alireza1250ssss\PhpWord\Writer\Word2007\Style\Cell as CellStyleWriter;
use Alireza1250ssss\PhpWord\Writer\Word2007\Style\Row as RowStyleWriter;
use Alireza1250ssss\PhpWord\Writer\Word2007\Style\Table as TableStyleWriter;

/**
 * Table element writer
 *
 * @since 0.10.0
 */
class Table extends AbstractElement
{
    /**
     * Write element.
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();
        $element = $this->getElement();
        if (!$element instanceof TableElement) {
            return;
        }

        $rows = $element->getRows();
        $rowCount = count($rows);

        if ($rowCount > 0) {
            $xmlWriter->startElement('w:tbl');

            // Write columns
            $this->writeColumns($xmlWriter, $element);

            // Write style
            $styleWriter = new TableStyleWriter($xmlWriter, $element->getStyle());
            $styleWriter->setWidth($element->getWidth());
            $styleWriter->write();

            // Write rows
            for ($i = 0; $i < $rowCount; $i++) {
                $this->writeRow($xmlWriter, $rows[$i]);
            }

            $xmlWriter->endElement(); // w:tbl
        }
    }

    /**
     * Write column.
     *
     * @param \Alireza1250ssss\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \Alireza1250ssss\PhpWord\Element\Table $element
     */
    private function writeColumns(XMLWriter $xmlWriter, TableElement $element)
    {
        $cellWidths = $element->findFirstDefinedCellWidths();

        $xmlWriter->startElement('w:tblGrid');
        foreach ($cellWidths as $width) {
            $xmlWriter->startElement('w:gridCol');
            if ($width !== null) {
                $xmlWriter->writeAttribute('w:w', $width);
                $xmlWriter->writeAttribute('w:type', 'dxa');
            }
            $xmlWriter->endElement();
        }
        $xmlWriter->endElement(); // w:tblGrid
    }

    /**
     * Write row.
     *
     * @param \Alireza1250ssss\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \Alireza1250ssss\PhpWord\Element\Row $row
     */
    private function writeRow(XMLWriter $xmlWriter, RowElement $row)
    {
        $xmlWriter->startElement('w:tr');

        // Write style
        $rowStyle = $row->getStyle();
        if ($rowStyle instanceof RowStyle) {
            $styleWriter = new RowStyleWriter($xmlWriter, $rowStyle);
            $styleWriter->setHeight($row->getHeight());
            $styleWriter->write();
        }

        // Write cells
        foreach ($row->getCells() as $cell) {
            $this->writeCell($xmlWriter, $cell);
        }

        $xmlWriter->endElement(); // w:tr
    }

    /**
     * Write cell.
     *
     * @param \Alireza1250ssss\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \Alireza1250ssss\PhpWord\Element\Cell $cell
     */
    private function writeCell(XMLWriter $xmlWriter, CellElement $cell)
    {
        $xmlWriter->startElement('w:tc');

        // Write style
        $cellStyle = $cell->getStyle();
        if ($cellStyle instanceof CellStyle) {
            $styleWriter = new CellStyleWriter($xmlWriter, $cellStyle);
            $styleWriter->setWidth($cell->getWidth());
            $styleWriter->write();
        }

        // Write content
        $containerWriter = new Container($xmlWriter, $cell);
        $containerWriter->write();

        $xmlWriter->endElement(); // w:tc
    }
}
