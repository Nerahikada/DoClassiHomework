<?php

require_once 'vendor/autoload.php';

use Classi\Client;

$client = new Client('SASSI**********', 'YOUR PASSWORD HERE');
$list = $client->getHomeworkList();
$client->getLogger()->notice("しゅくだいをぜんぶしゅとくしたよ！");
foreach($list as $course){
	$client->getLogger()->notice($course->getName() . ' にとりくむよ！');
	foreach($course->getLectures() as $lecture){
		foreach($lecture->getContents() as $content){
			if(!$content->isFinished()){
				try{
					$content->doHomework();
				}catch(\Throwable $e){
					$client->getLogger()->error($e->getMessage());
				}
			}
		}
	}
}
