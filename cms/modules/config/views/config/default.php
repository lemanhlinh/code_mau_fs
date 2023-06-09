<!-- HEAD -->
<?php

$title = FSText:: _('Configuration');
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('Save', FSText:: _('Save'), '', 'save.png');
$toolbar->addButton('back', FSText:: _('Cancel'), '', 'cancel.png');

$this->dt_col_start('col-xs-12 col-md-12 connectedSortable', 1);
$this->dt_form_begin(1, 4, $title);

foreach ($data as $item) { ?>
    <div class="form-group">
        <label><?php echo FSText::_($item->title); ?></label>
        <?php
        switch ($item->data_type) {
            case "text":
            default:
                echo "<input class='form-control' type='text' name='$item->name' value='$item->value' size='70' /> ";
                break;
            case 'textarea':
                echo "<textarea class='form-control' cols='70' rows='10' name='$item->name'>$item->value</textarea>";
                break;
            case "bool":
                if ($item->value == 1) {
                    $checktrue = " checked = 'checked' ";
                    $checkfalse = "";
                } else {
                    $checkfalse = " checked = 'checked' ";
                    $checktrue = "";
                }
                echo "<input type='radio' name='$item->name' $checktrue value='1'  /> " . FSText::_('Yes');
                echo "<input type='radio' name='$item->name' $checkfalse value='0' />" . FSText::_('No');
                break;
            case "image":
                if ($item->value) {
                    echo '<img width="120px" src="' . URL_ROOT . $item->value . '" />';
                }
                echo '
                                <div class="fileUpload btn btn-primary ">
                                    <input type="file" class="upload" name="' . $item->name . '"  />
                                </div>';
                break;
            case "editor":
                $oFCKeditor = new FCKeditor("$item->name");
                $oFCKeditor->BasePath = '../libraries/wysiwyg_editor/';
                $oFCKeditor->Value = @$item->value;
                $oFCKeditor->Width = 650;
                $oFCKeditor->Height = 450;
                $oFCKeditor->Create();
                break;

        }
        ?>
    </div>
<?php }
$this->dt_form_end_col(); // END: col-2
$this->dt_col_end(); // show the dong </div>
$this->dt_form_end(@$data, 1, 0, 2, '', '', 1);
?>

