<?php
require_once 'library/Scanner.php';

$scanner = new Scanner('192.168.10.101');
$printerInfo = $scanner->getPrinterInfo();
?>
<!DOCTYPE HTML>
<html>
    <head>      
        <link href="css/style.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <h1>SNMP Scanner example</h1>
        <!-- Printer info -->
        <table>
            <?php foreach($printerInfo as $key => $value):?>
            <tr>
                <td><b><?php echo $key;?></b></td>
                <td>: <?php echo $value;?></td>
            </tr>
            <?php endforeach;?>             
        </table> 
        <!-- Toner level info -->
        <h3>Toner remain:</h3>
        <table>
            <tr>
                <td class="black">Black</td>
                <td><?php echo $scanner->getBlackTonerLevel();?> %</td>
            </tr> 
            <tr>
                <td class="cyan">Cyan</td>
                <td><?php echo $scanner->getCyanTonerLevel();?> %</td>
            </tr> 
            <tr>
                <td class="magenta">Magenta</td>
                <td><?php echo $scanner->getMagentaTonerLevel();?> %</td>
            </tr> 
             <tr>
                <td class="yellow">Yellow</td>
                <td><?php echo $scanner->getYellowTonerLevel();?> %</td>
            </tr> 
        </table>
        <!-- Drumkit level info -->
        <h3>Drumkit remain:</h3>
        <table>
            <tr>
                <td class="black">Black</td>
                <td><?php echo $scanner->getBlackDrumLevel();?> %</td>
            </tr> 
            <tr>
                <td class="cyan">Cyan</td>
                <td><?php echo $scanner->getCyanDrumLevel();?> %</td>
            </tr> 
            <tr>
                <td class="magenta">Magenta</td>
                <td><?php echo $scanner->getMagentaDrumLevel();?> %</td>
            </tr> 
             <tr>
                <td class="yellow">Yellow</td>
                <td><?php echo $scanner->getYellowDrumLevel();?> %</td>
            </tr> 
        </table>
    </body>
</html>