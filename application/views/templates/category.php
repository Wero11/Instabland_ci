<div class="content">
	<div style="margin: 6px 0">
		<a class="btn btn-success" href="<?php echo base_url();?>category/add"><i class="icon-plus-sign-alt icon-large"></i> Add New Item</a>
		<a class="btn btn-success btn-toggle-search"><i class="icon-plus icon-large"></i> Toggle Search</a>
		<div class="searchform">
			<form method="POST" action="<?=base_url().'category/index';?>">
				<div class="float-control-group">
					<label class="control-label">Category Name</label>
			        <input type="text" style="width: 150px;" name="category_name" value="<?php echo isset($search['category_name']) ? $search['category_name']:'';?>">
			    </div>
				<div class="float-control-group control-action">
			   	  <button type="submit" class="btn btn-success"><i class="icon-search icon-large"></i> Search</button>
			    </div>
			    <div style="clear:both;"></div>
			</form>
		</div>
	</div>
	<div class="top-pagenate"><?php echo $links;?></div>
	<table width="100%" class="table table-striped table-bordered">
	   <thead>
	      <tr>
	         <th style='width:40px'>NO. </th>
			 <th style='width:40px'>Category ID</th>
			 <th style='width:200px'>Category Name</th>
			 <th style='width:160px'>Actions</th>
	      </tr>
	   </thead>
	
	   <?php if (!empty($category_list)):
	    foreach ($category_list as $index=>$row): ?>
	      <tr>
	      	 <td><?php echo $index+1; ?></td>
			 <td><?php echo $row->id; ?></td>
	         <td><?php echo $row->category_name; ?></td>
	         <td><a class="btn btn-info btn-first" href="<?php echo base_url() .'category/edit/'.$pagenum.'/'.$row->id;?>"><i class="icon-pencil icon-large"></i> Edit</a><a class="btn btn-danger" onclick="if (confirm('Are you sure?')) location.href='<?php echo base_url() .'category/delete/'.$pagenum.'/'.$row->id;?>'"><i class="icon-trash icon-large"></i> Delete</a></td>
	      </tr>
	   <?php endforeach; 
			else:
	   ?>
	   	  <tr>
	   	  	<td colspan="10">There is no data.</td>
	   	  </tr>
	   <?php endif;?>
	</table>
	<div class="bottom-pagenate"><?php echo $links;?></div>
</div>