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
			<div id='edit-div' class='row rounded'>
			<form>";

			self::TableCourse();
			self::TableChapter();
			self::TableLesson();
			self::TableQuestionChoi();
			self::TableQuestionWri();
			
			echo "
				</form>
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
			self::CreateNewId();
			self::AddChapter();
			self::AddLesson();
			self::AddQuesChoi();
			self::AddQuesWri();
			self::AddCourse();
			self::DisplayCourseOnTableChapter();
			self::DisplayChapterOnTableLesson();
			self::DisplayLessonOnTableQues();
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
			if (isset($_GET['checkIdCourse'], $_GET['checkNameCourse'])) {
				if ($_GET['checkIdCourse'] == 0) {
					$textId = "Only use characters a-z or number";
				}
				else if ($_GET['checkIdCourse'] == -1){
					$textId = "Length exceeds 5";
				}
				else {
					$textId = "";
				}

				if ($_GET['checkNameCourse'] == 0) {
					$textName = "Only use characters a-z or number";
				}
				else {
					$textName = "";
				}
			}

			echo "
				<table class='table table-hover'>
					<thead><th>Course</th></thead>
					<tr>
						<td>id_course</td>
						<td><input type='txt' readonly id='idCourse' name='idCourse'></td>
						<td name='noticeIdCourse' style='color:red;' id='noticeIdCourse'></td>
					</tr>
					<tr>
						<td>name_course</td>
						<td><input type='txt' id='nameCourse' name='nameCourse'></td>
						<td name='noticeNameCourse' style='color:red;' id='noticeNameCourse'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addCourse' onclick='AddCourse()'>Add</button> <button type='submit' class='btn btn-success' name='saveCourse'>Save</button></td>
					</tr>
				</table>
			";

			if (isset($_GET['checkIdCourse'],$_GET['checkNameCourse'])) {
				if ($_GET['checkIdCourse'] == 1) {
					echo "
						<script>
							document.getElementById('idCourse').value = '{$_SESSION['tmpIdCourse']}';
						</script>
					";
				}
				else if ($_GET['checkNameCourse'] == 1) {
					echo "
						<script>
							document.getElementById('nameCourse').value = '{$_SESSION['tmpNameCourse']}';
							document.getElementById('idCourse').readOnly = false;
						</script>
					";
				}
				echo "
					<script>
						document.getElementById('noticeIdCourse').textContent = '{$textId}';
						document.getElementById('noticeNameCourse').textContent = '{$textName}';
					</script>
				";
			}
		}

		private function TableChapter() {
			echo "
				<table class='table table-hover'>
					<thead><th>Chapter</th></thead>
					<tr>
						<td>id_chapter</td>
						<td><input type='txt' readonly id='idChapter' name='idChapter'></td>
					</tr>
					<tr>
						<td>id_course</td>
						<td><select id='selectCourse' disabled='true' name='selectCourse'></select></td>
					</tr>
					<tr>
						<td>name_chapter</td>
						<td><input type='txt' id='nameChapter' name='nameChapter'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addChapter' onclick='AddChapter()'>Add</button> <button type='submit' class='btn btn-success' name='saveChapter'>Save</button></td>
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
						<td><input type='txt' readonly id='idLesson' name='idLesson'></td>
					</tr>
					<tr>
						<td>id_chapter</td>
						<td><select id='selectChapter' name='selectChapter' disabled='true'></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt' id='contentLesson' name='contentLesson'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addLesson' onclick='AddLesson()'>Add</button> <button type='submit' class='btn btn-success' name='saveLesson'>Save</button></td>
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
						<td><input type='txt' readonly id='idQuesChoi' name='idQuesChoi'></td>
					</tr>
					<tr>
						<td>id_lesson</td>
						<td><select id='selectLessonChoi' disabled='true' name='selectLessonChoi'></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt' id='contentQuesChoi' name='contentQuesChoi'></td>
					</tr>
					<tr>
						<td>choise 1</td>
						<td><input type='txt' id='choice1' name='choice1'></td>
						<td colspan='2'><input type='file' name='pic1'></td>
					</tr>
					<tr>
						<td>choise 2</td>
						<td><input type='txt' id='choice2' name='choice2'></td>
						<td colspan='2'><input type='file' name='pic2'></td>
					
					</tr>
					<tr>
						<td>choise 3</td>
						<td><input type='txt' id='choice3' name='choice3'></td>
						<td colspan='2'><input type='file' name='pic3'></td>
					</tr>
					<tr>
						<td>answer</td>
						<td><input type='txt' id='ansChoi' name='ansChoi'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addQuesChoi' onclick='AddQuesChoi()'>Add</button> <button type='submit' class='btn btn-success' name='saveQuesChoi'>Save</button></td>
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
						<td><input type='txt' readonly id='idQuesWri' name='idQuesWri'></td>
					</tr>
					<tr>
						<td>id_lesson</td>
						<td><select id='selectLessonWri' disabled='true' name='selectLessonWri'></select></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td><input type='txt' id='contentQuesWri' name='contentQuesWri'></td>
					</tr>
					<tr>
						<td>answer</td>
						<td><input type='txt' id='ansWri' name='ansWri'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addQuesWri' onclick='AddQuesWri()'>Add</button> <button type='submit' class='btn btn-success' name='saveQuesWri'>Save</button></td>
					</tr>
				</table>
			";
		}

		private function GetChapterWithCourse() {
			echo "
				<script>
					function GetChapterWithCourse() {
						document.getElementById('selectCourse').disabled = true;
						document.getElementById('selectChapter').disabled = true;
						document.getElementById('selectLessonChoi').disabled = true;
						document.getElementById('selectLessonWri').disabled = true;
						document.getElementById('idCourse').readOnly = true;
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
						document.getElementById('selectCourse').disabled = true;
						document.getElementById('selectChapter').disabled = true;
						document.getElementById('selectLessonChoi').disabled = true;
						document.getElementById('selectLessonWri').disabled = true;
						document.getElementById('idCourse').readOnly = true;
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
						document.getElementById('selectCourse').disabled = true;
						document.getElementById('selectChapter').disabled = true;
						document.getElementById('selectLessonChoi').disabled = true;
						document.getElementById('selectLessonWri').disabled = true;
						document.getElementById('idCourse').readOnly = true;
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
						var name = document.getElementById('contentLesson');
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
						document.getElementById('selectCourse').disabled = true;
						document.getElementById('selectChapter').disabled = true;
						document.getElementById('selectLessonChoi').disabled = true;
						document.getElementById('selectLessonWri').disabled = true;
						document.getElementById('idCourse').readOnly = true;

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
						document.getElementById('selectCourse').disabled = true;
						document.getElementById('selectChapter').disabled = true;
						document.getElementById('selectLessonChoi').disabled = true;
						document.getElementById('selectLessonWri').disabled = true;
						document.getElementById('idCourse').readOnly = true;

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
						document.getElementById('contentLesson').value = '';
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

		private function CreateNewId() {
			echo "
				<script>
					function CreateNewId(list, id, idCode) {
						var tmp = list[list.length - 1][idCode];
						tmp = tmp.replace(id,'');
						var count = parseInt(tmp) + 1;

						if (id.length == 1) {
							switch (count.toString().length) {
								case 1:
									id = id + '000' + count.toString();
									break;
								case 2:
									id = id + '00' + count.toString();
									break;
								case 3:
									id = id + '0' + count.toString();
									break;
								default:
									id = id + count.toString();
									break;

							}
						}
						else {
							switch (count.toString().length) {
								case 1:
									id = id + '00' + count.toString();
									break;
								case 2: 
									id = id + '0' + count.toString();
									break;
								default:
									id = id + count.toString();
									break;
							}
						}
						return id;
					}
				</script>
			";
		}

		private function AddChapter() {
			echo "
				<script>
					function AddChapter() {
						document.getElementById('selectCourse').disabled = false;
						DisplayCourseOnTableChapter();
						ClearTableChapter();
						var id = 'C';
						id = CreateNewId(listChapter, id, 'id_chapter');
						document.getElementById('idChapter').value = id;
					}
				</script>
			";
		}

		private function AddLesson() {
			echo "
				<script>
					function AddLesson() {
						document.getElementById('selectChapter').disabled = false;
						DisplayChapterOnTableLesson();
						ClearTableLesson();
						var id = 'L';
						id = CreateNewId(listLesson, id, 'id_lesson');
						document.getElementById('idLesson').value = id;
					}
				</script>
			";
		}

		private function AddQuesChoi() {
			echo "
				<script>
					function AddQuesChoi() {
						document.getElementById('selectLessonChoi').disabled = false;
						DisplayLessonOnTableQues('selectLessonChoi');
						ClearTableQuesChoi();
						var id = 'QC';
						id = CreateNewId(listQuesChoi, id, 'id_question_choice');
						document.getElementById('idQuesChoi').value = id;
					}
				</script>
			";
		}

		private function AddQuesWri() {
			echo "
				<script>
					function AddQuesWri() {
						document.getElementById('selectLessonWri').disabled = false;
						DisplayLessonOnTableQues('selectLessonWri');
						ClearTableQuesWri();
						var id = 'QW';
						id = CreateNewId(listQuesWri, id, 'id_question_write');
						document.getElementById('idQuesWri').value = id;
					}
				</script>
			";
		}

		private function AddCourse() {
			echo "
				<script>
					function AddCourse() {
						document.getElementById('idCourse').readOnly = false;
						ClearTableCourse();
					}
				</script>
			";
		}

		private function DisplayCourseOnTableChapter() {
			echo "
				<script>
					function DisplayCourseOnTableChapter() {
						var select = document.getElementById('selectCourse');
						for (var i = 0;i < listCourse.length;i++) {
							var option = document.createElement('option');
							option.setAttribute('value',listCourse[i]['id_course']);
							var text = document.createTextNode(listCourse[i]['name_course']);
							option.appendChild(text);
							select.appendChild(option);
						}
					}
				</script>
			";
		}

		private function DisplayChapterOnTableLesson() {
			echo "
				<script>
					function DisplayChapterOnTableLesson() {
						var select = document.getElementById('selectChapter');
						for (var i = 0;i < listChapter.length;i++) {
							var option = document.createElement('option');
							option.setAttribute('value',listChapter[i]['id_chapter']);
							var text = document.createTextNode(listChapter[i]['name_chapter']);
							option.appendChild(text);
							select.appendChild(option);
						}
					}
				</script>
			";
		}

		private function DisplayLessonOnTableQues() {
			echo "
				<script>
					function DisplayLessonOnTableQues(selection) {
						var select = document.getElementById(selection);
						for (var i = 0;i < listLesson.length;i++) {
							var option = document.createElement('option');
							option.setAttribute('value',listLesson[i]['id_lesson']);
							var text = document.createTextNode(listLesson[i]['content_lesson']);
							option.appendChild(text);
							select.appendChild(option);
						}
					}
				</script>
			";
		}

		public function SaveCourse() {
			$idCourse = $_GET['idCourse'];
			$nameCourse = $_GET['nameCourse'];

			if (strlen($idCourse) > 5) {
				$checkIdCourse = -1;
			}
			else if (!self::CheckInput($idCourse)) {
				$checkIdCourse = 0;
			}
			else {
				$checkIdCourse = 1;
			}

			self::CheckInput($nameCourse) ? $checkNameCourse = 1 : $checkNameCourse = 0;
			if ($checkIdCourse == 1 && $checkNameCourse == 1) {
				echo $check;
				$check = Course::InsertCourse($idCourse, $nameCourse);
				if ($check == false) {
					echo "
						<script>
							alert('Add fail!!!Id course is duplicate');
							window.location = 'home.php?controller=home&action=ManagerCourse';
						</script>

					";
				}
				else {
					echo "
				 	<script>alert('Add success');
				 	window.location = 'home.php?controller=home&action=ManagerCourse';
				 	</script>
					";
				}
			}
			else {
				$_SESSION['tmpIdCourse'] = $idCourse;
				$_SESSION['tmpNameCourse'] = $nameCourse;
				header("Location: home.php?controller=home&action=ManagerCourse&checkIdCourse={$checkIdCourse}&checkNameCourse={$checkNameCourse}");
			}
		}

		private function CheckInput($input) {
			$pattern = "/^[0-9a-zA-z]/";
			return preg_match($pattern, $input) ? true : false;
		}
	} 
?>