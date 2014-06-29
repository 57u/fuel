<?php echo '<?php echo Form::open(array("class"=>"form-horizontal validateMe")); ?>' ?>


<fieldset>

	<?php foreach ($fields as $field): ?>

		<div class="form-group">
			<?php echo "<?php echo Form::label('". \Inflector::humanize($field['name']) ."', '{$field['name']}', array('class'=>'col-lg-2 control-label')); ?>\n"; ?>
			<div class="col-lg-8">
				<?php
				switch($field['type']):

					case 'text':
						echo "\t\t<?php echo Form::textarea('{$field['name']}', Input::post('{$field['name']}', isset(\${$singular_name}) ? \${$singular_name}->{$field['name']} : ''), array('class' => 'form-control', 'rows' => 4, 'placeholder'=>'".\Inflector::humanize($field['name'])."')); ?>\n";
					break;

					default:
						echo "\t\t<?php echo Form::input('{$field['name']}', Input::post('{$field['name']}', isset(\${$singular_name}) ? \${$singular_name}->{$field['name']} : ''), array('class' => 'form-control', 'placeholder'=>'".\Inflector::humanize($field['name'])."')); ?>\n";

				endswitch;
				?>
			</div><!-- // .col-lg-8 -->
		</div>
	<?php endforeach; ?>


	<div class="form-group">
		<label class='col-lg-2 control-label'>&nbsp;</label>
		<div class='col-lg-4'>
			<?php echo '<?php'; ?> echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); <?php echo '?>' ."\n"; ?>
		</div>
	</div>


</fieldset>

<?php if ($csrf): ?>
	<?php echo '<?php'; ?> echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); <?php echo '?>' ."/n"; ?>
<?php endif; ?>

<?php echo '<?php'; ?> echo Form::close(); <?php echo '?>'; ?>
