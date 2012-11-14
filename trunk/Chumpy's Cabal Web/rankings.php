<?php

include('config.php');
$maps_array=array( 1=>'Bloody Ice',2=>'Desert Scream',3=>'Green Despair',4=>'Port Lux',5=>'Fort Ruina',
                   6=>'Lakeside',7=>'Undead Ground',8=>'Forgotten Ruin',9=>'Mutant Forest',10=>'Pontus Ferrum',
                   13=>'Frozen Tower of Undead',14=>'Ruina Station',15=>'Tierra Gloriosa',
                   16=>'Tierra Gloriosa (Lobby)',19=>'Jail',23=>'Forgotten Temple',24=>'Volcanic Citadel',
                   25=>'Exilian Volcano',26=>'Lake in Dusk',27=>'Dungeon',28=>'Dungeon',29=>'Dungeon',
                   30=>'Warp Room'                  
                  );

$link = mssql_connect(DB_ADDR, DB_USER, DB_PASS);
if (!$link) die('Could not connect to MSSQL database.');

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >';
echo '<HTML><HEAD>';
echo '<meta content="JavaScript" name="vs_defaultClientScript">';
echo '<link title="style" href="layout.css" type="text/css" rel="stylesheet">';	
echo '<meta http-equiv="Content-Type" content="text/html; charset=US">';
echo '<title>'.PAGE_TITLE.'</title></head>';
echo '<body bgcolor="#000000;">';

echo '<div align="center"><table width="554" cellspacing="0" cellpadding="4" style="border:#333333 1px solid" border="0">';
echo '<tr><td colspan="2" align="center" style="background-color:#333333"><span class="orange"><strong>Select a ranking type</strong></span></td></tr>';
echo '<tr>';
echo '<td align="center" colspan="2">';
echo '<a href="rankings.php?action=rankings&type=chars"><span style="text-decoration:underline">Top 10 characters</span></a>&nbsp;|&nbsp;';
echo '<a href="rankings.php?action=rankings&type=combo"><span style="text-decoration:underline">Combo rankings</span></a>&nbsp;|&nbsp;';
echo '<a href="rankings.php?action=rankings&type=tg"><span style="text-decoration:underline">Tierra Gloriosa wins</span></a>';
echo '</td>';
echo '</tr>';

echo '<form method="post" action="rankings.php?action=rankings&type=sdun">';
echo '<tr>';
echo '<td align="center">Dungeon (single):&nbsp;';
echo '<select name="sdname" class="editbox">';
echo '<option value="The_Lake_in_Dusk">Lake in Dusk</option>';
echo '<option value="Ruina_Station">Ruina Station</option>';
echo '<option value="Frozen_Tower_of_Undead(B1F)">Frozen Tower of Undead(B1F)</option>';
echo '<option value="Frozen_Tower_of_Undead(B2F)_Part1">Frozen Tower of Undead(B2F) Part 1</option>';
echo '<option value="Volcanic_Citadel">Volcanic Citadel</option>';
echo '<option value="Forgotten_Temple_B1F">Forgotten Temple B1F</option>';
echo '<option value="Skeleton_Mine_(Grade:_D,_Solo)">Skeleton Mine (Grade: D, Solo)</option>';
echo '<option value="Mummy_Grave_(Grade:_D,_Solo)">Mummy Grave (Grade: D, Solo)</option>';
echo '<option value="Ghost_Ship_(Grade:_D,_Solo)">Ghost Ship (Grade: D, Solo)</option>';
echo '<option value="The_Ruins_of_the_Ancient_City_(Grade:_D,_Solo)">The Ruins of the Ancient City (Grade: D, Solo)</option>';
echo '<option value="Lighthouse_Maze_(Grade:_D,_Solo)">Lighthouse Maze (Grade: D, Solo)</option>';
echo '</select>';
echo '</td>';
echo '<td align="center"><input type="submit" value="View" class="button"></td>';
echo '</tr>';
echo '</form>';

echo '<form method="post" action="rankings.php?action=rankings&type=gdun">';
echo '<tr>';
echo '<td align="center">Dungeon (group):&nbsp;';
echo '<select name="gdname" class="editbox">';
echo '<option value="The_Lake_in_Dusk">Lake in Dusk</option>';
echo '<option value="Ruina_Station">Ruina Station</option>';
echo '<option value="Frozen_Tower_of_Undead(B1F)">Frozen Tower of Undead(B1F)</option>';
echo '<option value="Frozen_Tower_of_Undead(B2F)_Part1">Frozen Tower of Undead(B2F) Part 1</option>';
echo '<option value="Volcanic_Citadel">Volcanic Citadel</option>';
echo '<option value="Forgotten_Temple_B1F">Forgotten Temple B1F</option>';
echo '<option value="Skeleton_Mine_(Grade:_D,_Group)">Skeleton Mine (Grade: D, Group)</option>';
echo '<option value="Mummy_Grave_(Grade:_D,_Group)">Mummy Grave (Grade: D, Group)</option>';
echo '<option value="Ghost_Ship_(Grade:_D,_Group)">Ghost Ship (Grade: D, Group)</option>';
echo '<option value="The_Ruins_of_the_Ancient_City_(Grade:_D,_Solo)">The Ruins of the Ancient City (Grade: D, Solo)</option>';
echo '<option value="Zombie_Infested_Cottage_(Grade:_D,_Group)">Zombie Infested Cottage (Grade: D, Group)</option>';
echo '</select>';
echo '</td>';
echo '<td align="center"><input type="submit" value="View" class="button"></td>';
echo '</tr>';
echo '</form>';

echo '</table>';

switch($_REQUEST['type']) {
  case 'chars':   
    top_ten_chars();
  break;
  case 'combo':   
    top_ten_combo();
  break;
  case 'tg':   
    tierra_gloriosa_wins();
  break;
  case 'sdun':   
    top_ten_dungeon_single($_REQUEST['sdname']);
  break;
  case 'gdun':   
    top_ten_dungeon_group($_REQUEST['gdname']);
  break;
  default:
    top_ten_chars();	   
}	

echo '</body></html>';
exit;

/////////////////////

function top_ten_chars() {
  $r=mssql_query('select top 10 * from '.DB_GAM.'.dbo.cabal_character_table order by exp desc,reputation desc,alz desc');
  echo '<p class="orange"><strong>Top 10 characters</strong></p>';
  echo '<table width="800" style="border:#333333 1px solid" cellpadding="2">';
  echo '<tr style="background-color:#555555"><td width="28"></td>';
  echo '<td height="24" width="200" style="padding-left:8px"><strong>Name</strong></td>';
  echo '<td height="24" width="200" style="padding-left:8px"><strong>Class</strong></td>';
  echo '<td style="padding-left:8px"><strong>Level</strong></td>';
  echo '<td style="padding-left:8px"><strong>Class&nbsp;Rank</strong></td>';
  echo '<td style="padding-left:8px"><strong>EXP</strong></td>';
  echo '<td style="padding-left:8px"><strong>Honour</strong></td>';
  echo '<td style="padding-left:8px"><strong>Alz</strong></td>';
  echo '</tr>';
  for ($i=1;$i<=mssql_num_rows($r);$i++) {
    $row = mssql_fetch_row($r);
    $carray=decode_style($row[12]);
    echo '<tr style="background-color:#333333">';
    echo '<td style="padding-left:8px">'.$i.'</td>';
    echo '<td style="padding-left:8px">'.$row[1].'</td>';
    echo '<td style="padding-left:8px">'.$carray['Class_Name'].'</td>';
    echo '<td style="padding-left:8px">'.$row[2].'</td>';
    echo '<td style="padding-left:8px">'.$carray['Class_Rank'].'</td>';
    echo '<td style="padding-left:8px">'.$row[3].'</td>';
    echo '<td style="padding-left:8px">'.$row[25].'</td>';
    echo '<td style="padding-left:8px">'.$row[9].'</td>';
    echo '</tr>';
    unset($carray);
    mssql_next_result($r);
  }
  echo '</table>';
}

function top_ten_combo() {
  $r=mssql_query('select top 10 * from '.DB_GAM.'.dbo.cabal_record_combo order by cntcombo desc');
  echo '<p class="orange"><strong>Top 10 combos</strong></p>';
  echo '<table width="554" style="border:#333333 1px solid" cellpadding="2">';
  echo '<tr style="background-color:#555555"><td width="28"></td>';
  echo '<td height="24" width="200" style="padding-left:8px"><strong>Name</strong></td>';
  echo '<td style="padding-left:8px"><strong>Count</strong></td>';
  echo '</tr>';
  for ($i=1;$i<=mssql_num_rows($r);$i++) {
    $row = mssql_fetch_row($r);
    echo '<tr style="background-color:#333333">';
    echo '<td style="padding-left:8px">'.$i.'</td>';
    echo '<td style="padding-left:8px">'.$row[1].'</td>';
    echo '<td style="padding-left:8px">'.$row[2].'</td>';
    echo '</tr>';
    mssql_next_result($r);
  }
  echo '</table>';
}

function top_ten_dungeon_single($name) {
  $name=str_replace('_',' ',$name);
  $r=mssql_query('select top 10 * from '.DB_GAM.'.dbo.cabal_event_singledg where dungeounName="'.$name.'" order by passtime desc');
  echo '<table width="554" style="border:#333333 1px solid" cellpadding="2">';
  echo '<p class="orange"><strong>'.$name.' (single)</strong></p>';
  echo '<tr style="background-color:#555555"><td width="28"></td>';
  echo '<td height="24" width="200" style="padding-left:8px"><strong>Name</strong></td>';
  echo '<td style="padding-left:8px"><strong>Time</strong></td>';
  echo '</tr>';
  for ($i=1;$i<=mssql_num_rows($r);$i++) {
    $row = mssql_fetch_row($r);
    echo '<tr style="background-color:#333333">';
    echo '<td style="padding-left:8px">'.$i.'</td>';
    echo '<td style="padding-left:8px">'.$row[4].'</td>';
    echo '<td style="padding-left:8px">'.$row[2].'</td>';
    echo '</tr>';
    mssql_next_result($r);
  }
  echo '</table>';
}

function top_ten_dungeon_group($name) {
  $name=str_replace('_',' ',$name);
  $r=mssql_query('select top 10 * from '.DB_GAM.'.dbo.cabal_event_partydg where dungeounName="'.$name.'" order by passtime desc');
  echo '<table width="554" style="border:#333333 1px solid" cellpadding="2">';
  echo '<p class="orange"><strong>'.$name.' (group)</strong></p>';
  echo '<tr style="background-color:#555555"><td width="28"></td>';
  echo '<td height="24" width="200" style="padding-left:8px"><strong>Name</strong></td>';
  echo '<td style="padding-left:8px"><strong>Time</strong></td>';
  echo '</tr>';
  for ($i=1;$i<=mssql_num_rows($r);$i++) {
    $row = mssql_fetch_row($r);
    echo '<tr style="background-color:#333333">';
    echo '<td style="padding-left:8px">'.$i.'</td>';
    echo '<td style="padding-left:8px">'.$row[4].'</td>';
    echo '<td style="padding-left:8px">'.$row[2].'</td>';
    echo '</tr>';
    mssql_next_result($r);
  }
  echo '</table>';
}

function tierra_gloriosa_wins() {
  $r=mssql_query('select count (*) from '.DB_GAM.'.dbo.cabal_instantwar_nationrewardwarresults where capellawin=1');
  $row = mssql_fetch_row($r);
  $cwin=$row[0];
  $r=mssql_query('select count (*) from '.DB_GAM.'.dbo.cabal_instantwar_nationrewardwarresults where procyonwin=1');
  $row = mssql_fetch_row($r);
  $pwin=$row[0];
  $r=mssql_query('select count (*) from '.DB_GAM.'.dbo.cabal_character_table where Nation=1 or Nation=2');
  $row = mssql_fetch_row($r);
  $tmembers=$row[0];
  $r=mssql_query('select count (*) from '.DB_GAM.'.dbo.cabal_character_table where Nation=1');
  $row = mssql_fetch_row($r);
  $cmembers=$row[0];
  $cper=round((100/$tmembers)*$cmembers,0);
  $r=mssql_query('select count (*) from '.DB_GAM.'.dbo.cabal_character_table where Nation=2');
  $row = mssql_fetch_row($r);
  $pmembers=$row[0];
  $pper=round((100/$tmembers)*$pmembers,0);
  
  echo '<table width="554" style="border:#333333 1px solid" cellpadding="2">';
  echo '<p class="orange"><strong>Tierra Gloriosa wins</strong></p>';
  echo '<tr style="background-color:#555555">';
  echo '<td height="24" width="277" style="padding-left:8px" align="center" class="blue"><strong>Capella wins</strong></td>';
  echo '<td width="277" style="padding-left:8px" align="center" class="red"><strong>Procyon wins</strong></td>';
  echo '</tr>';
  echo '<td style="padding-left:8px" align="center"><strong><span class="orange">'.$cwin.'</span></strong></td>';
  echo '<td style="padding-left:8px" align="center"><strong><span class="orange">'.$pwin.'</span></strong></td>';
  echo '</tr>';
  echo '</table>';
  
  echo '<table width="554" style="border:#333333 1px solid" cellpadding="2">';
  echo '<p class="orange"><strong>Last 5 Tierra Gloriosa results</strong></p>';
  echo '<tr style="background-color:#555555">';
  echo '<td height="24" width="277" style="padding-left:8px" align="center" class="blue"><strong>Capella</strong></td>';
  echo '<td width="277" style="padding-left:8px" align="center" class="red"><strong>Procyon</strong></td>';
  echo '</tr>';
  $r=mssql_query('select top 5 * from gamedb.dbo.cabal_instantwar_nationrewardwarresults order by rewardstartdatetime desc');
  for ($i=1;$i<=mssql_num_rows($r);$i++) {
    $row = mssql_fetch_row($r);
    $cap='';
    $proc='';
    if ($row[3]==1) { $proc='Winner';$cap='Loser'; }
    if ($row[2]==1) { $proc='Loser';$cap='Winner'; }
    echo '<tr style="background-color:#333333">';
    echo '<td style="padding-left:8px" align="center"><strong><span class="orange">'.$cap.'</span></strong></td>';
    echo '<td style="padding-left:8px" align="center"><strong><span class="orange">'.$proc.'</span></strong></td>';
    echo '</tr>';
    mssql_next_result($r);
  }
  echo '</table>';

  echo '<table width="554" style="border:#333333 1px solid" cellpadding="2">';
  echo '<p class="orange"><strong>Nation ratio</strong></p>';
  echo '<tr style="background-color:#555555">';
  echo '<td height="24" width="277" style="padding-left:8px" align="center" class="blue"><strong>Capella</strong></td>';
  echo '<td width="277" style="padding-left:8px" align="center" class="red"><strong>Procyon</strong></td>';
  echo '</tr>';
  echo '<tr style="background-color:#333333">';
  echo '<td style="padding-left:8px" align="center"><strong><span class="orange">'.$cper.' %</span></strong></td>';
  echo '<td style="padding-left:8px" align="center"><strong><span class="orange">'.$pper.' %</span></strong></td>';
  echo '</tr>';
  echo '</table>';
}


// Class decoding shamelessly stolen from john_d's cabaltoolz
function decode_style($r) {
  $gender_array = array('Male', 'Female', 'Male 2','Female 2','Male 3', 'Female 3');
  $aura_array = array('No aura','Land','Aqua','Wind','Flame','Freezing','Lightning');
  $classrank_array = array(1=>'Novice','Apprentice','Regular','Expert','A. Expert','Master',
                           'A. Master','G. Master','Completer','Transcender');
  $class_array = array(4=>'Force Archer',5=>'Force Shielder',6=>'Force Blader',9=>'Warrior',
                       10=>'Blader',11=>'Wizard',12=>'Force Archer',13=>'Force Shielder',14=>'Force Blader');

  $style['Gender'] = $gender_array[round($r / hexdec(4000000))];	
  $style['Aura'] = round(($r % hexdec(4000000)) / hexdec(200000))/2;
  $style['Aura_Name'] = $aura_array[$style['Aura']];
  $style['Hair'] = round(($r % hexdec(4000000) % hexdec(200000) ) / hexdec(20000));
  $style['Hair_Color'] = round((($r % hexdec(4000000)) % hexdec(20000)) / hexdec(2000));
  $style['Face'] = round(((($r % hexdec(4000000)) % hexdec(20000)) % hexdec(2000)) / hexdec(100));
  $style['Class_Rank'] = round((((($r % hexdec(4000000)) % hexdec(20000)) % hexdec(2000)) % hexdec(100)) / 8 );
  $style['Class_RankName']=$classrank_array[$style['Class_Rank']];
  $style['Class'] = (((($r % hexdec(4000000)) % hexdec(20000)) % hexdec(2000)) % hexdec(100)) -  (($style['Class_Rank'] -1) * 8) ;
  $style['Class_Name'] = $class_array[$style['Class']] ;
  return $style;  
} 
?>