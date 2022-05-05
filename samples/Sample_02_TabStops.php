<?php
include_once 'Sample_Header.php';

// New Word Document
echo date('H:i:s'), ' Create new PhpWord object', EOL;
$phpWord = new \Alireza1250ssss\PhpWord\PhpWord();

// Define styles
$multipleTabsStyleName = 'multipleTab';
$phpWord->addParagraphStyle(
    $multipleTabsStyleName,
    array(
        'tabs' => array(
            new \Alireza1250ssss\PhpWord\Style\Tab('left', 1550),
            new \Alireza1250ssss\PhpWord\Style\Tab('center', 3200),
            new \Alireza1250ssss\PhpWord\Style\Tab('right', 5300),
        ),
    )
);

$rightTabStyleName = 'rightTab';
$phpWord->addParagraphStyle($rightTabStyleName, array('tabs' => array(new \Alireza1250ssss\PhpWord\Style\Tab('right', 9090))));

$leftTabStyleName = 'centerTab';
$phpWord->addParagraphStyle($leftTabStyleName, array('tabs' => array(new \Alireza1250ssss\PhpWord\Style\Tab('center', 4680))));

// New portrait section
$section = $phpWord->addSection();

// Add listitem elements
$section->addText("Multiple Tabs:\tOne\tTwo\tThree", null, $multipleTabsStyleName);
$section->addText("Left Aligned\tRight Aligned", null, $rightTabStyleName);
$section->addText("\tCenter Aligned", null, $leftTabStyleName);

// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writers);
if (!CLI) {
    include_once 'Sample_Footer.php';
}
