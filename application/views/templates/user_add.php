<?
/**
 * This is a bootstrapped form, you should pass along the following
 * array to this view to render it properly.
 *
 * $fields = array(
 *    array(
 *       'name' => What post variable it will return. [ex. first_name]
 *       'type' => The field type [ex. password, text, etc.]
 *       'default' => The default value for this field.
 *    )
 * )
 */
?>

<form class="form-horizontal" method="POST" action="<?=base_url().'user/save';?>">
	<div class="control-group ">
		<label class="control-label">First Name</label>
        <div class="controls">
			<input class="input-xlarge" type="text" name="first_name" value="">
            <div class="help-block"></div>
		</div>
    </div>
    <div class="control-group ">
      	<label class="control-label">Last Name</label>
        <div class="controls">
			<input class="input-xlarge" type="text" name="last_name" value="">
            <div class="help-block"></div>
		</div>
    </div>
    <div class="control-group ">
      	<label class="control-label">Full Name</label>
        <div class="controls">
			<input class="input-xlarge" type="text" name="real_name" value="">
            <div class="help-block"></div>
		</div>
    </div>
    <div class="control-group ">
      	<label class="control-label">Email</label>
        <div class="controls">
			<input class="input-xlarge" type="email" name="email" value="">
            <div class="help-block"></div>
		</div>
    </div>
    <div class="control-group ">
      	<label class="control-label">Password</label>
        <div class="controls">
			<input class="input-xlarge" type="password" name="password" value="">
            <div class="help-block"></div>
		</div>
    </div>
    <div class="control-group ">
      	<label class="control-label">Approved</label>
        <div class="controls">
			<input class="input-xlarge" type="checkbox" name="approved" checked/>
            <div class="help-block"></div>
		</div>
    </div>
    <div class="control-group ">
      	<label class="control-label">Level</label>
        <div class="controls">
			<select name="level">
				<option value="admin">Admin</option>
				<option value="user" selected>User</option>
			</select>
            <div class="help-block"></div>
		</div>
    </div>
   
   <div class="form-actions">
   	  <input type="hidden" name="page" value="<?php echo $pagenum?>">
      <button type="submit" class="btn btn-primary">Add</button>
   	  <a onclick="history.go(-1)" class="btn">Cancel</a>
   </div>
</form>