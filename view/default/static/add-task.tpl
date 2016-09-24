<div class="container my-tasks-text">
	<div class="row">
		<div class="col-xs-12">Text Text Text Text Text Text Text Text Text
			Text Text Text Text Text Text Text</div>
		<div class="col-xs-12 error-massage">
			<?php echo $error; ?>
		</div>
	</div>
</div>
<div class="container add-task">
	<form action="./index.php?controller=static&page=add-task"
		method="post">
		<div class="row">
			<div class="col-sm-12 col-sm-4 col-sm-offset-4">
				<div class="row">
					<input type="hidden" name="id" value="<?php echo $valueTaskId; ?>">
					<div class="control-group">
						<label class="control-label" for="name">Name:</label>
						<div class="controls">
							<input type="text" name="name" id="name"
								value="<?php if (isset($taskData['name'])) {echo $taskData['name'];}?>"
								required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="description">Description:</label>
						<div class="controls">
							<textarea rows="3" name="description" id="description"><?php if (isset($taskData['name'])) {echo $taskData['description'];}?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="responsible">Responsible:</label>
						<div class="controls">
							<select required name="responsible-id" id="responsible">
								<option disabled selected value="0">Select a responsible</option>
					<?php for($i=0; $i<$countAllUsers; $i++) {?>
						<option
									<?php if (isset($taskData['responsible_user_id'])) {if ($allUsers[$i]['id']==$taskData['responsible_user_id']) {?>
									selected <?php }}?> value="<?php echo $allUsers[$i]['id']; ?>"><?php echo $allUsers[$i]['last_name'].' '.$allUsers[$i]['first_name'].' ('.$allUsers[$i]['login'].')';?></option>
	
						<?php } ?>
					</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="coauthors">Coauthors:</label>
						<div class="controls">
							<select multiple="multiple" required name="coauthors-id[]"
								id="coauthors">
								<option <?php if (empty($taskData['coauthors'][0])) {?> selected
									<?php }?> value="0" style="color: grey;">Select a coauthors</option>
						<?php for($i=0; $i<$countAllUsers; $i++) {?>
						<option
									<?php if (!empty($taskData['coauthors'][0])) {for($j=0; $j<$countTaskCoauthors; $j++) { if ($allUsers[$i]['id']==$taskData['coauthors'][$j]['user_id']) {?>
									selected <?php }}}?> value="<?php echo $allUsers[$i]['id']; ?>"><?php echo $allUsers[$i]['last_name'].' '.$allUsers[$i]['first_name'].' ('.$allUsers[$i]['login'].')';?></option>
	
						<?php }?>
					</select>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<a href="./index.php?controller=static&page=my-tasks"><input
					type="button" class="back-add-task btn" value="Back"></a>
			</div>
			<div class="col-xs-6 create">
				<input type="submit" name="submit" class="submit btn" value="Create">
			</div>
		</div>
	</form>

</div>

