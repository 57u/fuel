
<?php foreach ($fields as $field): ?>
<p>
	<strong><?php echo \Inflector::humanize($field['name']); ?>:</strong>
	<?php echo '<?php'; ?> echo $<?php echo $singular_name.'->'.$field['name']; ?>; <?php echo '?>'; ?>
</p>
<?php endforeach; ?>

<?php echo '<?php'; ?> echo Html::anchor('<?php echo $uri ?>/edit/'.$<?php echo $singular_name; ?>->id, 'Edit', array('class'=>'btn btn-primary')); <?php echo '?>'; ?> |
<?php echo '<?php'; ?> echo Html::anchor('<?php echo $uri ?>', 'Back', array('class'=>'btn btn-secondary')); <?php echo '?>'; ?>
