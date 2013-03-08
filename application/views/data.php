
      <div class="row">
          <div class="span4 offset1">
            <h1>Add some event data</h1>
            <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'dataForm');
            echo form_open('event/addEventData') 
            ?>
            
            <div class="control-group <?php echo (form_error('event') ? 'error' : '') ?>">
                <label class="control-label" for="inputEvent">Choose Event</label>
                <div class="controls">
                <select name="event" selected="<?php echo set_value('event'); ?>">
                    <option></option>
                
                <?php 
                
                foreach ($events as $row)
                {?>
                <option <?php if(set_value('event') == $row->id){ ?>selected="selected"<?php }?>value="<? echo $row->id;?>"><? echo $row->title;?></option>    
                <?php 
                }?>
                </select>
                <span class="help-inline"><?php echo form_error('event'); ?></span>
                </div>
             </div>
                
            <div class="control-group <?php echo (form_error('title') ? 'error' : '') ?>">
                <label class="control-label" for="inputTitle">Entry Title</label>
                <div class="controls">
                    <input class="span4" type="text" placeholder="title" name="title" value="<?php echo set_value('title'); ?>">
                    <span class="help-inline"><?php echo form_error('title'); ?></span>
                </div>
             </div>
             
             <div class="control-group <?php echo (form_error('description') ? 'error' : '') ?>">
                <label class="control-label" for="inputDescription">Entry Description (meta)</label>
                <div class="controls">
                    <textarea rows="3" class="span4" placeholder="Description" name="description" value="<?php echo set_value('description'); ?>"></textarea>
                    <span class="help-inline"><?php echo form_error('description'); ?></span>
                </div>
             </div>
             
              <div class="control-group <?php echo (form_error('content') ? 'error' : '') ?>">
                <label class="control-label" for="inputContent">Entry Content (html/plaintext/script)</label>
                <div class="controls">
                    <textarea rows="7" class="span4" placeholder="Content" name="content" value="<?php echo set_value('content'); ?>"><?php echo set_value('content'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('content'); ?></span>
                </div>
             </div>
             
             <div class="control-group <?php echo (form_error('image') ? 'error' : '') ?>">
                <label class="control-label" for="inputImage">Entry thumbnail</label>
                <div class="controls">
                    <input class="span4" type="file" placeholder="URL path" name="image" value="<?php echo set_value('image'); ?>">
                    <span class="help-inline"><?php echo form_error('image'); ?></span>
                </div>
             </div>
             
              <div class="control-group <?php echo (form_error('start') ? 'warning' : '') ?>">
                <label class="control-label" for="inputStart">Event start</label>
                <div class="controls">
                    <input class="span2" type="text" placeholder="Start time" name="start" value="<?php echo set_value('start'); ?>">
                    <span class="help-inline"><?php echo form_error('start'); ?></span>
                </div>
             </div>
             
              <div class="control-group <?php echo (form_error('end') ? 'warning' : '') ?>">
                <label class="control-label" for="inputStart">Event end</label>
                <div class="controls">
                    <input class="span2" type="text" placeholder="Finish time" name="end" value="<?php echo set_value('end'); ?>">
                    <span class="help-inline"><?php echo form_error('end'); ?></span>
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

