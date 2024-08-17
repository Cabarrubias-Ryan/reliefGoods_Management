<?php
// Function to update a resident
function updateResident($conn, $resident_id, $last_name, $first_name, $middle_name, $birthday, $sex) {
    $sql = "UPDATE relief.resident SET last_name = ?, first_name = ?, middle_name = ?, birthday = ?, sex = ? WHERE resident_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $last_name, $first_name, $middle_name, $birthday, $sex, $resident_id);
    $stmt->execute();
    $stmt->close();
}

// Function to update a purok
function updatePurok($conn, $purok_id, $purok) {
    $sql = "UPDATE relief.purok SET purok = ? WHERE purok_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $purok, $purok_id);
    $stmt->execute();
    $stmt->close();
}

// Function to update a contact number
function updateContactNumber($conn, $con_id, $contact_number) {
    $sql = "UPDATE relief.contact_number SET contact_number = ? WHERE con_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $contact_number, $con_id);
    $stmt->execute();
    $stmt->close();
}

// Function to update a household
function updateHousehold($conn, $household_id, $name, $address) {
    $sql = "UPDATE relief.household SET name = ?, address = ? WHERE household_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $address, $household_id);
    $stmt->execute();
    $stmt->close();
}

function updateReliefPackQuantity($connection, $quantity, $relief_id) {
    // Prepare the SQL query string with placeholders
    $sql = "UPDATE relief.relief_pack SET quantity = ? WHERE relief_id = ?";
    
    // Prepare the statement
    $stmt = $connection->prepare($sql);
    
    // Bind the parameters to the SQL query (integer, integer)
    $stmt->bind_param("ii", $quantity, $relief_id);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function removeResident($connection,$resident_id) {
    // Prepare the SQL query string with placeholders
    $sql = "UPDATE relief.resident SET status = ? WHERE resident_id = ? ";
    
    // Prepare the statement
    $stmt = $connection->prepare($sql);
    $status = "Inactive";
    // Bind the parameters to the SQL query (integer, integer)
    $stmt->bind_param("si",$status, $resident_id);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function removeRepresentative($connection,$resident_id) {
    // Prepare the SQL query string with placeholders
    $sql = "UPDATE relief.purok_representative SET status = ? WHERE resident_id = ?";
    
    // Prepare the statement
    $stmt = $connection->prepare($sql);
    $status = "Inactive";
    // Bind the parameters to the SQL query (integer, integer)
    $stmt->bind_param("si",$status, $resident_id);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function reassignRepresentative($connection,$resident_id, $purok_id) {
    // Prepare the SQL query string with placeholders
    $sql = "UPDATE relief.purok_representative SET status = ?, purok_id = ? WHERE resident_id = ?";
    
    // Prepare the statement
    $stmt = $connection->prepare($sql);
    $status = "Active";
    // Bind the parameters to the SQL query (integer, integer)
    $stmt->bind_param("sii",$status, $purok_id, $resident_id);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function updateAccounts($connection, $new_resident_id, $username, $password, $resident_id) {
    // Prepare the SQL query string with placeholders
    $sql = "UPDATE relief.admin SET resident_id = ?, username = ?, password = ? WHERE resident_id = ?";
    
    // Prepare the statement
    $stmt = $connection->prepare($sql);
    // Bind the parameters to the SQL query (integer, integer)
    $stmt->bind_param("issi",$new_resident_id, $username, $password, $resident_id);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

?>
