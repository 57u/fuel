<h2>Listing <?php echo \Str::ucfirst($plural_name); ?></h2>
<br>
<?php echo "<?php if (\${$plural_name}): ?>"; ?>

<table class="table table-striped">
	<thead>
		<tr>
<?php
foreach ($fields as $field):
	?>
	<th><?php echo \Inflector::humanize($field['name']); ?></th><?php
endforeach;
?>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php
echo '<?php'; ?> foreach ($<?php echo $plural_name; ?> as $<?php echo $singular_name; ?>): <?php echo '?>';
?>
<tr>
	<?php foreach ($fields as $field): ?>
		<td><?php echo '<?php'; ?> echo $<?php echo $singular_name.'->'.$field['name']; ?>; <?php echo '?>'; ?></td>
	<?php endforeach; ?>
		<td style="width:150px;">
			<?php
			echo '<?php'; ?> echo Html::anchor('<?php echo $uri; ?>/edit/'.$<?php echo $singular_name; ?>->id, 'Edit', array('class'=>'btn text-link')); <?php echo '?>';
			echo '<?php'; ?> echo Html::anchor('<?php echo $uri; ?>/delete/'.$<?php echo $singular_name; ?>->id, 'Delete', array('class'=>'btn text-danger', 'onclick' => "return confirm('Are you sure?')")); <?php echo '?>';
			?>
		</td>
	</tr>
<?php
echo '<?php endforeach; ?>';
?>
	</tbody>
</table>

<?php echo '<?php else: ?>'; ?>
	<p>No <?php echo \Str::ucwords(str_replace('_', ' ', $plural_name)); ?>.</p>
<?php echo '<?php endif; ?>'; ?>


<p>
	<?php echo '<?php'; ?> echo Html::anchor('<?php echo $uri; ?>/create', 'Add <?php echo \Inflector::humanize($singular_name); ?>', array('class' => 'btn btn-success')); <?php echo '?>'; ?>
</p>
