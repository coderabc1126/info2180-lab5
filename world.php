<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = $_GET['country'];
$cityParam = $_GET['context'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getQuery($conn, $country, $cityParam){
  if($cityParam != "cities"){
    return $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  }else{
    return $conn->query("SELECT cities.name, cities.district,cities.population
                         FROM countries LEFT JOIN cities ON countries.code = cities.country_code
                         WHERE countries.name LIKE '%$country%'");
  }
}

function displayHeader($cityParam){
  $headerStr = '';
  $headerStr .= '<tr>';
  $headerStr .= '<th>Name</th>';
  if($cityParam != "cities"){
    $headerStr .= '<th>Continent</th>';
    $headerStr .= '<th>Independence</th>';
    $headerStr .= '<th>Head of State</th>';
  }else{
    $headerStr .= '';
    $headerStr .= '<th>District</th>';
    $headerStr .= '<th>Population</th>';
  }
  $headerStr .= '</tr>';
  return $headerStr;
}

function retrieveData($cityParam, $dataStr, $row){
  if($cityParam != "cities"){
    $dataStr .= "<tr>";
    $dataStr .= "<td>{$row['name']}</td>";
    $dataStr .= "<td>{$row['continent']}</td>";
    $dataStr .= "<td>{$row['independence_year']}</td>";
    $dataStr .= "<td>{$row['head_of_state']}</td>";
    $dataStr .= "</tr>";
  }else{
    $dataStr .= "<tr>";
    $dataStr .= "<td>{$row['name']}</td>";
    $dataStr .= "<td>{$row['district']}</td>";
    $dataStr .= "<td>{$row['population']}</td>";
    $dataStr .= "</tr>";
  }
  return $dataStr;
}

?>

<table>
<?php
$cityStr = '';
echo displayHeader($cityParam);
foreach ($results as $row):
  echo retrieveData($cityParam, $cityStr, $row);
?>
<?php endforeach; ?>
</table>
