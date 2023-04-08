	<table border="1" class="tbl_form_contents" width="100%" cellspacing="4" cellpadding="4" bordercolor="#CCC">
		<thead>
			<tr>
				<th align="center" >
					<?php echo FSText::_('Size');?>	
				</th>
				<th align="center" >
					<?php echo FSText::_('Chọn size');?>	
				</th>
			</tr>
		</thead>
		<tbody>
		
		<?php
			if(isset($sizes) && !empty($sizes)){
				foreach ($sizes as $item) { 
				
					$checked = '';
					if(strpos($data -> sizes,','.$item -> id.',')!== false ){
						$checked = 'checked';
					}
		?>
		
				<tr>
					<td>
						
						<?php echo $item -> name;?><br/>
					</td>
					
					<td>
						<input type="checkbox"  value="<?php echo $item->id; ?>"  name="other_size_exit[]" id="other_size_exit<?php echo $item->id; ?>"  <?php echo $checked;?>/>
						
					</td>
				</tr>
				
			
				<?php
				}
			}
			?>
	</tbody>		
	</table>
	