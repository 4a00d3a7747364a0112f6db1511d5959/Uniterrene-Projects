<?php
include('api/securepay.php');

$sp = new SecurePay('ABC0001','abc123');
var_dump($sp->TestConnection());
if ($sp->TestConnection()) {
    echo "Server is working\n";
} else {
    echo "Server is Down\n";
}

$sp->TestMode(); // Remove this line to actually preform a transaction
//print_r($sp->ResponseXml);

$sp->Cc = '4444333322221111';
$sp->ExpiryDate = '10/20';
$sp->ChargeAmount = 1000;
$sp->ChargeCurrency = 'AUD';
$sp->Cvv = 321;
$sp->OrderId = 'ORD18724';

echo '<pre>';
		print_r($sp);

if ($sp->Valid()) { // Is the above data valid?
    $response = $sp->Process();
    if ($response == SECUREPAY_STATUS_APPROVED) {
        echo "Transaction was a success\n";
    } else {
        echo "Transaction failed with the error code: $response\n";
        echo "XML Dump: " . print_r($sp->ResponseXml,1) . "\n";
    }
} else {
    die("Your data is invalid\n");
}

?>