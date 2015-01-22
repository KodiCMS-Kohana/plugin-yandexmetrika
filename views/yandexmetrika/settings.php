<div class="panel-heading">
	<span class="panel-title"><?php echo __('General settings'); ?></span>
</div>
<div class="panel-body">
	<div class="form-group form-group-lg form-inline">
		<?php echo Form::label('setting_counter_id', __('Metrics ID'), array('class' => 'control-label col-sm-2')); ?>
		<div class="col-sm-9">
			<?php echo Form::input('setting[counter_id]', $plugin->get('counter_id', 00000000), array(
				'id' => 'setting_counter_id', 'class' => 'form-control', 'maxlength' => 20, 'size' => 20
			)); ?>
		</div>
	</div>
</div>
<div class="panel-heading">
	<span class="panel-title"><?php echo __('API settings'); ?></span>
</div>
<div class="alert alert-danger alert-dark">
	<?php echo __('Register new app :link, set callback url :url', array(
		':link' => HTML::anchor('https://oauth.yandex.ru/client/new'),
		':url' => Route::url('backend', array(
			'controller' => 'yandex',
			'action' => 'access_token'
		), TRUE)
	)); ?>
</div>
<div class="panel-body">
	<div class="form-group">
		<?php echo Form::label('setting_client_id', __('API ID'), array('class' => 'control-label col-sm-2')); ?>
		<div class="col-sm-9">
			<?php echo Form::input('setting[client_id]', $plugin->get('client_id'), array(
				'id' => 'setting_client_id', 'class' => 'form-control'
			)); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo Form::label('setting_client_secret', __('Secret code'), array('class' => 'control-label col-sm-2')); ?>
		<div class="col-sm-9">
			<?php echo Form::input('setting[client_secret]', $plugin->get('client_secret'), array(
				'id' => 'setting_client_secret', 'class' => 'form-control'
			)); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo Form::label('access_token', __('Access token'), array('class' => 'control-label col-sm-2')); ?>
		<div class="col-sm-9">
			<div class="input-group">
				<?php echo Form::input(NULL, $plugin->get('access_token'), array(
					'id' => 'access_token', 'class' => 'form-control', 'disabled'
				)); ?>
				<span class="input-group-btn">
					<?php echo HTML::anchor(Route::url('backend', array(
							'controller' => 'yandex',
							'action' => 'request_token'
						)), __('Request token'), array(
							'class' => 'btn btn-primary'
						)); ?>
				</span>
			</div>
			
		</div>
	</div>
	<hr />
	
	
</div>