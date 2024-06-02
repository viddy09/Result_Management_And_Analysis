<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Database</title>
	<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
	<header>
	</header>
	<table>
	<tr>
	<th>Filename</th>
	<th>Month-Year</th>
	<th>Semester</th>
	<th>Branch</th>
	<th>Added on</th>
	<th>Modify</th>
	</tr>
	<?php
	$conn = mysqli_connect("localhost", "root", "", "result_analysis");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT filename, monthyear,sem,branch,addedon FROM showdb";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["filename"]. "</td><td>" . $row["monthyear"] . "</td><td>"
. $row["sem"]. "</td><td>"
. $row["branch"]. "</td><td>"
. $row["addon"]. "</td>
<td> <button>Delete</button></td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
	?>
	</table>
	

</body>

</html>