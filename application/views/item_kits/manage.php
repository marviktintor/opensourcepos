<?php $this->load->view("partial/header"); ?>

<script type="text/javascript">
$(document).ready(function()
{
	table_support.init('<?php echo site_url($controller_name);?>', <?php echo $table_headers; ?>);
    table_support.init_delete('<?php echo $this->lang->line($controller_name."_confirm_delete")?>');

	$('#generate_barcodes').click(function()
	{
		window.open(
			'index.php/items/generate_barcodes/'+table_support.selected_ids().join(':'),
			'_blank' // <- This is what makes it open in a new window.
		);
	});
});

</script>

<div id="title_bar" class="btn-toolbar">

	<button class='btn btn-info btn-sm pull-right modal-dlg modal-btn-submit' data-href='<?php echo site_url($controller_name."/view"); ?>'
			title='<?php echo $this->lang->line($controller_name. '_new'); ?>'>
		<span class="glyphicon glyphicon-tags"></span><?php echo $this->lang->line($controller_name. '_new'); ?>
	</button>

</div>


<div id="toolbar">
	<div class="pull-left btn-toolbar">
		<button id="delete" class="btn btn-default btn-sm" data-href='<?php echo site_url($controller_name."/delete"); ?>'><span class="glyphicon glyphicon-trash"></span>
			<?php echo $this->lang->line("common_delete");?></button>

		<button id="generate_barcodes" class="btn btn-default btn-sm" data-href='<?php echo site_url($controller_name."/generate_barcodes"); ?>'><span class="glyphicon glyphicon-barcode"></span>
			<?php echo $this->lang->line("items_generate_barcodes");?></button>
	</div>
</div>

<div id="table_holder">
	<table id="table"></table>
</div>

<?php $this->load->view("partial/footer"); ?>