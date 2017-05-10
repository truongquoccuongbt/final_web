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
			self::DisplayTableCourse();
			self::DisplayTableChapter();
			self::DisplayTableLesson();
			self::DisplayTableQuestion();
			self::DisplayTableQuesChoi();
			self::DisplayTableQuesWri();
			self::ClearTableCourse();
			self::ClearTableChapter();
			self::ClearTableLesson();
			self::ClearTableQuesChoi();
			self::ClearTableQuesWri();
		}
		private function ColumnCourse() {
			$count = 0;
			echo "
				<select id='course' size='10' class='selection rounded' onchange='GetChapterWithCourse();DisplayTableCourse()'>";
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
				<select id='chapter' size='10' class='selection rounded' onchange='GetLessonWithChapter();DisplayTableChapter()'>
					</select>
			";
		}

		private function ColumnLesson() {
			echo "
				<select id='lesson' size='10' class='selection rounded' onchange='GetQuestionWithLesson();DisplayTableLesson()'>
					</select>
			";
		}

		private function ColumnQuestion() {
			echo "
				<select id='question' size='10' class='selection rounded' onchange='DisplayTableQuestion()'>
					</select>
			";
		}

		private function TableCourse() {
			echo "
				<table class='table table-hover'>
					<thead><th>Course</th></thead>
					<tr>
						<td>id_course</td>
						<td><input type='txt' readonly id='idCourse'></td>
					</tr>
					<tr>
						<td>name_course</td>
						<td><input type='txt' id='nameCourse'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary'>Add</button> <button type='submit' class='btn btn-success'>Save</button></td>
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
						<td><input type='txt' readonly id='idChapter'></td>
					</tr>
					<tr>
						<td>id_course</td>
						<td><select id='selectCourse' disabled='true'></select></td>
					</tr>
					<tr>
						<td>name_chapter</td>
						<td><input type='txt' id='nameChapter'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addCourse'>Add</button> <button type='submit' class='btn btn-success' name='saveCourse'>Save</button></td>
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
						<td><input type='txt' readonly id='idLesson'></td>
					</tr>
					<tr>
						<td>id_chapter</td>
						<td><select id='selectChapter' disabled='true'></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt' id='contentQues'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addLesson'>Add</button> <button type='submit' class='btn btn-success' name='saveLesson'>Save</button></td>
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
						<td><input type='txt' readonly id='idQuesChoi'></td>
					</tr>
					<tr>
						<td>id_lesson</td>
						<td><select id='selectLessonChoi' disabled='true'></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt' id='contentQuesChoi'></td>
					</tr>
					<tr>
						<td>choise 1</td>
						<td><input type='txt' id='choice1'></td>
						<td><input type='txt' id='pic1'></td>
						<td><button type='submit' class='btn btn-info'>Image Link</button></td>
					</tr>
					<tr>
						<td>choise 2</td>
						<td><input type='txt' id='choice2'></td>
						<td><input type='txt' id='pic2'></td>
						<td><button type='submit' class='btn btn-info'>Image Link</button></td>
					</tr>
					<tr>
						<td>choise 3</td>
						<td><input type='txt' id='choice3'></td>
						<td><input type='txt' id='pic3'></td>
						<td><button type='submit' class='btn btn-info'>Image Link</button></td>
					</tr>
					<tr>
						<td>answer</td>
						<td><input type='txt' id='ansChoi'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addQuesChoi'>Add</button> <button type='submit' class='btn btn-success' name='saveQuesChoi'>Save</button></td>
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
						<td><input type='txt' readonly id='idQuesWri'></td>
					</tr>
					<tr>
						<td>id_lesson</td>
						<td><select id='selectLessonWri' disabled='true'></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt' id='contentQuesWri'></td>
					</tr>
					<tr>
						<td>answer</td>
						<td><input type='txt' id='ansWri'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addQuesWri'>Add</button> <button type='submit' class='btn btn-success' name='saveQuesWri'>Save</button></td>
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
						var lesson = document.getElementById('lesson');
						var question = document.getElementById('question');
						ClearSelection(lesson);
						ClearSelection(question);
						ClearTableChapter();
						ClearTableLesson();
						ClearTableQuesChoi();
						ClearTableQuesWri();
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
						var question = document.getElementById('question');
						ClearSelection(question);
						ClearTableLesson();
						ClearTableQuesChoi();
						ClearTableQuesWri();
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
								option.setAttribute('value',listQuesWri[i]['id_question_write']);
								var text = document.createTextNode(listQuesWri[i]['content_question']);
								option.appendChild(text);
								select.appendChild(option);
								count++;
							}
						}

						ClearTableQuesChoi();
						ClearTableQuesWri();
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

		private function DisplayTableCourse() {
			echo "
				<script>
					function DisplayTableCourse() {
						var idCourse = document.getElementById('course').value;
						var id = document.getElementById('idCourse');
						var name = document.getElementById('nameCourse');
						for (var i = 0; i < listCourse.length; i++) {
							if (idCourse == listCourse[i]['id_course']) {
								id.value = listCourse[i]['id_course'];
								name.value = listCourse[i]['name_course'];
							}
						}
					}
				</script>
			";
		}

		private function DisplayTableChapter() {
			echo "
				<script>
					function DisplayTableChapter() {
						var idChapter = document.getElementById('chapter').value;
						var id = document.getElementById('idChapter');
						var name = document.getElementById('nameChapter');
						for (var i = 0; i < listChapter.length; i++) {
							if (idChapter == listChapter[i]['id_chapter']) {
								id.value = listChapter[i]['id_chapter'];
								name.value = listChapter[i]['name_chapter'];
							}
						}
					}
				</script>
			";
		}

		private function DisplayTableLesson() {
			echo "
				<script>
					function DisplayTableLesson() {
						var idLesson = document.getElementById('lesson').value;
						var id = document.getElementById('idLesson');
						var name = document.getElementById('contentQues');
						for (var i = 0; i < listLesson.length; i++) {
							if (idLesson == listLesson[i]['id_lesson']) {
								id.value = listLesson[i]['id_lesson'];
								name.value = listLesson[i]['content_lesson'];
							}
						}
					}
				</script>
			";
		}

		private function DisplayTableQuestion() {
			echo "
				<script>
					function DisplayTableQuestion() {
						var idQues = document.getElementById('question').value;
						if (idQues[1] == 'W') {
							ClearTableQuesChoi();
							DisplayTableQuesWri(idQues);
						}
						else {
							ClearTableQuesWri();
							DisplayTableQuesChoi(idQues);
						}
					}
				</script>
			";
		}

		private function DisplayTableQuesWri() {
			echo "
				<script>
					function DisplayTableQuesWri(idQues) {
						var idQuesWri = document.getElementById('idQuesWri');
						var contentQuesWri = document.getElementById('contentQuesWri');
						var ansWri = document.getElementById('ansWri');
						for (var i = 0; i < listQuesWri.length; i++) {
							if (idQues == listQuesWri[i]['id_question_write']) {
								idQuesWri.value = listQuesWri[i]['id_question_write'];
								contentQuesWri.value = listQuesWri[i]['content_question'];
								ansWri.value = listQuesWri[i]['answer'];
							}
						}
					}
				</script>
			";
		}

		private function DisplayTableQuesChoi() {
			echo "
				<script>
					function DisplayTableQuesChoi(idQues) {
						var idQuesChoi = document.getElementById('idQuesChoi');
						var contentQuesChoi = document.getElementById('contentQuesChoi');
						var choice1 = document.getElementById('choice1');
						var choice2 = document.getElementById('choice2');
						var choice3 = document.getElementById('choice3');

						var pic1 = document.getElementById('pic1');
						var pic2 = document.getElementById('pic2');
						var pic3 = document.getElementById('pic3');

						for (var i = 0; i < listQuesChoi.length; i++) {
							if (idQues == listQuesChoi[i]['id_question_choice']) {
								idQuesChoi.value = listQuesChoi[i]['id_question_choice'];
								contentQuesChoi.value = listQuesChoi[i]['content_question'];
								choice1.value = listQuesChoi[i]['choice_1'];
								choice2.value = listQuesChoi[i]['choice_2'];
								choice3.value = listQuesChoi[i]['choice_3'];
								pic1.value = listQuesChoi[i]['picture_1'];
								pic2.value = listQuesChoi[i]['picture_2'];
								pic3.value = listQuesChoi[i]['picture_3'];
								ansChoi.value = listQuesChoi[i]['answer'];
							}
						}
					}
				</script>
			";
		}

		private function ClearTableCourse() {
			echo "
				<script>
					function ClearTableCourse() {
						document.getElementById('idCourse').value = '';
						document.getElementById('nameCourse').value = '';
					}
				</script>
			";
		}

		private function ClearTableChapter() {
			echo "
				<script>
					function ClearTableChapter() {
						document.getElementById('idChapter').value = '';
						document.getElementById('nameChapter').value = '';
					}
				</script>
			";
		}

		private function ClearTableLesson() {
			echo "
				<script>
					function ClearTableLesson() {
						document.getElementById('idLesson').value = '';
						document.getElementById('contentQues').value = '';
					}
				</script>
			";
		}

		private function ClearTableQuesChoi() {
			echo "
				<script>
					function ClearTableQuesChoi() {
						document.getElementById('idQuesChoi').value = '';
						document.getElementById('contentQuesChoi').value = '';
						document.getElementById('choice1').value = '';
						document.getElementById('choice2').value = '';
						document.getElementById('choice3').value = '';

						document.getElementById('pic1').value = '';
						document.getElementById('pic2').value = '';
						document.getElementById('pic3').value = '';

						document.getElementById('ansChoi').value = '';
					}
				</script>
			";
		}

		private function ClearTableQuesWri() {
			echo "
				<script>
					function ClearTableQuesWri() {
						document.getElementById('idQuesWri').value = '';
						document.getElementById('contentQuesWri').value = '';
						document.getElementById('ansWri').value = '';
					}
				</script>
			";
		}
	} 
?>