<?php
    function getResidentDetails($connection) {
        $sql = "SELECT CONCAT(r.first_name, ' ', r.middle_name, ' ', r.last_name) AS Name,
                r.birthday,
                h.address,
                c.contact_number,
                r.sex,
                r.status,
                p.purok,
                r.resident_id
            FROM resident r
            LEFT JOIN contact_number c USING (resident_id)
            LEFT JOIN household h USING (resident_id)
            LEFT JOIN purok p ON p.purok_id = r.purok_id
        ";

        $result = $connection->query($sql);
        
        if ($result === false) {
            // Query failed
            return false;
        }

        $residents = array();
        while ($row = $result->fetch_assoc()) {
            $residents[] = $row;
        }
        
        return $residents;
    }

    function ResidentDetails($connection, $target_id) {
        $sql = " SELECT r.first_name, 
                r.middle_name, 
                r.last_name,
                r.birthday,
                h.address,
                c.contact_number,
                r.sex,
                r.status,
                p.purok,
                r.resident_id,
                c.con_id,
                h.household_id,
                p.purok_id
            FROM resident r
            LEFT JOIN contact_number c USING (resident_id)
            LEFT JOIN household h USING (resident_id)
            LEFT JOIN purok p ON p.purok_id = r.purok_id 
            WHERE r.resident_id = ?
        ";
    
        // Prepare the statement
        if ($stmt = $connection->prepare($sql)) {
            // Bind the target_id parameter
            $stmt->bind_param("i", $target_id);
    
            // Execute the statement
            $stmt->execute();
    
            // Get the result
            $result = $stmt->get_result();
    
            // Check if the query succeeded
            if ($result === false) {
                return false;
            }
    
            $residents = array();
            while ($row = $result->fetch_assoc()) {
                $residents[] = $row;
            }
    
            // Close the statement
            $stmt->close();
    
            return $residents;
        } else {
            // Statement preparation failed
            return false;
        }
    }

    function getPurokData($connection) {
        $sql = "SELECT distinct p.purok FROM relief.purok p
                LEFT JOIN relief.purok_representative pr USING (purok_id) 
                WHERE p.purok_id NOT IN (SELECT purok_id FROM relief.purok_representative where status = 'Active')
        ";
    
        $result = $connection->query($sql);
        
        if ($result === false) {
            // Query failed
            return false;
        }
    
        $puroks = array();
        while ($row = $result->fetch_assoc()) {
            $puroks[] = $row;
        }
        
        return $puroks;
    }
    
    function getResidentNames($connection) {
        $sql = "SELECT r.resident_id, CONCAT(r.first_name, ' ', r.middle_name, ' ', r.last_name) AS Name
                FROM relief.resident r
                LEFT JOIN relief.purok_representative pr USING (resident_id)
                WHERE r.resident_id NOT IN (SELECT resident_id FROM relief.purok_representative where status != 'Inactive');
        ";
    
        $result = $connection->query($sql);
        
        if ($result === false) {
            // Query failed
            return false;
        }
    
        $residents = array();
        while ($row = $result->fetch_assoc()) {
            $residents[] = $row;
        }
        
        return $residents;
    }

    function getPurokIdByName($connection, $purokName) {
        $sql = "SELECT purok_id FROM relief.purok WHERE purok = ? LIMIT 1";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $purokName);
        $stmt->execute();
        
        // Fetching the result directly
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['purok_id'];
        } else {
            return null;
        }
    }

    function getPurokRepresentatives($connection) {
        $sql = "SELECT r.resident_id, CONCAT(r.first_name, ' ', r.middle_name, ' ', r.last_name) AS Name, 
            p.purok,
            pr.status, 
            c.contact_number, sum(rd.quantity) as goodsDistributed
            FROM relief.purok_representative pr
            LEFT JOIN relief.purok p USING(purok_id)
            LEFT JOIN relief.resident r USING(resident_id)
            LEFT JOIN relief.contact_number c USING (resident_id)
            LEFT JOIN relief.relief_distribution rd on rd.representative_id = pr.resident_id
            group by r.resident_id, r.first_name, r.middle_name, r.last_name, p.purok, c.contact_number, pr.status
        ";
    
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $representatives = [];
    
        while ($row = $result->fetch_assoc()) {
            $representatives[] = $row;
        }
    
        return $representatives;
    }

    function getAllReliefPacks($connection) {
        $sql = "SELECT * FROM relief.relief_pack";
    
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $reliefPacks = [];
    
        while ($row = $result->fetch_assoc()) {
            $reliefPacks[] = $row;
        }
    
        return $reliefPacks;
    }

    function AllReliefPacks($connection) {
        $sql = "SELECT * FROM relief.relief_pack where quantity != 0";
    
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $reliefPacks = [];
    
        while ($row = $result->fetch_assoc()) {
            $reliefPacks[] = $row;
        }
    
        return $reliefPacks;
    }
    
    function getHouseholdIdByResidentId($connection, $resident_id) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT household_id FROM relief.household WHERE resident_id = ?";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        
        // Bind the parameter to the SQL query (integer)
        $stmt->bind_param("i", $resident_id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['household_id'];
            } else {
                return null; // No matching record found
            }
        } else {
            return false; // Query execution failed
        }
    }
    
    // 
    
    function getReliefPackQuantity($connection, $relief_id) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT quantity FROM relief.relief_pack where relief_id = ?";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        
        // Bind the parameter to the SQL query (integer)
        $stmt->bind_param("i", $relief_id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['quantity'];
            } else {
                return null; // No matching record found
            }
        } else {
            return false; // Query execution failed
        }
    }

    function getPurokRepresentativesDetails($connection, $resident_id) {
        $sql = "SELECT r.resident_id, CONCAT(r.first_name, ' ', r.middle_name, ' ', r.last_name) AS Name, 
            p.purok, 
            c.contact_number, 
            rd.quantity, 
            rp.description,
            rd.distribution_date
            FROM relief.purok_representative pr
            LEFT JOIN relief.purok p USING(purok_id)
            LEFT JOIN relief.resident r USING(resident_id)
            LEFT JOIN relief.contact_number c USING (resident_id)
            LEFT JOIN relief.relief_distribution rd on rd.representative_id = pr.resident_id
            LEFT JOIN relief.relief_pack rp using(relief_id) where r.resident_id = ?";
    
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $resident_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $representatives = [];
    
        while ($row = $result->fetch_assoc()) {
            $representatives[] = $row;
        }
    
        return $representatives;
    }
    function reliefDistributionHistory($connection) {
        $sql = "SELECT r.resident_id, CONCAT(r.first_name, ' ', r.middle_name, ' ', r.last_name) AS Name, 
            p.purok, 
            c.contact_number, 
            rd.quantity, 
            rp.description,
            rd.distribution_date
            FROM relief.purok_representative pr
            LEFT JOIN relief.purok p USING(purok_id)
            LEFT JOIN relief.resident r USING(resident_id)
            LEFT JOIN relief.contact_number c USING (resident_id)
            LEFT JOIN relief.relief_distribution rd on rd.representative_id = pr.resident_id
            LEFT JOIN relief.relief_pack rp using(relief_id) ORDER by rd.distribution_date DESC";
    
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $representatives = [];
    
        while ($row = $result->fetch_assoc()) {
            $representatives[] = $row;
        }
    
        return $representatives;
    }
    function countResident($connection) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT count(resident_id) as resident FROM relief.resident";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['resident'];
            } else {
                return null; // No matching record found
            }
        } else {
            return false; // Query execution failed
        }
    }
    function countDistribution($connection) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT count(distribution_id) as distribution FROM relief.relief_distribution";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['distribution'];
            } else {
                return null; // No matching record found
            }
        } else {
            return false; // Query execution failed
        }
    }
    function displayAccountHolder($connection) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT r.resident_id, CONCAT(r.first_name, ' ', r.middle_name, ' ', r.last_name) AS Name
         FROM relief.resident r LEFT JOIN relief.admin a using(resident_id) where r.resident_id NOT IN (SELECT resident_id FROM relief.admin)";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            $Data = [];
        
            while ($row = $result->fetch_assoc()) {
                $Data[] = $row;
            }
        
            return $Data;
        } else {
            return false; // Query execution failed
        }
    }
    function countReliefPack($connection) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT count(relief_id) relief FROM relief.relief_pack where quantity != 0";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['relief'];
            } else {
                return null; // No matching record found
            }
        } else {
            return false; // Query execution failed
        }
    }
    function representativeChecking($connection, $resident_id) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT status FROM relief.purok_representative where resident_id = ?";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $resident_id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['status'];
            } else {
                return null; // No matching record found
            }
        } else {
            return false; // Query execution failed
        }
    }
    function quantityChecking($connection, $relief_id) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT quantity FROM relief.relief_pack where relief_id = ?";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $relief_id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['quantity'];
            } else {
                return null; // No matching record found
            }
        } else {
            return false; // Query execution failed
        }
    }
    function displayAccount($connection) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT r.resident_id, CONCAT(r.first_name, ' ', r.middle_name, ' ', r.last_name) AS Name, a.username, p.purok FROM relief.admin a  LEFT JOIN relief.resident r USING(resident_id) LEFT JOIN relief.purok p USING(purok_id)";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            $Data = [];
        
            while ($row = $result->fetch_assoc()) {
                $Data[] = $row;
            }
        
            return $Data;
        } else {
            return false; // Query execution failed
        }
    }
    function accountDetails($connection, $resident_id) {
        // Prepare the SQL query string with a placeholder
        $sql = "SELECT CONCAT(r.first_name, ' ', r.middle_name, ' ', r.last_name) AS Name, a.username, p.purok 
                FROM relief.admin a  
                LEFT JOIN relief.resident r USING(resident_id) 
                LEFT JOIN relief.purok p USING(purok_id) 
                WHERE r.resident_id = ?";
    
        // Prepare the statement
        if ($stmt = $connection->prepare($sql)) {
            // Bind the parameter
            $stmt->bind_param("i", $resident_id);
    
            // Execute the query
            if ($stmt->execute()) {
                // Get the result
                $result = $stmt->get_result();
                $Data = [];
    
                while ($row = $result->fetch_assoc()) {
                    $Data[] = $row;
                }
    
                // Close the statement
                $stmt->close();
    
                // Return the fetched data
                return $Data;
            } else {
                // Query execution failed
                error_log("Query execution failed: " . $stmt->error);
                $stmt->close();
                return false;
            }
        } else {
            // Statement preparation failed
            error_log("Statement preparation failed: " . $connection->error);
            return false;
        }
    }
    function gettingPassword($connection, $Username) {
        // Prepare the SQL query string with a placeholder
        $sql = "Select password from relief.admin where username = ?";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $Username);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['password'];
            } 
        } else {
            return null; // Query execution failed
        }
    }
    function gettingResidentId($connection, $Username) {
        // Prepare the SQL query string with a placeholder
        $sql = "Select resident_id from relief.admin where username = ?";
        
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $Username);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the household_id from the result
            if ($row = $result->fetch_assoc()) {
                return $row['resident_id'];
            } 
        } else {
            return null; // Query execution failed
        }
    }
?>