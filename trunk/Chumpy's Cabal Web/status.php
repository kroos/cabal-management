<?php
// Cabal channel status script v2.00
// Written by mrmagoo (chumpywumpy) for The Divinity Project
// Includes VisualEvolution's simple status checker


// Title shown at the top of pages
define("PAGE_TITLE","MyCabal channel status");

// MSSQL server connection details
// Database server
define("DB_ADDR","127.0.0.1");
// Database login
define("DB_USER","sa");
// Database password
define("DB_PASS","mypassword");

// GAMEDB database name in case yours is different
define("DB_GAM","GAMEDB");

// Max players per channel
$maxplayers=100;

// Login server IP and port
define("SVR_ADDR","127.0.0.1");
define("SVR_PORT","38101");

$channels = array(
					1=> array("number"=>1,  "type"=>0,        "name"=>"Channel 1 (Novice)",  "ip"=>"127.0.0.1", "port"=>"38111"  ),
					2=> array("number"=>2,  "type"=>0,        "name"=>"Channel 2 (Trade)",   "ip"=>"127.0.0.1", "port"=>"38112"  ),
					3=> array("number"=>3,  "type"=>1,        "name"=>"Channel 3 (PK)",      "ip"=>"127.0.0.1", "port"=>"38113"  ),
					4=> array("number"=>4,  "type"=>4,        "name"=>"Channel 4 (Premium)", "ip"=>"127.0.0.1", "port"=>"38114"  ),
					5=> array("number"=>5,  "type"=>8,        "name"=>"Channel 5 (War)",     "ip"=>"127.0.0.1", "port"=>"38115"  ),
					6=> array("number"=>10, "type"=>16908368, "name"=>"Channel 10 (TG)",     "ip"=>"127.0.0.1", "port"=>"38116"  )
				);
     
//#### Don't edit below here ####\\

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >';
echo '<HTML><HEAD>';
echo '<link title="style" href="status.css" type="text/css" rel="stylesheet">';	
echo '<meta http-equiv="Content-Type" content="text/html; charset=US">';
echo '<title>'.PAGE_TITLE.'</title></head>';
echo '<body><div align="center">';	
             
$link = mssql_connect(DB_ADDR, DB_USER, DB_PASS);
if (!$link) die('Could not connect to MSSQL database.');

echo '<img src="images/title.png" />';
echo '<table width="300" cellspacing="0" cellpadding="1" style="border:#202020 1px solid">';
for ($i=1; $i<=count($channels); $i++) {  	  
  switch ($channels[$i]['type']) {
    case '1': // PK
      $col='#ffffff';
      break;
    case '4': // Prem
      $col='#b6ff90';
      break;
    case '8': // War
      $col='#ffb2b2';
      break;
    case '16908368': // TG
      $col='#ff6767';
      break;
    default: // All others
      $col='#e0ffd0';	  
  }
  echo '<tr><td style="border-bottom:#404040 1px dashed;padding-left:4px;"><span style="color:'.$col.'"><strong>'.$channels[$i]['name'].'</strong></span></td>';
  $r=mssql_query("select count (*) from ".DB_GAM.".dbo.cabal_character_table where channelidx=".$channels[$i]['number']." and Login=1");
  $row = mssql_fetch_row($r);
  mssql_free_result($r);	
  $p=round((100 / $maxplayers) * $row[0],0);
  for ($j=1; $j<=8; $j++) {
    if ($p>100) {
      echo '<td width="4" style="border-bottom:#404040 1px dashed"><img src="images/4.png" /></td>';
    } else if ($p>= round(100/8*$j,0)) {
      echo '<td width="4" style="border-bottom:#404040 1px dashed"><img src="images/'.round($j/2,0).'.png" /></td>';
    } else {
      echo '<td width="4" style="border-bottom:#404040 1px dashed"><img src="images/0.png" /></td>';
    }
  }
  if (!$sock = @fsockopen($channels[$i]['ip'], $channels[$i]['port'], $enum, $etext, 5)) {
    echo '<td align="center" style="border-bottom:#404040 1px dashed"><strong><span style="color:#ff0000">offline</span></strong></td>';
  } else {
    echo '<td align="center" style="border-bottom:#404040 1px dashed"><strong><span style="color:#00ff00">online</span></strong></td>';
    fclose($sock);
  }
  echo '</tr>';
}
  echo '<tr><td colspan="9" style="padding-left:4px;"><span style="color:#c0c0c0"><strong>Login server</strong></td>';
  if (!$sock = @fsockopen(SVR_ADDR, SVR_PORT, $enum, $etext, 5)) {
    echo '<td align="center"><strong><span style="color:#ff0000">offline</span></strong>';
  } else {
    echo '<td align="center"><strong><span style="color:#00ff00">online</span></strong>';
    fclose($sock);
  }  
  echo '</td></tr>';
  $r=mssql_query("select count (*) from ".DB_GAM.".dbo.cabal_character_table where Login=1");
  $row = mssql_fetch_row($r);
  mssql_free_result($r);
  echo '<tr><td colspan="9" style="padding-left:4px;"><span style="color:#c0c0c0"><strong>Players online</strong></td>';
  echo '<td align="center"><strong><span class="orange">'.$row[0].'</span></strong></tr>';
echo '</table></div></body></html>';

?>