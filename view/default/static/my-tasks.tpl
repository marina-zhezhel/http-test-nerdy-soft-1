<div class="container my-tasks-text">
	<div class="row">
		<div class="col-xs-7 col-sm-9">Text Text Text Text</div>
		<div class="col-xs-5 col-sm-3">
			<a href="./index.php?controller=static&page=add-task"><input
				type="button" class="btn add-task-button" value="Add task"></a>
		</div>
	</div>
</div>
<div class="container ten-tasks-wrapper">
	<div class="row equal">
		<div class="col-sm-1 col-xs-12 header-ten-tasks-table">Date Added</div>
		<div class="col-sm-2 col-xs-12 header-ten-tasks-table">Name</div>
		<div class="col-sm-2 col-xs-12 header-ten-tasks-table">Description</div>
		<div class="col-sm-3 col-xs-12 header-ten-tasks-table">Responsible</div>
		<div class="col-sm-3 col-xs-12 header-ten-tasks-table">Coauthors</div>
		<div
			class="col-sm-1 col-xs-12 header-ten-tasks-table header-ten-tasks-table-last">Action</div>
	</div>
	<?php
	
if (isset ( $tasksData ) && ! empty ( $tasksData )) {
		for($i = 0; $i < $countTasksPage; ++ $i) {
			?>
	<div class="row equal">
		<div class="col-sm-1 col-xs-12 ten-tasks-date"><?php echo $tasksDataPage[$i]['date_added']; ?></div>
		<div class="col-sm-2 col-xs-12 ten-tasks-name"><?php echo $tasksDataPage[$i]['name']; ?></div>
		<div class="col-sm-2 col-xs-12 ten-tasks-description"><?php echo $tasksDataPage[$i]['description']; ?></div>
		<div class="col-sm-3 col-xs-12 ten-tasks-responsible"><?php echo $tasksDataPage[$i]['responsibleData']->lastName.' '.$tasksDataPage[$i]['responsibleData']->firstName.' ('.$tasksDataPage[$i]['responsibleData']->login.')'; ?></div>

		<div class="col-sm-3 col-xs-12 ten-tasks-coauthors"><?php if (!empty($tasksDataPage[$i]['coauthors'][0])) { for ($j=0; $j<count($tasksDataPage[$i]['coauthors']); ++$j) { echo $tasksDataPage[$i]['coauthors'][$j]['last_name'].' '.$tasksDataPage[$i]['coauthors'][$j]['first_name'].' ('.$tasksDataPage[$i]['coauthors'][$j]['login'].')'.'<br>'; } }?></div>

		<div class="col-sm-1 col-xs-12 ten-tasks-view">
			<a
				href="./index.php?controller=static&page=add-task&id=<?php echo $tasksDataPage[$i]['id']; ?>"
				class="edit-task<?php echo $i+1; ?>">Edit</a>&nbsp; <a
				href="./index.php?controller=static&page=my-tasks&id=<?php echo $tasksDataPage[$i]['id']; ?>"
				class="delete-task">Delete</a>

		</div>
	</div>
	<?php } } ?></div>
<div class="container">
	<div class="pagination pagination-centered">
		<ul class="pager">
		 <?php
			
if (isset ( $tasksData ) && ! empty ( $tasksData )) {
				if ($pageNum > 1) {
					?>
			<li class="previous"><a
				href="./index.php?controller=static&page=my-tasks&page-tasks=<?=$pageNum-1;?>"
				class="prev-task">Prev</a></li>
			<li class="next"><a href="#" class="next-task">Next</a></li>
			
			 <?php } ?>
			  <?php if($pageNum < $lastPage) { ?>
			  <li class="previous"><a href="#" class="prev-task">Prev</a></li>
			<li class="next"><a
				href="./index.php?controller=static&page=my-tasks&page-tasks=<?=$pageNum+1;?>"
				class="next-task">Next</a></li>
			<?php } }?>
		</ul>
	</div>
</div>


