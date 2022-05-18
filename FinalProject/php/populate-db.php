<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myeldenringdb";

function newRecord() {
  return "New record created successfully<br />";
}

function tablePopulated($table) {
  return "Table '$table' populated<br /><br />";
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id;
$name;
$image;
$description;
$location;
$quote;

$table = "bosses";
$stmt = $conn->prepare("INSERT INTO $table (id, name, image, description, location)"
                     . "VALUES (?, ?, ?, ?, ?);");
$stmt->bind_param("sssss", $id, $name, $image, $description, $location);

$json = json_decode(file_get_contents("https://raw.githubusercontent.com/deliton" 
                                    . "/eldenring-api/main/api/public/data/"
                                    . "$table.json"), true);
foreach ($json as $entry) {
  $id = $entry['id'];
  $name = $entry['name'];

  if ($entry['image'] == null) {
    $image = "https://via.placeholder.com/400/dddddd/808080/?text=N/A";
  }
  else {
    $image = $entry['image'];
  }

  $description = $entry['description'];
  $location = $entry['location'];

  $stmt->execute();
  echo newRecord();
}
echo tablePopulated($table);

$table = "creatures";
$stmt = $conn->prepare("INSERT INTO $table (id, name, image, description, location)"
                     . "VALUES (?, ?, ?, ?, ?);");
$stmt->bind_param("sssss", $id, $name, $image, $description, $location);

$json = json_decode(file_get_contents("https://raw.githubusercontent.com/deliton" 
                                    . "/eldenring-api/main/api/public/data/"
                                    . "$table.json"), true);
foreach ($json as $entry) {
  $id = $entry['id'];
  $name = $entry['name'];

  if ($entry['image'] == null) {
    $image = "https://via.placeholder.com/400/dddddd/808080/?text=N/A";
  }
  else {
    $image = $entry['image'];
  }

  if ($entry['description'] == null || $entry['description'] == "???") {
    $description = "N/A";
  }
  else {
    $description = $entry['description'];
  }
  
  if (array_key_exists('location', $entry)) {
    $location = $entry['location'];
    if ($entry['location'] == null) {
      $location = "N/A";
    }
  }
  else {
    $location = "N/A";
  }
  
  $stmt->execute();
  echo newRecord();
}
echo tablePopulated($table);

$table = "npcs";
$stmt = $conn->prepare("INSERT INTO $table (id, name, image, quote, location)"
                     . "VALUES (?, ?, ?, ?, ?);");
$stmt->bind_param("sssss", $id, $name, $image, $quote, $location);

$json = json_decode(file_get_contents("https://raw.githubusercontent.com/deliton" 
                                    . "/eldenring-api/main/api/public/data/"
                                    . "$table.json"), true);
foreach ($json as $entry) {
  $id = $entry['id'];
  $name = $entry['name'];
  $image = $entry['image'];

  if ($entry['quote']) {
    $quote = $entry['quote'];
  }
  else {
    $quote = "N/A";
  }

  if ($entry['quote'] == "Insert NPC quote here." || $entry['quote'] == "???") {
    $quote = "N/A";
  }

  $location = $entry['location'];

  if ($location == "???") {
    $location = "N/A";
  }

  $stmt->execute();
  echo newRecord();
}
echo tablePopulated($table);

$table = "locations";
$stmt = $conn->prepare("INSERT INTO $table (id, name, image, description)"
                     . "VALUES (?, ?, ?, ?);");
$stmt->bind_param("ssss", $id, $name, $image, $description);

$json = json_decode(file_get_contents("https://raw.githubusercontent.com/deliton" 
                                    . "/eldenring-api/main/api/public/data/"
                                    . "$table.json"), true);
foreach ($json as $entry) {
  $id = $entry['id'];
  $name = $entry['name'];
  
  if ($entry['image'] == null) {
    $image = "https://via.placeholder.com/400/dddddd/808080/?text=N/A";
  }
  else {
    $image = $entry['image'];
  }
  if (array_key_exists('description', $entry)) {
    $description = $entry['description'];
  }

  $stmt->execute();
  echo newRecord();
}
echo tablePopulated($table);

$stmt->close();
$conn->close();
?>
