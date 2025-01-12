<?php echo form_open('config/save_info/', array('id'=>'info_config_form', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal')); ?>
	<div id="config_wrapper">
		<fieldset id="config_info">
			<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
			<ul id="general_error_message_box" class="error_message_box"></ul>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('config_company'), 'company', array('class'=>'control-label col-xs-2 required')); ?>
				<div class='col-xs-6'>
					<?php echo form_input(array(
						'name'=>'company',
						'id'=>'company',
						'class'=>'form-control input-sm required',
						'value'=>$this->config->item('company'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('config_company_logo'), 'company_logo', array('class'=>'control-label col-xs-2')); ?>
				<div class='col-xs-6'>
					<div class="fileinput <?php echo $logo_exists ? 'fileinput-exists' : 'fileinput-new'; ?>" data-provides="fileinput">
						<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;"></div>
						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;">
							<img data-src="holder.js/100%x100%" alt="<?php echo $this->lang->line('config_company_logo'); ?>"
								 src="<?php if($logo_exists) echo base_url('uploads/' . $this->Appconfig->get('company_logo')); else echo ''; ?>"
								 style="max-height: 100%; max-width: 100%;">
						</div>
						<div>
							<span class="btn btn-default btn-sm btn-file">
								<span class="fileinput-new"><?php echo $this->lang->line("config_company_select_image"); ?></span>
								<span class="fileinput-exists"><?php echo $this->lang->line("config_company_change_image"); ?></span>
								<input type="file" name="company_logo">
							</span>
							<a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line("config_company_remove_image"); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('config_address'), 'address', array('class'=>'control-label col-xs-2 required')); ?>
				<div class='col-xs-6'>
					<?php echo form_textarea(array(
						'name'=>'address',
						'id'=>'address',
						'class'=>'form-control input-sm required',
						'value'=>$this->config->item('address'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('config_website'), 'website', array('class'=>'control-label col-xs-2')); ?>
				<div class='col-xs-6'>
					<?php echo form_input(array(
						'name'=>'website',
						'id'=>'website',
						'class'=>'form-control input-sm',
						'value'=>$this->config->item('website'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('common_email'), 'email', array('class'=>'control-label col-xs-2')); ?>
				<div class='col-xs-6'>
					<?php echo form_input(array(
						'name'=>'email',
						'id'=>'email',
						'type'=>'email',
						'class'=>'form-control input-sm',
						'value'=>$this->config->item('email'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('config_phone'), 'phone', array('class'=>'control-label col-xs-2 required')); ?>
				<div class='col-xs-6'>
					<?php echo form_input(array(
						'name'=>'phone',
						'id'=>'phone',
						'class'=>'form-control input-sm required',
						'value'=>$this->config->item('phone'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('config_fax'), 'fax', array('class'=>'control-label col-xs-2')); ?>
				<div class='col-xs-6'>
					<?php echo form_input(array(
						'name'=>'fax',
						'id'=>'fax',
						'class'=>'form-control input-sm',
						'value'=>$this->config->item('fax'))); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('common_return_policy'), 'return_policy', array('class'=>'control-label col-xs-2 required')); ?>
				<div class='col-xs-6'>
					<?php echo form_textarea(array(
						'name'=>'return_policy',
						'id'=>'return_policy',
						'class'=>'form-control input-sm required',
						'value'=>$this->config->item('return_policy'))); ?>
				</div>
			</div>

			<?php echo form_submit(array(
				'name'=>'submit_form',
				'id'=>'submit_form',
				'value'=>$this->lang->line('common_submit'),
				'class'=>'btn btn-primary btn-sm pull-right')); ?>
		</fieldset>
	</div>
<?php echo form_close(); ?>

<script type='text/javascript'>
//validation and submit handling
$(document).ready(function()
{
	$("a.fileinput-exists").click(function() {
		$.ajax({
			type: "GET",
			url: "<?php echo site_url("$controller_name/remove_logo"); ?>",
			dataType: "json"
		})
	});

	$('#info_config_form').validate({
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)	{
					if(response.success)
					{
						set_feedback(response.message, 'alert alert-dismissible alert-success', false);		
					}
					else
					{
						set_feedback(response.message, 'alert alert-dismissible alert-danger', true);		
					}
				},
				dataType: 'json'
			});
		},

		errorClass: "has-error",
		errorLabelContainer: "#general_error_message_box",
		wrapper: "li",
		highlight: function (e)	{
			$(e).closest('.form-group').addClass('has-error');
		},
		unhighlight: function (e) {
			$(e).closest('.form-group').removeClass('has-error');
		},

		rules: 
		{
			company: "required",
			address: "required",
			phone: "required",
    		email: "email",
    		return_policy: "required" 		
   		},

		messages: 
		{
			company: "<?php echo $this->lang->line('config_company_required'); ?>",
			address: "<?php echo $this->lang->line('config_address_required'); ?>",
			phone: "<?php echo $this->lang->line('config_phone_required'); ?>",
			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
			return_policy: "<?php echo $this->lang->line('config_return_policy_required'); ?>"
		}
	});
});
</script>
