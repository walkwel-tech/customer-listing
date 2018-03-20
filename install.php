<?php
require_once 'includes/config.php';
require_once 'includes/initialize.php';
// Only to Create and Insert Records into Customers Table

if (Customer::createTable() && !Customer::countAll()) {
    $tableCreated  = true;
    $tableInserted = true;

    // Insert some Records too
    $customers = [];

    for ($counter =0; $counter < 50; $counter++) {
        $lastName = ucwords(getRandomString(5));
        $street   = ucwords(getRandomString(8));
        $city     = ucwords(getRandomString(5));
        $state    = ucwords(getRandomString(2));
        $zip      = rand(10000, 99999);

        $customer      = Customer::make('Customer', $lastName, $street, $city, $state, $zip);
        $tableInserted = $tableInserted && $customer->save();
    }
} else {
    $tableCreated  = false;
    $tableInserted = false;
}

echo ($tableCreated) ? 'Table Created' : 'NOT Created';
echo '<br />';
echo ($tableInserted) ? 'Table Populated' : 'Already had records';

if ($tableCreated && $tableInserted) {
    redirectTo('index.php');
} else {
    echo '<p>';
    echo 'There was a problem inserting records into database';
    echo '</p>';
}
