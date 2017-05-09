<?php
	include 'course.php';
	include 'chapter.php';
	include 'lesson.php';
	include 'question_choices.php';
	include 'question_writes.php';
	include 'progress.php';

	class Learning {
		public function View() {
			$listCourse = Course::GetAllCourse();
			echo "
				<link type='text/css' href='../public/css/custom-learning.css' rel='stylesheet'>	
				<div id='info1-left-div'>
					<div id='info1-inside-left-div' class='rounded'> 
						<div id='chapter-inside-div' class='rounded'>
							<p>Select Course</p>
						</div>
						<div class = 'row'>
				";
			foreach ($listCourse as $row) {
				switch ($row['id_course']) {
					case 'VN':
						$idCourse = 'VN';
						echo "
								<div class='thumb-div rounded' style='background-image: url(../public/image/{$idCourse}-background.png)'>
									<a href='?controller=learning&action=StartCourse&idCourse=VN'>
										<img class='thumb-inside-div rounded' src='../public/image/{$idCourse}-flag.png'>
									</a>
									<div id='text-inside-div' class='rounded'>
										<h2 id='text-inside-h2'>{$row['name_course']}</h2>
									</div>
								</div>
						";
						break;
					case 'ENG':
						$idCourse = "ENG";
						echo "
								<div class='thumb-div rounded' style='background-image: url(../public/image/{$idCourse}-background.jpg)'>
									<a href='?controller=learning&action=StartCourse&idCourse=ENG'>
										<img class='thumb-inside-div rounded' src='../public/image/{$idCourse}-flag.jpg'>
									</a>
									<div id='text-inside-div' class='rounded'>
										<h2 id='text-inside-h2'>{$row['name_course']}</h2>
									</div>
								</div>
						";
						break;
					}
				}

			echo "</div>
				  </div>
				  </div>
			";			
			echo "
			<div id='info1-right-div'>
				<div id='info1-inside-right-div' class='rounded'>
					<div class='rounded' id='info1-username-inside-right-div'>
						<p id='text-username-inside-p'>Hi {$_SESSION['idUser']}</p>
					</div>
					<div id='info1-course-inside-right-div'>
						<p id='text-course-inside-p'>Current course :</p>
					</div>
					<table class='table table-hover'>
					 	<thead>
							<tr>
							  	<th>DATE</th>
							  	<th>SCORE</th>
							  	<th></th>
							</tr>
					  	</thead>
					 	<tbody>";
			self::PrintInforUser();
			
			echo "			
						</tbody>
					</table>
				</div>
			</div>
			";
		}

		public function SignOut () {
			$_SESSION['idUser'] = null;
			//session_destroy();
			header("Location: signin.php");
			exit();
		}

		private function ConvertDate($date) {
			$tmp = strtotime($date);
			return date('d/m/Y',$tmp);
		}

		private function PrintInforUser() {
			$length = sizeof($_SESSION['inforUser'][0]);
			$count = 0;
			if ($_SESSION['inforUser'] != null) {
				foreach ($_SESSION['inforUser'][0] as $row) {
					$count++;
					$date = strtotime($row['date']);
					$format = date("d/m/Y", $date);
					echo "
						<tr>
							<td>{$format}</td>
							<td>{$row['score']}</td>";
					if (isset($_SESSION['score']) && $count == $length) {
						echo "
								<td> +{$_SESSION['score']}</td>
								</tr>
							";
					}
					else {
						echo "
							<td></td>	
						</tr>
					";
					}
				}
			}
			else {
				echo "
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					";
			}
		}

		public function StartCourse () {
			$idCourse = $_GET['idCourse'];
			$_SESSION['idCourse'] = $idCourse;
			echo "
				<link type='text/css' href='../public/css/custom-learning-chapter.css' rel='stylesheet'>
				<div id='info1-left-div'>
					<div id='info1-inside-left-div' class='rounded'> 
						<div id='chapter-inside-div' class='rounded'>
							<p>Select Chapter</p>
						</div>
						<div class = 'row'>
				";
			switch ($idCourse) {
				case 'VN':
					$listChapter = Chapter::GetChapterWithIdCourse($idCourse);
					if (sizeof($listChapter) == 0) {
						echo "
							</div>
							</div>
							</div>
							";
						exit();
					} 
					else {
						foreach ($listChapter as $row) {
							echo "
								<div class='thumb-div rounded'>
									<a href='?controller=learning&action=StartLesson&idCourse=VN&idChapter={$row['id_chapter']}'>
										<img class='thumb-inside-div rounded' src='../public/image/{$row['name_chapter']}.png'>
									</a>
									<div id='text-inside-div' class='rounded'>
										<h2 id='text-inside-h2'>{$row['name_chapter']}</h2>
									</div>
								</div>
							";
						}
					}
					break;
				case "ENG":
					$listChapter = Chapter::GetChapterWithIdCourse($idCourse);
					if (sizeof($listChapter) == 0) {
						echo "
							</div>
							</div>
							</div>
							";
						exit();
					} 
					else {
						foreach ($listChapter as $row) {
							echo "
								<div class='thumb-div rounded'>
									<a href='?controller=learning&action=StartLesson&idCourse=ENG&idChapter={$row['id_chapter']}'>
										<img class='thumb-inside-div rounded' src='../public/image/{$row['name_chapter']}.png'>
									</a>
									<div id='text-inside-div' class='rounded'>
										<h2 id='text-inside-h2'>{$row['name_chapter']}</h2>
									</div>
								</div>
							";
						}
					}
					break;
			}

			echo "
				</div>
				</div>
				</div>
			";
			echo "
			<div id='info1-right-div'>
				<div id='info1-inside-right-div' class='rounded'>
					<div class='rounded' id='info1-username-inside-right-div'>
						<p id='text-username-inside-p'>Hi {$_SESSION['idUser']}</p>
					</div>
					<div id='info1-course-inside-right-div'>
						<p id='text-course-inside-p'>Current course {$idCourse}:</p>
					</div>
					<table class='table table-hover'>
					 	<thead>
							<tr>
							  	<th>DATE</th>
							  	<th>SCORE</th>
							  	<th></th>
							</tr>
					  	</thead>
					 	<tbody>";

			self::PrintInforUser();
			echo "		
						</tbody>
					</table>
				</div>
			</div>
			";
		}

		public function StartLesson () {
			$idChapter = $_GET['idChapter'];
			$idCourse = $_GET['idCourse'];
			$_SESSION['idChapter'] = $idChapter;
			$listLesson = Lesson::GetLessonByIdChapter($idChapter);
			$count = 0;
			echo "
				<link type='text/css' href='../public/css/custom-learning-lesson.css' rel='stylesheet'>
				<div id='info1-left-div'>
					<div id='info1-inside-left-div' class='rounded'> 
						<div id='chapter-inside-div' class='rounded'>
							<p>Select Lesson</p>
						</div>
						<div class = 'row'>
				";
			foreach ($listLesson as $row) {
				$count++;
				echo "
					<div class='thumb-div rounded'>
						<form method='get'>
							<div id='text-inside-div' class='rounded'>
								<h2 id='text-inside-h2'>LESSON {$count}</h2>
							</div>
							<div id='text2-inside-div' class='rounded'>
								<h2 id='text2-inside-h2'>{$row['content_lesson']}</h2>
							</div>
							<div id='button-inside-div' class='rounded'>
								<button type='submit' class='btn btn-info' name='start' value='{$row['id_lesson']}'>Start</button>
							</div>
						</form>
					</div>
				";
			}

			echo "
				</div>
				</div>
				</div>
			";
			echo "
			<div id='info1-right-div'>
				<div id='info1-inside-right-div' class='rounded'>
					<div class='rounded' id='info1-username-inside-right-div'>
						<p id='text-username-inside-p'>Hi {$_SESSION['idUser']}</p>
					</div>
					<div id='info1-course-inside-right-div'>
						<p id='text-course-inside-p'>Current course {$idCourse}:</p>
					</div>
					<table class='table table-hover'>
					 	<thead>
							<tr>
							  	<th>DATE</th>
							  	<th>SCORE</th>
							  	<th></th>
							</tr>
					  	</thead>
					 	<tbody>";

			self::PrintInforUser();			
			echo "
						</tbody>
					</table>
				</div>
			</div>
			";
		}

		public function StartQuestion () {
			$listQuesChoi = QuestionChoice::GetQuestionChoiceByIdLesson($_SESSION['idLesson']);
			$listQuesWri = QuestionWrite::GetQuestionWriteByIdLesson($_SESSION['idLesson']);

			
			self::StartQuestionChoi($listQuesChoi, $listQuesWri);
			self::CheckQuestion();
			self::ChangeQuestion();
			self::ClearnForm();
			self::ChangeForm();
			self::CheckAnswerWri();
			self::CreateFormResult();
		}

		private function StartQuestionChoi ($listQuesChoi, $listQuesWri) {
			echo "<script> var listQuesChoi=".json_encode($listQuesChoi).";";
			echo "var listQuesWri=".json_encode($listQuesWri).";";
			// echo "for (i in listQuesChoi) {
			// 		document.write(listQuesWri[i]['id_question_write']);
			//  	}";
			echo "var index = 0;var pic1 = 'picture_1'; var pic2 = 'picture_2'; var pic3 = 'picture_3'; var lengthOfQuesChoi = listQuesChoi.length;
				var lengthOfQuesWri = listQuesWri.length;
				var checkChangeForm = false;
				var point = 0;
				var numberOfQuestion = listQuesChoi.length + listQuesWri.length;
			</script>";


			echo "
				
				<div id='info1-div' class='rounded'>
					<div id='question-inside-div'> 
						<div id='chapter-inside-div' class='rounded'>
							<p id='title'><script>document.write(listQuesChoi[index]['content_question']);</script></p>
						</div>
						<div class = 'row' id='row'>
						<link type='text/css' href='../public/css/custom-learning-question.css' rel='stylesheet'>
			";

			echo "
				<script>
					function load(picture,idImg) {
						document.getElementById(idImg).setAttribute('src',picture);
					}
				</script>
			";
			echo "
							<div class='thumb-div rounded'>
								<img class='thumb-inside-div rounded' id='1' src='../public/image/blank.PNG' onload='load(listQuesChoi[index][pic1],1)'>
								<div class='radio-inside-div'>
									<input type='radio' name='answser' value='1'>
									<span id='a1'>
										<script>
											document.write(listQuesChoi[index]['choice_1']);
										</script>
									</span>
								</div>
							</div>	
							<div class='thumb-div rounded'>
								<img class='thumb-inside-div rounded' id='2' src='../public/image/blank.PNG' onload='load(listQuesChoi[index][pic2],2)'>
								<div class='radio-inside-div'>
									<input type='radio' name='answser' value='2'>
									<span id='a2'>
										<script>
											document.write(listQuesChoi[index]['choice_2']);
										</script>
									</span>
								</div>
							</div>	
							<div class='thumb-div rounded'>
								<img class='thumb-inside-div rounded' id='3' src='../public/image/blank.PNG' onload='load(listQuesChoi[index][pic3],3)'>
								<div class='radio-inside-div'>
									<input type='radio' name='answser' value='3'>
									<span id='a3'>
										<script>
											document.write(listQuesChoi[index]['choice_3']);
										</script>
									</span>
								</div>
							</div>
							<div id='answer-inside-div'>
								<img id='answer-inside-img'>
								<span id='isTrue'>
							</div>	
						</div>
					</div>
					<div id='button-inside-div'>
						<button type='button' class='btn btn-warning' id='skip-button' onclick='ChangeQuestion()' disabled = 'true'>Skip</button>
						<button type='button' class='btn btn-success' id='check-button' onclick='CheckQuestion()'>Check</button>
					</div>
				</div>
			";
		}	

		private function CheckQuestion () {
			echo "
				<script>
					function CheckQuestion () {
						var img = document.getElementById('answer-inside-img');

						if (checkChangeForm == true) {
							if (document.getElementById('answer').value == '') {
								alert('Write answer');
								return;
							}
							else {
								if (CheckAnswerWri() == true) {
									img.setAttribute('src','../public/image/true.PNG');
									document.getElementById('isTrue').innerHTML = 'TRUE';
									document.getElementById('answer').disabled = true;
									point++;
								}
								else {
									img.setAttribute('src','../public/image/false.PNG');
									document.getElementById('isTrue').innerHTML = 'FALSE';
									document.getElementById('answer').disabled = true;
								}
								document.getElementById('skip-button').disabled = false;
							}
						}
						else {
							if (CheckRadio() == false) {
								alert('Choose an answser');
								return;
							}

							document.getElementById('skip-button').disabled = false;
							var radio = document.getElementsByName('answser');

							for  (var i = 0; i < radio.length; i++) {
								radio[i].disabled = true;
							}
		
							for (var i = 0;i < radio.length; i++) {
								if (radio[i].checked) {
									if (radio[i].value == listQuesChoi[index]['answer']) {
										img.setAttribute('src','../public/image/true.PNG');
										document.getElementById('isTrue').innerHTML = 'TRUE';
										point++;
										return;
									}
								}
							}
							img.setAttribute('src','../public/image/false.PNG');
							document.getElementById('isTrue').innerHTML = 'FALSE';
						}
					}
				</script>
			";
		}

		private function ChangeQuestion () {
			echo "
				<script>
				function ChangeQuestion() {
					index++;
					if (checkChangeForm == false) {
						if (index >= listQuesChoi.length) {
							index = 0;
							ClearnForm('row');
							ChangeForm();
							checkChangeForm = true;
							return;
						}

						document.getElementById('skip-button').disabled = true;
						document.getElementById('a1').innerHTML = listQuesChoi[index]['choice_1'];
						document.getElementById('a2').innerHTML = listQuesChoi[index]['choice_2'];
						document.getElementById('a3').innerHTML = listQuesChoi[index]['choice_3'];
						document.getElementById('title').innerHTML = listQuesChoi[index]['content_question'];
						Clear();
					}
					else {
						if (index == listQuesWri.length) {
							ClearnForm('info1-div');
							CreateFormResult();
							return;
						}

						document.getElementById('ques').innerHTML = listQuesWri[index]['content_question'];
						document.getElementById('answer').disabled = false;
						document.getElementById('answer').value = '';
						document.getElementById('skip-button').disabled = true;

						var img = document.getElementById('answer-inside-img');
						img.removeAttribute('src');
						document.getElementById('isTrue').innerHTML = '';
					}
				}

				function Clear() {
					var ra = document.getElementsByName('answser');
					for (var i = 0;i < ra.length; i++) {
						ra[i].disabled = false;
						ra[i].checked = false;
					}

					var img = document.getElementById('answer-inside-img');
					img.removeAttribute('src');
					document.getElementById('isTrue').innerHTML = '';
				}

				function CheckRadio () {
					var ra = document.getElementsByName('answser');
					if (!ra[0].checked && !ra[1].checked && !ra[2].checked) {
						return false;
					}
					return true;
				}
				</script>
			";
		}

		private function ClearnForm () {
			echo "
				<script>
					function ClearnForm (id) {
						var row = document.getElementById(id);
						while(row.firstChild) {
							row.removeChild(row.firstChild);
						}
					}
				</script>
			";
		}

		private function ChangeForm () {
			echo "
				<script>
					function ChangeForm() {
						var div1 = document.createElement('div');
						div1.setAttribute('class','thumb-div rounded');
						var div2 = document.createElement('div');
						div2.setAttribute('class','thumb-div rounded');

						var p = document.createElement('p');
						p.setAttribute('id','ques');
						var textNode = document.createTextNode(listQuesWri[index]['content_question']);
						p.appendChild(textNode);
						var text = document.createElement('textarea');
						text.setAttribute('id','answer');

						var link = document.createElement('link');
						link.setAttribute('type','text/css');
						link.setAttribute('href','../public/css/custom-learning-question-writing.css');
						link.setAttribute('rel','stylesheet');

						div1.appendChild(p);
						div2.appendChild(text);
						var row = document.getElementById('row');
						row.appendChild(div1);
						row.appendChild(div2);
						row.appendChild(link);

						var divAns = document.createElement('div');
						divAns.setAttribute('id','answer-inside-div');
						var img = document.createElement('img');
						img.setAttribute('id','answer-inside-img');
						var span = document.createElement('span');
						span.setAttribute('id','isTrue');
						divAns.appendChild(img);
						divAns.appendChild(span);

						row.appendChild(divAns);
						
						document.getElementById('skip-button').disabled = true;
						document.getElementById('title').innerHTML = 'Translate';
					}
				</script>
			";
		}

		private function LoadQuestionWri() {
			echo "
				function LoadQuestionWri() {

				}
			";
		}

		private function CheckAnswerWri () {
			echo "
				<script>
					function CheckAnswerWri() {
						var result = listQuesWri[index]['answer'];
						var ans = document.getElementById('answer').value;
						
						if (result == ans) {
							return true;
						}
						return false;
					}
				</script>
			";
		}

		private function CreateFormResult () {
			echo "
				<script>
					function CreateFormResult() {
						var div = document.getElementById('info1-div');

						var link = document.createElement('link');
						link.setAttribute('type','text/css');
						link.setAttribute('href','../public/css/custom-learning-result.css');
						link.setAttribute('rel','stylesheet');
						div.appendChild(link);

						var divChild1 = document.createElement('div');
						divChild1.setAttribute('id','question-inside-div');				
		
						var h1 = document.createElement('h1');
						var textH1 = document.createTextNode('Lesson complete! +');
						h1.appendChild(textH1);
						var span = document.createElement('span');
						span.setAttribute('id','score');
						span.setAttribute('name','score');
						var textPoint = document.createTextNode(point);
						span.appendChild(textPoint);
						h1.appendChild(span);
						var text = document.createTextNode('XP');
						h1.appendChild(text);

						var p = document.createElement('p');
						p.setAttribute('id','true-answer');
						var textResult = document.createTextNode(point + '/' + numberOfQuestion);
						p.appendChild(textResult);

						divChild1.appendChild(h1);
						divChild1.appendChild(p);

						

						var divChild2 = document.createElement('div');
						var form = document.createElement('form');
						divChild2.setAttribute('id','button-inside-div');
						
						var button = document.createElement('button');
						button.setAttribute('type','submit');
						button.setAttribute('value', point);
						button.setAttribute('name','backLesson');
				
						button.setAttribute('class','btn btn-warning');
						button.setAttribute('id','check-button');
						var textButton = document.createTextNode('Back to lesson');
						button.appendChild(textButton);
						form.appendChild(button);
						divChild2.appendChild(form);
						
						div.appendChild(divChild1);
						div.appendChild(divChild2);
					}
				</script>
			";
		}

		public function BackLesson () {
			$point = $_GET['backLesson'];
			self::SavePointOnServer($point);
			$_SESSION['score'] = $point;
			self::ReGetProgressOfUser();
			header("Location: index_learning.php?controller=learning&action=StartLesson&idCourse={$_SESSION['idCourse']}&idChapter={$_SESSION['idChapter']} ");
			exit();
		}

		private function ReGetProgressOfUser() {
			$inforUser = Progress::GetProgressOfUser($_SESSION['idUser']);
			$_SESSION['inforUser'] = array();
			array_push($_SESSION['inforUser'], $inforUser);
		}

		public function SavePointOnServer($point) {
			$inforUser = Progress::GetProgressOfUser($_SESSION['idUser']);
			$date = date("d/m/Y");
			$checkExistUser = self::CheckExistProgressOfUser($inforUser, $_SESSION['idUser'], $date);
			
			if ($checkExistUser) {
				$user = Progress::GetProgressOfUserWithDate($_SESSION['idUser'], $date);
				$user[0]['score'] += $point;
				Progress::UpdateProgressOfUser($user[0]['id_user'], $user[0]['date'], $user[0]['score']); 
			}
			else {
				Progress::InsertProgressOfUser($_SESSION['idUser'], $date, $point);
			}
		}

		private function CheckExistProgressOfUser($inforUser, $idUser, $date) {
			foreach ($inforUser as $row) {
				$tmp = strtotime($row['date']);
				$formatDay = date('d/m/Y', $tmp);
				
				if ($idUser == $row['id_user'] && $date == $formatDay) {
					return true;
				}
			}
			return false;
		}
	} 
?>