<a href = 'https://github.com/tsjohnson/As18'>Github</a>
<?php
main();

function main () {

	$apiCall = 'https://api.covid19api.com/summary';
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);
  $arr=array();

	foreach($obj->Countries as $index=>$label){
      $arr[$label->Country] = $label->TotalDeaths;
  };

//Sorts and stores the array
  arsort($arr);
  $json = json_encode(array_slice($arr, 0, 10));

	// echo html head section
	echo '<html>';
	echo '<head>';
	echo '	<link rel="icon" href="img/cardinal_logo.png" type="image/png" />';
	echo '</head>';
	echo '<body onload="loadDoc()">';
	echo '<div id="demo">';
	echo '</div>';

echo "
<table border = '1px'>
";

//unpacks json and stores in a table
$info = json_decode($json);
echo "<td>Country</td><td>Deaths</td>";
foreach($info as $key=>$row){
  echo "<tr>
      <td>". $key . "</td><td>{$row}</td>
  </tr>";
}
echo "
</table>
";





	// close html body section
	echo '</body>';
	echo '</html>';
}


#-----------------------------------------------------------------------------
// read data from a URL into a string
function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>
