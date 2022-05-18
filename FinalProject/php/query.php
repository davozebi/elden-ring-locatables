<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myeldenringdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name;
$image;
$description;
$location;
$quote;

$response = array();
$data = array();

$search = $_GET['search'];

$sql = "SELECT *
        FROM bosses
        WHERE name LIKE '$search%'
        UNION
        SELECT *
        FROM bosses
        WHERE name LIKE '%$search'
        UNION
        SELECT *
        FROM bosses
        WHERE name LIKE '%$search%'
        OR location LIKE '%$search%';";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $name = $row["name"];
    $image = $row["image"];
    $description = $row["description"];
    $location = $row["location"];

    $data[] = array("name"=>$name
                  , "image"=>$image
                  , "description"=>$description
                  , "location"=>$location);
  }

  $response["bosses"] = $data;
}


$data = array();

$sql = "SELECT *
        FROM creatures
        WHERE name LIKE '$search%'
        UNION
        SELECT *
        FROM creatures
        WHERE name LIKE '%$search'
        UNION
        SELECT *
        FROM creatures
        WHERE name LIKE '%$search%'
        OR location LIKE '%$search%';";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  
  while ($row = $result->fetch_assoc()) {
    $name = $row["name"];
    $image = $row["image"];
    $description = $row["description"];
    $location = $row["location"];

    $data[] = array("name"=>$name
                  , "image"=>$image
                  , "description"=>$description
                  , "location"=>$location);
  }

  $response["creatures"] = $data;
}


$data = array();

$sql = "SELECT *
        FROM npcs
        WHERE name LIKE '$search%'
        UNION
        SELECT *
        FROM npcs
        WHERE name LIKE '%$search'
        UNION
        SELECT *
        FROM npcs
        WHERE name LIKE '%$search%'
        OR location LIKE '%$search%';";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  
  while ($row = $result->fetch_assoc()) {
    $name = $row["name"];
    $image = $row["image"];
    $quote = $row["quote"];
    $location = $row["location"];

    $data[] = array("name"=>$name
                  , "image"=>$image
                  , "quote"=>$quote
                  , "location"=>$location);
  }

  $response["npcs"] = $data;
}


if (sizeof($response) == 0) {
  echo "0 results";
}
else {
  echo json_encode($response);
}

$conn->close();
?>
