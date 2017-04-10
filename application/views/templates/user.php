<div class="content">
	<div class="top-pagenate"><?php echo $links;?></div>
	<table width="100%" class="table table-striped table-bordered">
	   <thead>
	      <tr>
	         <th style='width:40px'>No. </th>
			 <th>User ID</th>
			 <th>E-mail</th>
			 <th>isAdmin</th>
			 <th>Actions</th>
	      </tr>
	   </thead>
	
	   <?php foreach ($user_list as $index=>$row): ?>
	      <tr>
	      	 <td><?php echo $index+1; ?></td>
			 <td><?php echo $row->userID; ?></td>
	         <td><?php echo $row->email; ?></td>
	         <td><input type="checkbox" <?php if($row->isAdmin) echo 'checked'; ?> readonly /></td>
	         <td>
	         	<a class="btn btn-info btn-first" href="<?php echo base_url() .'user/edit/'.$pagenum.'/'.$row->id;?>"><i class="icon-pencil icon-large"></i> Edit</a>
	         	<?php if ( !isset($mine) ) {?>
	         		<a class="btn btn-danger" onclick="if (confirm('Are you sure?') ) location.href = '<?php echo base_url() .'user/delete/'.$pagenum.'/'.$row->id;?>'"><i class="icon-trash icon-large"></i> Delete</a>
	         	<?php } ?>
	         </td>
	      </tr>
	   <?php endforeach; ?>
	</table>
	<div class="bottom-pagenate"><?php echo $links;?></div>
</div>