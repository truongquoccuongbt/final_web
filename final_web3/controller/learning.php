<?php
	include '../models/progress.php';
	include 'course.php';
	include 'chapter.php';
	include 'lesson.php';
	include 'question_choices.php';
	include 'question_writes.php';

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
					 	<tbody>
							<tr>
							  	<td>{$_SESSION['date']}</td>
							   	<td>{$_SESSION['score']}</td>
							   	<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			";
		}

		public function SignOut () {
			$_SESSION = array();
			session_destroy();
			header("Location: ../index.php");
			exit();
		}

		public function StartCourse () {
			$idCourse = $_GET['idCourse'];
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
					 	<tbody>
							<tr>
							  	<td>{$_SESSION['date']}</td>
							   	<td>{$_SESSION['score']}</td>
							   	<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			";
		}

		public function StartLesson () {
			$idChapter = $_GET['idChapter'];
			$idCourse = $_GET['idCourse'];
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
					 	<tbody>
							<tr>
							  	<td>{$_SESSION['date']}</td>
							   	<td>{$_SESSION['score']}</td>
							   	<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			";
		}

		public function StartQuestion () {
			$listQuesChoi = QuestionChoice::GetQuestionChoiceByIdLesson($_SESSION['idLesson']);
			$listQuesWri = QuestionWrite::GetQuestionWriteByIdLesson($_SESSION['idLesson']);
			$lengthOfListQuesChoi = sizeof($listQuesChoi);
			$lengthOfListQuesWri = sizeof($listQuesWri);

			echo "<script> var listQuesChoi=".json_encode($listQuesChoi).";";
			echo "var listQuesWri=".json_encode($listQuesWri).";";
			// echo "for (i in listQuesChoi) {
			// 		document.write(listQuesChoi[i]['picture_1']);
			//  	}";
			echo "var index = 0;var pic1 = 'picture_1'; var pic2 = 'picture_2'; var pic3 = 'picture_3';
			</script>";


			echo "
				<link type='text/css' href='../public/css/custom-learning-question.css' rel='stylesheet'>
				<div id='info1-div' class='rounded'>
					<div id='question-inside-div'> 
						<div id='chapter-inside-div' class='rounded'>
							<p id='title'><script>document.write(listQuesChoi[index]['content_question']);</script></p>
						</div>
						<div class = 'row'>
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
						<button type='button' class='btn btn-warning' id='skip-button'>Skip</button>
						<button type='button' class='btn btn-success' id='check-button' onclick='CheckQuestion()'>Check</button>
					</div>
				</div>
			";

			self::CheckQuestion();
		}	

		private function CheckQuestion () {
			echo "
				<script>
					function CheckQuestion () {
						var radio = document.getElementsByName('answser');
						var img = document.getElementById('answer-inside-img');
		
						for (var i = 0;i < radio.length; i++) {
							if (radio[i].checked) {
								if (radio[i].value == listQuesChoi[index]['answer']) {
									img.setAttribute('src','../public/image/true.PNG');
									document.getElementById('isTrue').innerHTML = 'TRUE';
									return;
								}
							}
						}
						img.setAttribute('src','../public/image/false.PNG');
						document.getElementById('isTrue').innerHTML = 'FALSE';
					}
				</script>
			";
		}
	} 
?>