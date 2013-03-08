	<div class="row-fluid">
	
	  <div class="span4 offset4">
  		<?php 
			$attributes = array(
					'class' => 'form'
					);
			echo form_open('rate', $attributes); ?>
				<div class="control-group <?php echo (form_error('email') ? 'success' : '') ?>">
				  <label class="control-label" for="inputSuccess">Chuck us a third person singular simple verb. e.g. "shoot" </label>
				  <div class="controls">
				    <input type="text" id="verb" class="input-large">
				    
				  </div>
				</div>
  		<?php echo form_close(); ?>
  		
  		<div class="well">
  			<p>Start typing a verb</p>
		</div>
  		
  		<table class="table">
  			<tr>
  				<th>Suffix</th>
  				<th>Rank</th>
  				<th>Vote</th>  			
  			</tr>
  			<tr>
  				<td class="suffix"></td>
  				<td class="rank"></td>
  				<td class="vote"><i class="icon-thumbs-up"></i>/<i class="icon-thumbs-down"></i></td>
  			</tr>
  		</table>
  		
  		<script>
	  		var url = "<?php echo base_url();?>",
			method = "verb";
  		</script>
	  </div>
	  
	</div>