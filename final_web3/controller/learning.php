<?php
	include '../models/progress.php';
	include 'course.php';
	include 'chapter.php';
	include 'lesson.php';
	class Learning {
		public function View() {
			$listCourse = Course::GetAllCourse();
			echo "
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
						<div id='text-inside-div' class='rounded'>
							<h2 id='text-inside-h2'>LESSON {$count}</h2>
						</div>
						<div id='text2-inside-div' class='rounded'>
							<h2 id='text2-inside-h2'>{$row['content_lesson']}</h2>
						</div>
						<div id='button-inside-div' class='rounded'>
							<button type='submit' class='btn btn-info'>Start</button>
						</div>
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

		
	} 
?>