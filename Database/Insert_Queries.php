<?php

// Insert a Purok
function insertPurok($connection, $purok) {
    $sql = "INSERT INTO relief.purok (purok) VALUES (?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $purok);
    if ($stmt->execute()) {
        return $stmt->insert_id;
    } else {
        return false;
    }
}

// Insert a Resident
function insertResident($connection, $purok_id, $last_name, $first_name, $middle_name, $birthday, $sex) {
    $sql = "INSERT INTO relief.resident(purok_id, last_name, first_name, middle_name, birthday, sex, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $status = "Active";
    $stmt->bind_param("issssss", $purok_id, $last_name, $first_name, $middle_name, $birthday, $sex, $status);
    if ($stmt->execute()) {
        return $stmt->insert_id;
    } else {
        return false;
    }
}

// Insert a Contact Number
function insertContactNumber($connection, $resident_id, $contact_number) {
    $sql = "INSERT INTO relief.contact_number (resident_id, contact_number) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("is", $resident_id, $contact_number);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Insert a HouseHold
function insertHousehold($connection, $purok_id, $name, $address, $resident_id) {
    $sql = "INSERT INTO relief.household (purok_id, name, address, resident_id) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("issi", $purok_id, $name, $address, $resident_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertPurokRepresentative($connection, $resident_id, $purok_id, $status) {
    $sql = "INSERT INTO relief.purok_representative (resident_id, purok_id, status) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iis", $resident_id, $purok_id, $status);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function insertAccount($connection, $resident_id, $username, $password, $status) {
    $sql = "INSERT INTO relief.admin (resident_id, username, password, status) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("isss", $resident_id, $username, $password, $status);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertReliefPack($connection, $quantity, $description) {
    $sql = "INSERT INTO relief.relief_pack (quantity, description) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        // If prepare() fails, output the error
        echo "Prepare failed: (" . $connection->errno . ") " . $connection->error;
        return false;
    }

    $stmt->bind_param("is", $quantity, $description);

    if ($stmt->execute()) {
        return true;
    } else {
        // If execute() fails, output the error
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        return false;
    }
}

function insertReliefDistribution($connection, $distribution_date, $quantity, $relief_id, $hs_id, $representative_id) {
    // Prepare the SQL query string with placeholders
    $sql = "INSERT INTO relief.relief_distribution (distribution_date, quantity, relief_id, hs_id, representative_id) VALUES (?, ?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $connection->prepare($sql);
    
    // Bind the parameters to the SQL query (string, integer, integer, integer, integer)
    $stmt->bind_param("siiii", $distribution_date, $quantity, $relief_id, $hs_id, $representative_id);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

?>
