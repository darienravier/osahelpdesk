<?php

class PageController extends Controller{

	public function main(){

		$this->renderView('main');

	}

	public function renderView($page){

		$this->f3->set('template', $this->f3->get('VIEWS').$page.'.htm');
		
		echo Template::instance()->render($this->f3->get('VIEWS').'layout.htm');

	}

	public function saveData($body, $direction, $sender, $type, $photo, $name, $date){

		$um = new OSAUserMapper($this->db);

		$um->body = $body;
		$um->direction = $direction;
		$um->sender = $sender;
		$um->type = $type;
		$um->photo = $photo;
		$um->name = $name;
		$um->date_posted = $date;
		$um->save();
	}


	public function createData(){

		


		$f = Faker\Factory::create();
		$numberOfUsers = 2;
		$staff = array("Czar", "Reggie", "Kat", "Andrei", "Kevin");
		$msgtype = array("SMS", "Tweet", "PM", "Email");
		$msgsender = array("SMS",  "Tweeter", "Facebook", "Email");

		for($i = 0; $i < $numberOfUsers; $i++){

			 //random in array
			// $msgtype = $f->type; //platform
			//$msgnum = $f->number;
			// $sm->sender = $f->type;
			// $sm->photo = $f->text;
			// $sm->date_post = $f->date;

			$msgnum = 2;
			$index = rand(0, 3);
			$sender = $msgsender[$index] ;
			$photo = $f->text;
			$name = $f->name;
			$tempname = $name;
			$mydate = $f->date;
			$type = $msgtype[$index];

			for($j = 0; $j < $msgnum; $j++){
				$body = $f->text;
				$direction = "in";
				$time = date('H:i:s', rand(1,54000));
				$time = date('H:i:s', strtotime($time));
				$name = $tempname;

				echo nl2br($name . "\n");
				echo nl2br($photo . "\n");
				echo nl2br($type . "\n");
				echo nl2br($direction . "\n");
				echo nl2br($sender . "\n");
				echo nl2br($mydate . "\n");
				echo nl2br($time . "\n");
				echo nl2br($body . "\n");
				echo nl2br("\n");

				$tempdate = $mydate . "-" . date('H:i:s', strtotime($time));

				$this->saveData($body, $direction, $sender, $type, $photo, $name, $tempdate);



				 $direction = "out";
				 $name = $staff[rand(0, 4)];
				 $body = $f->text;
				 $time = date('H:i:s', strtotime($time)+300);

				

				echo nl2br($name . "\n");
				echo nl2br($photo . "\n");
				echo nl2br($type . "\n");
				echo nl2br($direction . "\n");
				echo nl2br($sender . "\n");
				echo nl2br($mydate . "\n");
				echo nl2br($time . "\n");
				echo nl2br($body . "\n");
				echo nl2br("\n\n\n");

				$tempdate = $mydate . "-" . date('H:i:s', strtotime($time));

				$this->saveData($body, $direction, $sender, $type, $photo, $name, $tempdate);

			}
		}
	}

}
