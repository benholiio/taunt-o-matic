  
      <div class="row">
          <div class="span4 offset1">
            <h1>Add some taunts</h1>
            <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'eventForm');
            echo form_open('input/taunt') 
            ?>
            
            <div class="control-group <?php echo (form_error('title') ? 'error' : '') ?>">
                <label class="control-label" for="inputTitle">Body</label>
                <div class="controls">
                <textarea rows="12" class="span4" type="text" placeholder="Start typing" name="taunt"><?php echo set_value('taunt'); ?></textarea>
                   
                    <span class="help-inline"><?php echo form_error('taunt'); ?></span>
                </div>
             </div>
             
             
              
          
             <div class="control-group">
                <div class="controls">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
             </div>
            
            <?php echo form_close()?>
            <h3><?php 
            if(isset($message))
            {
                echo $message;
            }; 
            ?></h3>      
          </div>          
      </div>      
