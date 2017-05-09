<?php
	include 'user.php';
	include 'course.php';
	include 'chapter.php';
	include 'lesson.php';
	include 'question_choices.php';
	include 'question_writes.php';

	class Home {
		public function SignOut() {
			$_SESSION['idAdmin'] = null;
			//session_destroy();
			header("Location: ../index.php");
			exit();
		}

		public function View() {
			echo "
				<div id='info1-div' class='rounded'>
				<link type='text/css' href='../../public/css/custom-admin.css' rel='stylesheet'>
				<div class = 'row'>			
					<div class='thumb-div rounded'>
						<a href='?controller=home&action=ManagerUser'>
							<img class='thumb-inside-div rounded' src='../../public/image/user-icon.png'>
						</a>
						<div id='text-inside-div' class='rounded'>
							<h2 id='text-inside-h2'>Users</h2>
						</div>
					</div>											
					<div class='thumb-div rounded'>
						<a href='?controller=home&action=ManagerCourse'>
							<img class='thumb-inside-div rounded' src='../../public/image/courses-icon.png'>
						</a>
						<div id='text-inside-div' class='rounded'>
							<h2 id='text-inside-h2'>Courses</h2>
						</div>
					</div>								
				</div>
			</div>
			";
		}

		public function ManagerUser() {
			$listUser = User::GetAll();
			echo "
				<script>
					function Notice() {
						alert('Delete success');
					}
				</script>
			";
			echo "
				<div id='info1-div' class='rounded'>
					<link type='text/css' href='../../public/css/custom-admin-user.css' rel='stylesheet'>
					<div id='chapter-inside-div' class='rounded'>
							<p>Users</p>
					</div>
					<form>
					<table class='table table-hover'>
						<thead>
							<tr>
							  <th>User ID</th>
							  <th>Email</th>
							  <th>First Name</th>
							  <th>Last Name</th>
							  <th>Total Score</th>
							  <th></th>
							  <th></th>
							</tr>
						</thead>
						<tbody>";
			foreach ($listUser as $row) {
				echo "
							<tr>
							  <td>{$row['id_user']}</td>
							  <td>{$row['email']}</td>
							  <td>{$row['first_name']}</td>
							  <td>{$row['last_name']}</td>
							  <td>{$row['total_score']}</td>
							  <td></td>";

							  	if ($row['id_user'] != 'admin') {
							  	echo "
							  		<td><button type='submit' class='btn btn-warning' name='removeUser' value='{$row['id_user']}' onclick='Notice()'>Remove</button></td>
									</tr>";
								}
								else {
									echo "<td></td>
										</tr>
									";
								}
			}
			echo "
						</tbody>
					</table>
					</form>
				</div>
			";	
		}

		public function DeleteUser() {
			$idUser = $_GET['removeUser'];
			User::DeleteUser($idUser);
			
			header("Location: home.php?controller=home&action=ManagerUser");
			exit();
		}

		public function ManagerCourse() {
			$listCourse = Course::GetAllCourse();
			$listChapter = Chapter::GetAllChapter();
			$listLesson = Lesson::GetAllLesson();
			$listQuesChoi = QuestionChoice::GetAllQuesChoi();
			$listQuesWri = QuestionWrite::GetAllQuesWri();

			$_SESSION['listCourse'] = array();
			array_push($_SESSION['listCourse'], $listCourse);

			$_SESSION['listChapter'] = array();
			array_push($_SESSION['listChapter'], $listChapter);

			$_SESSION['listLesson'] = array();
			array_push($_SESSION['listLesson'], $listLesson);

			$_SESSION['listQuesChoi'] = array();
			array_push($_SESSION['listQuesChoi'], $listQuesChoi);

			$_SESSION['listQuesWri'] = array();
			array_push($_SESSION['listQuesWri'], $listQuesWri);

			echo "
				<script>
					var listCourse =".json_encode($listCourse).";
					var listLesson =".json_encode($listLesson).";
					var listChapter =".json_encode($listChapter).";
					var listQuesChoi =".json_encode($listQuesChoi).";
					var listQuesWri =".json_encode($listQuesWri).";
				</script>
			";
			echo "
				<link type='text/css' href='../../public/css/custom-admin-courses.css' rel='stylesheet'>
				<div id='info1-div' class='rounded row'>
				<div class='selection-div'>
					<div id='chapter-inside-div' class='rounded'>
						<p>Course</p>";
				self::ColumnCourse();

			echo "
					</div>
					
				</div>
				<div class='selection-div'>
					<div id='chapter-inside-div' class='rounded'>
						<p>Chapter</p>
					</div>";
					self::ColumnChapter();
			echo "		
				</div>
				<div class='selection-div'>
					<div id='chapter-inside-div' class='rounded'>
						<p>Lesson</p>
					</div>";
					self::ColumnLesson();
			echo "
				</div>
				<div class='selection-div'>
					<div id='chapter-inside-div' class='rounded'>
						<p>Question</p>
					</div>";
					self::ColumnQuestion();
			echo "
				</div>
			</div>
			<div id='edit-div' class='row rounded'>";

			self::TableCourse();
			self::TableChapter();
			self::TableLesson();
			self::TableQuestionChoi();
			self::TableQuestionWri();
			
			echo "		
				</div>
			";

			self::GetChapterWithCourse();
			self::GetLessonWithChapter();
			self::GetQuestionWithLesson();
			self::ClearSelection();
		}
		private function ColumnCourse() {
			$count = 0;
			echo "
				<select id='course' size='10' class='selection rounded' onchange='GetChapterWithCourse()'>";
			foreach ($_SESSION['listCourse'] as $row) {
				foreach ($row as $tmp) {
					echo "
					<option id='{$count}' value='{$tmp['id_course']}'>{$tmp['name_course']}</option>
				";
				$count++;
				}
			}
			
			echo "
				</select>
			";
		}

		private function ColumnChapter() {
			echo "
				<select id='chapter' size='10' class='selection rounded' id='selectChapter' onchange='GetLessonWithChapter()'>
					</select>
			";
		}

		private function ColumnLesson() {
			echo "
				<select id='lesson' size='10' class='selection rounded' id='selectLesson' onchange='GetQuestionWithLesson()'>
					</select>
			";
		}

		private function ColumnQuestion() {
			echo "
				<select id='question' size='10' class='selection rounded' id='selectQuestion'>
					</select>
			";
		}

		private function TableCourse() {
			echo "
				<table class='table table-hover'>
					<thead><th>Course</th></thead>
					<tr>
						<td>id_course</td>
						<td><input type='txt' readonly></td>
					</tr>
					<tr>
						<td>name_course</td>
						<td><input type='txt'></td>
					</tr>
					<tr>
						<td><button type='submit' class='btn btn-primary'>Add</button> <button type='submit' class='btn btn-success'>Save</button></td>
					</tr>
				</table>
			";
		}

		private function TableChapter() {
			echo "
				<table class='table table-hover'>
					<thead><th>Chapter</th></thead>
					<tr>
						<td>id_chapter</td>
						<td><input type='txt' readonly></td>
					</tr>
					<tr>
						<td>id_course</td>
						<td><select><option>abc</option></select></td>
					</tr>
					<tr>
						<td>name_chapter</td>
						<td><input type='txt'></td>
					</tr>
					<tr>
						<td><button type='submit' class='btn btn-primary'>Add</button> <button type='submit' class='btn btn-success'>Save</button></td>
					</tr>
				</table>
			";
		}

		private function TableLesson() {
			echo "
				<table class='table table-hover'>
					<thead><th>Lesson</th></thead>
					<tr>
						<td>id_lesson</td>
						<td><input type='txt' readonly></td>
					</tr>
					<tr>
						<td>id_chapter</td>
						<td><select><option>abc</option></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt'></td>
					</tr>
					<tr>
						<td><button type='submit' class='btn btn-primary'>Add</button> <button type='submit' class='btn btn-success'>Save</button></td>
					</tr>
				</table>
			";
		}

		private function TableQuestionChoi() {
			echo "
				<table class='table table-hover'>
					<thead><th>Question_Choices</th></thead>
					<tr>
						<td>id</td>
						<td><input type='txt' readonly></td>
					</tr>
					<tr>
						<td>id_lesson</td>
						<td><select><option>abc</option></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt'></td>
					</tr>
					<tr>
						<td>choise 1</td>
						<td><input type='txt'></td>
						<td><input type='txt'></td>
						<td><button type='submit' class='btn btn-info'>Image Link</button></td>
					</tr>
					<tr>
						<td>choise 2</td>
						<td><input type='txt'></td>
						<td><input type='txt'></td>
						<td><button type='submit' class='btn btn-info'>Image Link</button></td>
					</tr>
					<tr>
						<td>choise 3</td>
						<td><input type='txt'></td>
						<td><input type='txt'></td>
						<td><button type='submit' class='btn btn-info'>Image Link</button></td>
					</tr>
					<tr>
						<td>answer</td>
						<td><input type='txt'></td>
					</tr>
					<tr>
						<td><button type='submit' class='btn btn-primary'>Add</button> <button type='submit' class='btn btn-success'>Save</button></td>
					</tr>
				</table>
			";
		}

		private function TableQuestionWri() {
			echo "
				<table class='table table-hover'>
					<thead><th>Question_Write</th></thead>
					<tr>
						<td>id</td>
						<td><input type='txt' readonly></td>
					</tr>
					<tr>
						<td>id_lesson</td>
						<td><select><option>abc</option></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt'></td>
					</tr>
					<tr>
						<td>answer</td>
						<td><input type='txt'></td>
					</tr>
					<tr>
						<td><button type='submit' class='btn btn-primary'>Add</button> <button type='submit' class='btn btn-success'>Save</button></td>
					</tr>
				</table>
			";
		}

		private function GetChapterWithCourse() {
			echo "
				<script>
					function GetChapterWithCourse() {
						var count = 0;
						var idCourse = document.getElementById('course').value;
						var select = document.getElementById('chapter');
						ClearSelection(select);
						for (var i = 0; i < listChapter.length; i++) {
							if (idCourse == listChapter[i]['id_course']) {
								var option = document.createElement('option');
								option.setAttribute('id',count);
								option.setAttribute('value',listChapter[i]['id_chapter']);
								var text = document.createTextNode(listChapter[i]['name_chapter']);
								option.appendChild(text);
								select.appendChild(option);
								count++;
							}
						}
					}
				</script>
			";
		}

		private function GetLessonWithChapter() {
			echo "
				<script>
					function GetLessonWithChapter() {
						var count = 0;
						var idChapter = document.getElementById('chapter').value;
						var select = document.getElementById('lesson');
						ClearSelection(select);
						for (var i = 0; i < listLesson.length; i++) {
							if (idChapter == listLesson[i]['id_chapter']) {
								var option = document.createElement('option');
								option.setAttribute('id',count);
								option.setAttribute('value',listLesson[i]['id_lesson']);
								var text = document.createTextNode(listLesson[i]['content_lesson']);
								option.appendChild(text);
								select.appendChild(option);
								count++;
							}
						}
					}
				</script>
			";
		}

		private function GetQuestionWithLesson() {
			echo "
				<script>
					function GetQuestionWithLesson() {
						var count = 0;
						var idLesson = document.getElementById('lesson').value;
						var select = document.getElementById('question');
						ClearSelection(select);
						for (var i = 0; i < listQuesChoi.length; i++) {
							if (idLesson == listQuesChoi[i]['id_lesson']) {
								var option = document.createElement('option');
								option.setAttribute('id',count);
								option.setAttribute('value',listQuesChoi[i]['id_question_choice']);
								var text = document.createTextNode(listQuesChoi[i]['content_question']);
								option.appendChild(text);
								select.appendChild(option);
								count++;
							}
						}

						for (var i = 0; i < listQuesWri.length; i++) {
							if (idLesson == listQuesWri[i]['id_lesson']) {
								var option = document.createElement('option');
								option.setAttribute('id',count);
								option.setAttribute('value',listQuesWri[i]['id_question_choice']);
								var text = document.createTextNode(listQuesWri[i]['content_question']);
								option.appendChild(text);
								select.appendChild(option);
								count++;
							}
						}
					}
				</script>
			";
		}

		private function ClearSelection() {
			echo "
				<script>
					function ClearSelection(list) {
						for (var i = list.options.length - 1; i >= 0;i--) {
							list.remove(i);
						}
					}
				</script>
			";
		}
	} 
?>