
<link href="<?php echo base_url('assets/css/jquery.fancybox.css') ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fancybox.pack.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/app-fancy.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/gallery.js'); ?>"></script>

<div class="content">
	<div style="margin: 6px 0">
		<a class="btn btn-success" href="<?php echo base_url();?>image/add"><i class="icon-plus-sign-alt icon-large"></i> Add New Item</a>
		<a class="btn btn-success btn-toggle-search"><i class="icon-plus icon-large"></i> Toggle Search</a>
		<div class="searchform">
			<form method="POST" action="<?=base_url().'image/index';?>">
				<div class="float-control-group">
					<label class="control-label">Image Name</label>
			        <input type="text" style="width: 150px;" name="name" value="<?php echo isset($search['name']) ? $search['name']:'';?>">
			    </div>
			    <div class="float-control-group">
			      	<label class="control-label">Category</label>
			        <select style="width: 200px;" name="category_ID">
						<option value=""> --- All --- </value>
						<?php 
							foreach ($category_list as $category) {
								echo '<option value="'.$category->id.'">'.$category->category_name.'</option>';
							}	
						?>
					</select>
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
			 <th style='width:125px'>Category Name</th>
			 <th style='width:125px'>Image Name</th>
			 <th style='width:200px'>Image URL</th>
			 <th style='width:200px'>Thumbnail URL</th>
			 <th style='width:200px'>Pre-View</th>
			 <th style='width:160px'>Actions</th>
	      </tr>
	   </thead>
	
	   <?php if (!empty($image_list)):
	    foreach ($image_list as $index=>$row): ?>
		<?php 
			$category_name = '';
			foreach ($category_list as $category) {
				if ($category->id == $row->category_ID) {
					$category_name = $category->category_name;
				}
			}	
		?>
	      <tr>
	      	 <td><?php echo $pagenum*1 + $index + 1; ?></td>
			 <td><?php echo $category_name; ?></td>
	         <td><?php echo $row->name; ?></td>
	         <td><?php echo $row->image_URL; ?></td>
			 <td><?php echo $row->thumbnail_URL; ?></td>
			 <td>
				<div class="span2">
					<div class="item">
						<a class="fancybox-button" data-rel="fancybox-button" title="<?php echo $row->name.' ('.$category_name.')'; ?>" href="<?php echo $row->image_URL; ?>">
							<div class="zoom">
								<img src="<?php echo $row->thumbnail_URL; ?>" alt="<?php echo $row->name; ?>" />                            
								<div class="zoom-icon"></div>
							</div>
						</a>
					</div>							
				</div>
			 </td>
	         <td>
	         	<a class="btn btn-info btn-first" href="<?php echo base_url() .'image/edit/'.$pagenum.'/'.$row->id;?>"><i class="icon-pencil icon-large"></i> Edit</a>
	         	<a class="btn btn-danger" onclick="if (confirm('Are you sure?')) location.href='<?php echo base_url() .'image/delete/'.$pagenum.'/'.$row->id;?>'"><i class="icon-trash icon-large"></i> Delete</a>
	         </td>
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

<script>
	jQuery(document).ready(function() { 
	   App.init();
	   Gallery.init();
	   $('.fancybox-video').fancybox({type: 'iframe'});
	});
</script>