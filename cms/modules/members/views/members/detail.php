<!-- HEAD -->
	<?php 
	
	$title = @$data ? FSText::_('Edit'): FSText::_('Add'); 
	global $toolbar;
	$toolbar->setTitle($title);
    $toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png',1); 
	$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png',1); 
	$toolbar->addButton('save',FSText::_('Save'),'','save.png',1); 
	$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png');   
	
    $this->dt_col_start('col-xs-12 col-md-8 connectedSortable',1);
        echo ' 	<div class="alert alert-danger" style="display:none" >
                        <span id="msg_error"></span>
                </div>';
    	$this -> dt_form_begin(1,4,$title.' '.FSText::_('Thành viên'));
    	
            if(@$data->avatar){
                $avatar = strpos(@$data->avatar, 'http' ) === false? URL_ROOT.str_replace('/original/', '/original/', @$data->avatar):@$data->avatar;
            }else{
            	$avatar = URL_ROOT.'images/not_picture.png';
           }
        
        	TemplateHelper::dt_edit_text(FSText :: _('Username'),'username',@$data -> username);
        	//TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
            TemplateHelper::dt_edit_image(FSText :: _('Avatar'),'avatar',$avatar,'90');
        
            TemplateHelper::dt_edit_text(FSText :: _('Họ và tên'),'full_name',@$data -> full_name);
            TemplateHelper::dt_edit_text(FSText :: _('Email'),'email',@$data -> email);
            TemplateHelper::dt_edit_text(FSText :: _('Đại chỉ'),'address',@$data -> address);
            
            TemplateHelper::dt_edit_text(FSText :: _('Thông tin'),'other_info',@$data -> other_info,'',650,450,1);
        $this->dt_form_end_col(); // END: col-2
        
     $this->dt_col_end(); // show the dong </div>   
     
     $this->dt_col_start('col-xs-12 col-md-4 connectedSortable');   
        $this -> dt_form_begin(1,4,FSText::_('Thông tin'));
            TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
            TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
            TemplateHelper::dt_checkbox(FSText::_('Sửa password'),'edit_pass','',0);
    
    ?>
            <div class="form-group password_area">
                <label><?php echo FSText::_("Password")?></label>
            	<input class="form-control" type="password" name="password1" id="password" />
            </div>
            <div class="form-group password_area">
                <label><?php echo FSText::_("Re-Password")?></label>
            		<input class="form-control" type="password" name="re-password1" id="re-password" />
            </div>
    <?php
        
    	
    
        $this->dt_form_end_col(); // END: col-2
    $this->dt_col_end(); // show the dong </div>
	$this -> dt_form_end(@$data,1,0,2,'','',1);
	
?>

<script  type="text/javascript" language="javascript">
    $(document).ready(function () {
        check_exist_username();
        check_exist_email();
    });
    
    function formValidator()
    {
        $('.alert-danger').show();
        var check_pass = $("input[name='edit_pass']:checked").val();

        if (!notEmpty('username', 'Bạn cần nhập Tên đăng nhập'))
            return false;

        if (!lengthMin("username", 5, 'Tên đăng nhập phải từ 5 ký tự trở lên')) {
            return false;
        }

        if (!notEmpty('full_name', 'Nhập họ và tên'))
            return false;
        
        if (!notEmpty("email", "Hãy nhập email")) {
            return false;
        }

        if (!emailValidator('email', 'Email không hợp lệ,yêu cầu nhập đúng định dạng'))
            return false;
            
        if (check_pass > 0) {

            if (!notEmpty("password", "Bạn chưa nhập password"))
            {
                return false;
            }

            if (!lengthMin("password", 8, 'Mật khẩu gồm 8 ký tự, có ký tự hoa, thường và số'))
            {
                return false;
            }

            if (!uppercase('password', 'Mật khẩu gồm 8 ký tự, có ký tự hoa, thường và số')) {
                return false;
            }

            if (!number_pass('password', 'Mật khẩu gồm 8 ký tự, có ký tự hoa, thường và số')) {
                return false;
            }

            if (!checkMatchPass_2("password", "re-password", "Password bạn nhập không khớp"))
            {
                return false;
            }
        }
        

        $('.alert-danger').hide();
        return true;
    }
    
    /* CHECK EXIST username  */
    function check_exist_username() {
        $('#username').blur(function () {
            var id = $('#id').val() ? $('#id').val() : 0;
            if ($(this).val() != '') {
                $.ajax({url: "index.php?module=members&view=members&task=ajax_check_exist_username&raw=1",
                    data: {username: $(this).val(), id: id},
                    dataType: "text",
                    success: function (result) {
                        if (result == 0) {
                            document.getElementById('msg_error').innerHTML = 'Tên đăng nhập này đã tồn tại. Ban hãy sử dụng tên đăng nhập khác';
                            $('#msg_error').parent().show();
                            $('#username').focus(); // set the focus to this input                     
                        }
                    }
                });
            }
        });
    }
    /* CHECK EXIST EMAIL  */
    function check_exist_email() {
        $('#email').blur(function () {
            var id = $('#id').val() ? $('#id').val() : 0;
            if ($(this).val() != '') {
                if (!notEmpty("email", "Email không hợp lệ,yêu cầu nhập đúng định dạng"))
                    return false;

                $.ajax({url: "index.php?module=members&view=members&task=ajax_check_exist_email&raw=1",
                    data: {email: $(this).val(), id: id},
                    dataType: "text",
                    success: function (result) {
                        if (result == 0) {
                            document.getElementById('msg_error').innerHTML = 'Email này đã tồn tại. Ban hãy sử dụng email khác';
                            $('#msg_error').parent().show();
                            $('#email').focus(); // set the focus to this input                     
                        }
                    }
                });
            }
        });
    }
    
    jQuery(function ($) {
        $('#username').keyup(function (e) {
            var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
            var str = $(this).val();
            if (!characterReg.test(str)) {
                        invalid2("username", 'Yêu cầu không dấu');
                str = removeDiacritics(str);
                $(this).val(str);
                }
            if (e.which === 32) {
                //alert('No space are allowed in usernames');
                invalid2("username", 'Yêu cầu viết liền không dấu');
                str = str.replace(/\s/g, '');
                $(this).val(str);
            }
            var characterReg2 = /^([a-zA-Z0-9]{5,255})$/;
        }).blur(function () {
            var str = $(this).val();
            str = removeDiacritics(str);
            str = str.replace(/\s/g, '');
            $(this).val(str);
        });
    });



    function removeDiacritics(input)
    {
        var output = "";

        var normalized = input.normalize("NFD");
        var i = 0;
        var j = 0;

        while (i < input.length)
        {
            output += normalized[j];

            j += (input[i] == normalized[j]) ? 1 : 2;
            i++;
        }

        return output;
    }
	//$("select#city_id").change(function(){
//	$.ajax({url: "index.php?module=members&task=district&raw=1",
//			data: {cid: $(this).val()},
//			dataType: "text",
//			
//			success: function(text) {
//				alert(text);
//				if(text == '')
//					return;
//				j = eval("(" + text + ")");
//				
//				var options = '';
//				for (var i = 0; i < j.length; i++) {
//					options += '<option value="' + j[i].id + '">' + j[i].name + '</option>';
//				}
//				$('#district_id').html(options);
//				elemnent_fisrt = $('#district_id option:first').val();
//			}
//		});
//	});
	$('.password_area').hide();
	$('#edit_pass_0').click(function(){
		$('.password_area').hide();
	});
	$('#edit_pass_1').click(function(){
		$('.password_area').show();
	});
			
</script>
