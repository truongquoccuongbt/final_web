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
				<form>
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
				</form>
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
			$textName = "";
			if (isset($_GET['checkNameChapter'])) {
				$textName = "Only use a-z characters or number";
			}
			echo "
				<form>
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
					
					<tr><tr>
						<td>name_chapter</td>
						<td><input type='txt' id='nameChapter' name='nameChapter'></td>
						<td name='noticeNameChapter' style='color:red;' id='noticeNameChapter'></td>
					</tr>
						<td><button type='button' class='btn btn-primary' id='addChapter' onclick='AddChapter()'>Add</button> <button type='submit' class='btn btn-success' name='saveChapter'>Save</button></td>
					</tr>
				</table>
				</form>
			";

			if (isset($_GET['checkNameChapter'])) {
				echo "
					<script>
						document.getElementById('noticeNameChapter').textContent = '{$textName}';
					</script>
				";
			}
		}

		private function TableLesson() {
			$textContent = "";
			if (isset($_GET['checkContentLesson'])) {
				$textContent = "Only use a-z characters or number";
			}
			echo "
				<form>
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
						<td name='noticeContentLesson' style='color:red;' id='noticeContentLesson'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addLesson' onclick='AddLesson()'>Add</button> <button type='submit' class='btn btn-success' name='saveLesson'>Save</button></td>
					</tr>
				</table>
				</form>
			";
			if (isset($_GET['checkContentLesson'])) {
				echo "
					<script>
						document.getElementById('noticeContentLesson').textContent = '{$textContent}';
					</script>
				";
			}
		}

		private function TableQuestionChoi() {
			if (isset($_GET['checkContentQuesChoi'],$_GET['checkChoice_1'],$_GET['checkChoice_2'],$_GET['checkChoice_3'], $_GET['checkPic1'], $_GET['checkPic2'], $_GET['checkPic3'])) {
				$_GET['checkContentQuesChoi'] == 1 ? $textContentQuesChoi = "" : $textContentQuesChoi = "Only use a-z characters or number";
				$_GET['checkChoice_1'] == 1 ? $textChoice1 = "" : $textChoice1 = "Only use a-z characters or number";
				$_GET['checkChoice_2'] == 1 ? $textChoice2 = "" : $textChoice2 = "Only use a-z characters or number";
				$_GET['checkChoice_3'] == 1 ? $textChoice3 = "" : $textChoice3 = "Only use a-z characters or number";
				$_GET['checkPic1'] == 1 ? $textPic1 = "" : $textPic1 = "Only use .JPEG, .PNG, .JPG";
				$_GET['checkPic2'] == 1 ? $textPic2 = "" : $textPic2 = "Only use .JPEG, .PNG, .JPG";
				$_GET['checkPic3'] == 1 ? $textPic3 = "" : $textPic3 = "Only use .JPEG, .PNG, .JPG";
				echo $_GET['checkPic3'];
			}
			echo "
				<form method='post' action='home.php' enctype='multipart/form-data'>
				<table class='table table-hover'>
					<thead><th style='width: 30%'>Question_Choices</th>
						   <th style='width: 20%'></th>
						   <th style='width: 10%'></th>
						   <th style='width: 40%'></th>
					</thead>
					<tr>
						<td>id</td>
						<td><input type='txt' readonly id='idQuesChoi' name='idQuesChoi'></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>id_lesson</td>
						<td>
							<select id='selectLessonChoi' disabled='true' name='selectLessonChoi'></select>
						</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>content_question</td>
						<td>
							<span id='noticeContentQuesChoi' style='color:red;'></span>
							<input type='txt' id='contentQuesChoi' name='contentQuesChoi'>
						</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>choise 1</td>
						<td>
							<span id='noticeChoice1' style='color:red;'></span>
							<input type='txt' id='choice1' name='choice1'>
						</td>
						<td colspan='2'>
							<span id='noticePic1' style='color:red;'></span>
							<input type='file' name='pic1'/>
						</td>
					</tr>
					<tr>
						<td>choise 2</td>
						<td>
							<span id='noticeChoice2' style='color:red;'></span>
							<input type='txt' id='choice2' name='choice2'>
						</td>
						<td colspan='2'>
							<span id='noticePic2' style='color:red;'></span>
							<input type='file' name='pic2'/>
						</td>
					</tr>
					<tr>
						<td>choise 3</td>
						<td>
							<span id='noticeChoice3' style='color:red;'></span>
							<input type='txt' id='choice3' name='choice3'>
						</td>
						<td colspan='2'>
							<span id='noticePic3' style='color:red;'></span>
							<input type='file' name='pic3'/>
						</td>
					</tr>
					<tr>
						<td>answer</td>
						<td><select id='selectAns' name='selectAns'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
							</select>
						</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addQuesChoi' onclick='AddQuesChoi()'>Add</button> <button type='submit' class='btn btn-success' name='saveQuesChoi'>Save</button></td>
					</tr>
				</table>
				</form>
			";

			if (isset($_GET['checkContentQuesChoi'],$_GET['checkChoice_1'],$_GET['checkChoice_2'],$_GET['checkChoice_3'], $_GET['checkPic1'], $_GET['checkPic2'], $_GET['checkPic3'])) {
					if (!$_GET['checkContentQuesChoi']) {
						echo "<script>document.getElementById('noticeContentQuesChoi').innerHTML = '{$textContentQuesChoi}'</script>";
					}
					if (!$_GET['checkChoice_1']) {
						echo "<script>document.getElementById('noticeChoice1').innerHTML = '{$textChoice1}'</script>";
					}
					if (!$_GET['checkChoice_2']) {
						echo "<script>document.getElementById('noticeChoice2').innerHTML = '{$textChoice2}'</script>";
					}
					if (!$_GET['checkChoice_3']) {
						echo "<script>document.getElementById('noticeChoice3').innerHTML = '{$textChoice3}'</script>";
					}
					if (!$_GET['checkPic1']) {
						echo "<script>document.getElementById('noticePic1').innerHTML = '{$textPic1}'</script>";
					}
					if (!$_GET['checkPic2']) {
						echo "<script>document.getElementById('noticePic2').innerHTML = '{$textPic2}'</script>";
					}
					if (!$_GET['checkPic3']) {
						echo "<script>document.getElementById('noticePic3').innerHTML = '{$textPic3}'</script>";
					}
			}
		}

		private function TableQuestionWri() {
			if (isset($_GET['checkContentQuesWri'], $_GET['checkAnsWri'])) {
				$_GET['checkContentQuesWri'] == 0 ? $textContentQuesWri = "Only use a-z characters or number" : $textContentQuesWri = "";
				$_GET['checkAnsWri'] == 0 ? $textAnsWri = "Only use a-z characters or number" : $textAnsWri = "";
			}
			echo "
				<form>
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
						<td id='noticeContentQuesWri' style='color:red;'></td>
					</tr>
					<tr>
						<td>answer</td>
						<td><input type='txt' id='ansWri' name='ansWri'></td>
						<td id='noticeAnsWri' style='color:red;'></td>
					</tr>
					<tr>
						<td><button type='button' class='btn btn-primary' id='addQuesWri' onclick='AddQuesWri()'>Add</button> <button type='submit' class='btn btn-success' name='saveQuesWri'>Save</button></td>
					</tr>
				</table>
				</form>
			";
			if (isset($_GET['checkContentQuesWri'], $_GET['checkAnsWri'])) {
				echo "
					<script>
						document.getElementById('noticeContentQuesWri').textContent = '{$textContentQuesWri}';
						document.getElementById('noticeAnsWri').textContent = '{$textAnsWri}';
					</script>
				";
			}
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
			$pattern = "/[\\$\\&\\^\\<\\>\\?\\*\\@\\#]/";
			return preg_match($pattern, $input) ? false : true;
		}

		public function SaveChapter() {
			$idChapter = $_GET['idChapter'];
			$idCourse = $_GET['selectCourse'];
			$nameChapter = $_GET['nameChapter'];

			self::CheckInput($nameChapter) ? $checkNameChapter = 1 : $checkNameChapter = 0;
			if ($checkNameChapter == 1) {
				$checkInsert = Chapter::InsertChapter($idChapter, $idCourse, $nameChapter);
				if ($checkInsert) {
					echo "
				 	<script>alert('Add success');
				 	window.location = 'home.php?controller=home&action=ManagerCourse';
				 	</script>
					";
				}
				else {
					echo "
						<script>
							alert('Add fail!!!Id chapter is duplicate');
							window.location = 'home.php?controller=home&action=ManagerCourse';
						</script>
					";
				}
			}
			else {
				$_SESSION['tmpIdChapter'] = $idChapter;
				$_SESSION['tmpCourse'] = $idCourse;
				$_SESSION['tmpNameChapter'] = $nameChapter;

				header("Location: home.php?controller=home&action=ManagerCourse&checkNameChapter={$checkNameChapter}");
			}
		}

		public function SaveLesson() {
			$idLesson = $_GET['idLesson'];
			$idChapter = $_GET['selectChapter'];
			$contentLesson = $_GET['contentLesson'];

			self::CheckInput($contentLesson) ? $checkContentLesson = 1 : $checkContentLesson = 0;
			if ($checkContentLesson == 1) {
				$checkInsert = Lesson::InsertLesson($idLesson, $idChapter, $contentLesson);
				if ($checkInsert) {
					echo "
				 	<script>alert('Add success');
				 	window.location = 'home.php?controller=home&action=ManagerCourse';
				 	</script>
					";
				}
				else {
					echo "
						<script>
							alert('Add fail!!!Id lesson is duplicate');
							window.location = 'home.php?controller=home&action=ManagerCourse';
						</script>
					";
				}
			}
			else {
				$_SESSION['tmpIdLesson'] = $idLesson;
				$_SESSION['tmpIdChapter'] = $idChapter;
				$_SESSION['tmpContentLesson'] = $contentLesson;

				header("Location: home.php?controller=home&action=ManagerCourse&checkContentLesson={$checkContentLesson}");
			}
		}

		public function SaveQuesChoi() {
			$idQuesChoi = $_POST['idQuesChoi'];
			$idLesson = $_POST['selectLessonChoi'];
			$contentQuesChoi = $_POST['contentQuesChoi'];
			$choice_1 = $_POST['choice1'];
			$choice_2 = $_POST['choice2'];
			$choice_3 = $_POST['choice3'];
			$answer = $_POST['selectAns'];
	
			if (isset($_FILES['pic1'],$_FILES['pic2'], $_FILES['pic3'])) {	
				
				$pic1 = $_FILES['pic1']['name'];
				$pic2 = $_FILES['pic2']['name'];
				$pic3 = $_FILES['pic3']['name'];
				
				$_SESSION['tmpPath1'] = $_FILES['pic1']['tmp_name'];
				$_SESSION['tmpPath2'] = $_FILES['pic2']['tmp_name'];
				$_SESSION['tmpPath3'] = $_FILES['pic3']['tmp_name'];

				$link1 = "../../public/image/".$pic1;
				$link2 = "../../public/image/".$pic2;
				$link3 = "../../public/image/".$pic3;

				$linkSql1 = "../public/image/".$pic1;
				$linkSql2 = "../public/image/".$pic2;
				$linkSql3 = "../public/image/".$pic3;

				self::CheckExtendOfPic($pic1) ? $checkPic1 = 1 : $checkPic1 = 0;
				self::CheckExtendOfPic($pic2) ? $checkPic2 = 1 : $checkPic2 = 0;
				self::CheckExtendOfPic($pic3) ? $checkPic3 = 1 : $checkPic3 = 0;

				self::CheckInput($contentQuesChoi) ? $checkContentQuesChoi = 1 : $checkContentQuesChoi = 0;
				self::CheckInput($choice_1) ? $checkChoice_1 = 1 : $checkChoice_1 = 0;
				self::CheckInput($choice_2) ? $checkChoice_2 = 1 : $checkChoice_2 = 0;
				self::CheckInput($choice_3) ? $checkChoice_3 = 1 : $checkChoice_3 = 0;

				if ($checkContentQuesChoi  && $checkChoice_1 && $checkChoice_2 && $checkChoice_3 && $checkPic1 && $checkPic2 && $checkPic3) {
					$checkInsert = QuestionChoice::InsertQuesChoi($idQuesChoi, $idLesson, $contentQuesChoi, $choice_1, $choice_2, $choice_3, $linkSql1, $linkSql2, $linkSql3, $answer);

					move_uploaded_file($_SESSION['tmpPath1'], $link1);
					move_uploaded_file($_SESSION['tmpPath2'], $link2);
					move_uploaded_file($_SESSION['tmpPath3'], $link3);
					if ($checkInsert) {
						echo "
					  	<script>
					  		alert('Add success');
					  		window.location = 'home.php?controller=home&action=ManagerCourse';
					  	</script>
						";
					}
					else {
						echo "
						 	<script>
						 		alert('Save fail');
						 		window.location = 'home.php?controller=home&action=ManagerCourse';
						 	</script>
						";
					}
				}
				else {
					$_SESSION['tmpIdQuesChoi'] = $idQuesChoi;
					$_SESSION['tmpIdLesson'] = $idLesson;
					$_SESSION['tmpContentQuesChoi'] = $contentQuesChoi;
					$_SESSION['tmpChoice1'] = $choice_1;
					$_SESSION['tmpChoice2'] = $choice_2;
					$_SESSION['tmpChoice3'] = $choice_3;
					$_SESSION['tmpLink1'] = $link1;
					$_SESSION['tmpLink2'] = $link2;
					$_SESSION['tmpLink3'] = $link3;
					$_SESSION['tmpAns'] = $answer;

					echo "
						 	<script>
						 		alert('Add fail!!!Id question choice is duplicate');
						 		window.location = 'home.php?controller=home&action=ManagerCourse&checkIdQues={$checkIdQues}&checkLesson={$checkLesson}&checkContentQuesChoi={$checkContentQuesChoi}&checkChoice_1={$checkChoice_1}&checkChoice_2={$checkChoice_2}&checkChoice_3={$checkChoice_3}&checkPic1={$checkPic1}&checkPic2={$checkPic2}&checkPic3={$checkPic3}';
						 	</script>
						";
					//header("Location: home.php?controller=home&action=ManagerCourse&checkIdQues={$checkIdQues}&checkLesson={$checkLesson}&checkContentQuesChoi={$checkContentQuesChoi}&checkChoice_1={$checkChoice_1}&checkChoice_2={$checkChoice_2}&checkChoice_3={$checkChoice_3}&checkPic1={$checkPic1}&checkPic2={$checkPic2}&checkPic3={$checkPic3}");
				}
			}
		}

		private function CheckExtendOfPic($picName) {
			$allowed = array("jpeg","jpg","png");
			$extend = pathinfo($picName, PATHINFO_EXTENSION);

			if (in_array($extend,$allowed)) {
				return true;
			}
			return false;
		}

		public function SaveQuesWri() {
			$idQuesWri = $_GET['idQuesWri'];
			$idLesson = $_GET['selectLessonWri'];
			$contentQuesWri = $_GET['contentQuesWri'];
			$ansWri = $_GET['ansWri'];
			
			self::CheckInput($contentQuesWri) ? $checkContentQuesWri = 1 : $checkContentQuesWri = 0;
			self::CheckInput($ansWri) ? $checkAnsWri = 1 : $checkAnsWri = 0;

			if ($checkContentQuesWri && $checkAnsWri) {
				$insertQuesWri = QuestionWrite::InsertQuesWri($idQuesWri, $idLesson, $contentQuesWri, $ansWri);
				if ($insertQuesWri) {
						echo "
					  	<script>
					  		alert('Add success');
					  		window.location = 'home.php?controller=home&action=ManagerCourse';
					  	</script>
						";
					}
				else {
					echo "
					 	<script>
					 		alert('Add fail!!!Id question write is duplicate');
					 		window.location = 'home.php?controller=home&action=ManagerCourse';
					 	</script>
					";
				}
			}
			else {
				$_SESSION['tmpIdQuesWri'] = $idQuesWri;
				$_SESSION['tmpIdLesson'] = $idLesson;
				$_SESSION['tmpContentQues'] = $contentQuesWri;
				$_SESSION['tmpAnsWri'] = $ansWri;

				echo "
					 	<script>
					 		alert('Save fail');
					 		window.location = 'home.php?controller=home&action=ManagerCourse&checkContentQuesWri={$checkContentQuesWri}&checkAnsWri={$checkAnsWri}';
					 	</script>
					";
			}
		}
	} 
?>