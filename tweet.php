
<html>
<head>
</head>
<body>
<?php
$username=$_POST["uname"];    //get user name
$quote='"';
$count=$_POST['count'];        //get tweet count to retrive
$format='xml';
if(($tweet=@simplexml_load_file("http://api.twitter.com/1/statuses/user_timeline/{$username}.{$format}"))==false)  //check weather user exist or not if user exist then retrive his data
{
  echo"<h1>Error in retriving tweets User does not exist</h1> ";    //if user notexist give error
}
else
{
if($count>count($tweet->status))
{
	$count=count($tweet->status);
	echo"<h3>User has only ".$count." tweets</h3>";    //check no. or tweet entered is less than no. of tweet of user or not
}
echo"[";
for($i=0;$i<$count;$i++)
{
	if(stripos($tweet->status[$i]->text,"http:",0)>=0)  //check for presence of link
	$pr="true";
	else
	$pr="false";
	$text=$tweet->status[$i]->text;
	if($i<($count-1))                       //print data in json format
	print("{id:".$tweet->status[$i]->id.", tweet_text: ".$quote.$text.$quote.", word_count: ".strlen($text).", link_present: ".$pr."},");
	else
	print("{id:".$tweet->status[$i]->id.", tweet_text: ".$quote.$text.$quote.", word_count: ".strlen($text).", link_present: ".$pr."}");
}
echo"]";
}
?>
</body>
</html>
