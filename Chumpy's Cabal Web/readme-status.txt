 Cabal server status script v2.0
=================================

An improved server status script following on from VisualEvolution's simple status checker. I thought we could do better xP


 Installation
==============

Copy the files to your webserver, e.g. c:\xampp\htdocs\cabal for windows xampp users.

Open status.php, set your page title and mssql connection details. Also change the gamedb name if your is not "gamedb".

Set $maxplayers to the same as MaxUserNum= in your WorldSvr ini files.

Set the login server ip and port. It should be the same as the IP= and PORT= from your client internal.txt.

The channels array needs to be set up like this:

$channels = array(
 1=> array("number"=>1,  "type"=>0,        "name"=>"Channel 1 (Novice)",  "ip"=>"127.0.0.1", "port"=>"38111"  ),
 2=> array("number"=>2,  "type"=>0,        "name"=>"Channel 2 (Trade)",   "ip"=>"127.0.0.1", "port"=>"38112"  )
);

number = The channel number (GroupIdx= from WorldSvr ini)
type = The channel type. Used for channel color display.

       Channel Types
       0 = normal
       1 = PK
       4 = Premium
       8 = War
       16908368 = Tierra Gloriosa

name = What to display for the channel name
ip = The external IP of the channel (IPAddress= in the WorldSvr ini)
port = The external port of the channel (top of WorldSvr ini)

For more channels:

$channels = array(
 1=> array("number"=>1,  "type"=>0,        "name"=>"Channel 1 (Novice)",  "ip"=>"127.0.0.1", "port"=>"38111"  ),
 2=> array("number"=>2,  "type"=>0,        "name"=>"Channel 2 (Trade)",   "ip"=>"127.0.0.1", "port"=>"38112"  ),
 3=> array("number"=>3,  "type"=>1,        "name"=>"Channel 3 (PK)",      "ip"=>"127.0.0.1", "port"=>"38113"  ),
 4=> array("number"=>4,  "type"=>4,        "name"=>"Channel 4 (Premium)", "ip"=>"127.0.0.1", "port"=>"38114"  ),
 5=> array("number"=>5,  "type"=>8,        "name"=>"Channel 5 (War)",     "ip"=>"127.0.0.1", "port"=>"38115"  ),
 6=> array("number"=>10, "type"=>16908368, "name"=>"Channel 10 (TG)",     "ip"=>"127.0.0.1", "port"=>"38116"  )
);

Note the first number (1-6) always goes up in sequence and the last entry does not have an , at the end.