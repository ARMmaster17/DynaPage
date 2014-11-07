<?php
//required files
require_once 'sqldata.php';
require_once 'settings.php';
require_once 'styles.php';

//setup mySQL connection
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("Something went wrong. Check your installation of mySQL and the info you provided in login.php. For developers, here's what happened: " . mysql_error());

//start HTML headers
echo '<html>';
echo '<header>';
echo '<LINK href=\"' . $st_home . '\" rel="stylesheet" type="text/css">';
//add any header information you need such as Google Analytics tracking
echo '</header>';

//start body
if(!$st_bodyimage)
{
  echo '<body>';
}
else
{
  echo '<body style=\"background-image:url(' . $st_bodyimage . ')\">';
}
if(!$st_headerimage)
{
  echo "<h1>" . $cf_title . "</h1>";
  echo "<h2>" . $cf_caption . "</h2>";
  echo '<hr />';
  echo '<br /><br />';
}
else
{
  //TODO: finish call to create header image from media source listed in settings.php
  //echo "<img src=\"" . $st_headerimage . ""\" alt="Mountain View" style="width:304px;height:228px">"
}

//start posts
//initialize connection
mysql_select_db($db_database) or die("Something went wrong. Check that you set up your database correctly and you provided the correct name in login.php. For the developers: " . mysql.error());
$query = "SELECT * FROM posts LIMIT " . $cf_hp_visposts;
$result = mysql_query($query);
if (!$result) die("No posts found.");
$rows = mysql_num_rows($result);
for ($j = $rows ; $j > -1 ; --$j)
{
  echo '<h3>' . mysql_result($result,$j,'title') . '</h3>';
  echo '<h5>' . mysql_result($result,$j,'pubdate') . '</h5>';
  echo '<p>' . mysql_result($result,$j,'content') . '</p><br />';
}

//begin footer of visible page
echo '<hr />';
echo $cf_legal . '<br />';
echo 'Developed with <a href=\"github.com/ARMmaster17/DynaPage/\">DynaPage</a>';

//end body
echo '</body>';

//open footer
echo '<footer>';
//add footer here. Ex: advanced page load timing JS snippet
echo '</footer>';

//close HTML tag
echo '</html>';

//end page
?>
