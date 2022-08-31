<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo");

	// insert to db if submit button is clicked
	if (isset($_POST['submit'])) {
			if (empty($_POST['task'])) {
				$errors = "Write the asignment!";
			}elseif(empty($_POST['due'])) {
				$errors = "Pick a due date!";
			}else{
					//first thing to submit
			$task = $_POST['task'];
					//second thing to submit
			$due = $_POST['due'];
					//make it submit
			$sql = "INSERT INTO tasks (due, task) VALUES ('$due', '$task')";

			mysqli_query($db, $sql);
			header('location: index.php');
	}
	};

    // delete task
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
	header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Schedule</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?=time()?>">
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">My Schedule</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
	<?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
	<?php } ?>
        <p> Assignment: <input type="text" name="task" class="task_input"></p>
		<p>Due Date: <input type="text" name="due"	class="task_input"></p>
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Assignment</button>
	</form>
    
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Assignment</th>
			<th>Due Date</th>
			<th style="width: 60px;">Finished the Assignment!</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"><?php echo $row['task'];?></td>
				<td class="due"><?php echo $row['due'];?></td>
				<td class="delete"><a href="index.php?del_task=<?php echo $row['ID'] ?>">X</a></td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
</body>
</html>