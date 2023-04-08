<?php

class ProductsControllersProducts extends Controllers
{
    function __construct()
    {
        $limit = FSInput::get('limit', 20, 'int');
        $this->limit = $limit;
        $this->view = 'products';
        $this->table_manufactory = FSTable_ad::_('fs_manufactories');

        parent::__construct();
    }

    function display()
    {
        parent::display();
        $sort_field = $this->sort_field;
        $sort_direct = $this->sort_direct;

        $model = $this->model;

        $categories = $model->get_product_categories_tree_by_permission();
        $manufactories = $model->get_records('1', $this->table_manufactory,'id,name');
        $str_cat_id = '';
        foreach ($categories as $item) {
            $str_cat_id .= ',' . $item->id;
        }
        $str_cat_id .= ',';

        $list = $model->get_datas($str_cat_id);

        $pagination = $model->getPaginations($str_cat_id);
        include 'modules/' . $this->module . '/views/' . $this->view . '/list.php';
    }

    function view_name($data)
    {
        $link = FSRoute::_('index.php?module=products&view=product&id=' . $data->id . '&code=' . $data->alias . '&ccode=' . $data->category_alias);
        return '<a target="_blink" href="' . $link . '" title="Xem ngoài font-end">' . $data->name . '</a>';
    }

    function add()
    {
        $model = $this->model;
        $cid = FSInput::get('cid');

        $maxOrdering = $model->getMaxOrdering();
        // all categories
        $categories = $model->get_categories_tree();
        $manufactories = $model->get_records('1', 'fs_manufactories','id,name');
        $application = $model->get_records('1', 'fs_application','id,name');
        $products_types = $model->get_records('1', 'fs_products_types','id,name');
        $products_relates = $model->get_records('1', 'fs_products','id,name');
        $email_contact = $model->get_records('1', 'fs_email','id,name');
        $email_download = $model->get_records('1', 'fs_email','id,name');
        $email_order = $model->get_records('1', 'fs_email','id,name');
        $email_catalogue = $model->get_records('1', 'fs_email','id,name');
        $email_driver = $model->get_records('1', 'fs_email','id,name');
        // var_dump($manufactories);
        /*
         * Lấy tham số cấu hình module
         */
        $module_params = $model->module_params;
        FSFactory::include_class('parameters');
        $current_parameters = new Parameters($module_params);

        $uploadConfig = base64_encode('add|' . session_id());
        include 'modules/' . $this->module . '/views/' . $this->view . '/detail.php';
    }


    function edit()
    {
        $ids = FSInput::get('id', array(), 'array');
        $id = $ids[0];
        $model = $this->model;
        $data = $model->get_record_by_id($id);

        $categories = $model->get_categories_tree();
        $manufactories = $model->get_records('1', 'fs_manufactories','id,name');
        $application = $model->get_records('1', 'fs_application','id,name');
        $products_types = $model->get_records('1', 'fs_products_types','id,name');
        $products_relates = $model->get_records('id != '.$id, 'fs_products','id,name');
        $email_contact = $model->get_records('1', 'fs_email','id,name');
        $email_download = $model->get_records('1', 'fs_email','id,name');
        $email_order = $model->get_records('1', 'fs_email','id,name');
        $email_catalogue = $model->get_records('1', 'fs_email','id,name');
        $email_driver = $model->get_records('1', 'fs_email','id,name');
        // var_dump($manufactories);
        /*
         * Lấy tham số cấu hình module
         */
        $module_params = $model->module_params;
        FSFactory::include_class('parameters');
        $current_parameters = new Parameters($module_params);

        $uploadConfig = base64_encode('edit|' . $id);
        include 'modules/' . $this->module . '/views/' . $this->view . '/detail.php';
    }

    function export()
    {
        setRedirect('index.php?module=' . $this->module . '&view=' . $this->view . '&task=export_file&raw=1');
    }

    function export_file()
    {
        FSFactory::include_class('excel', 'excel');
//			require_once 'excel.php';
        $model = $this->model;
        $filename = 'product-export';
        $list = $model->get_data_for_export();
        $categories = $model->get_records('', 'fs_products_categories', 'id,code,alias,name,tablename', '', '', 'id');
        if (empty($list)) {
            echo 'error';
            exit;
        } else {
            $excel = FSExcel();
            $excel->set_params(array('out_put_xls' => 'export/excel/' . $filename . '.xls', 'out_put_xlsx' => 'export/excel/' . $filename . '.xlsx'));
            $style_header = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ffff00'),
                ),
                'font' => array(
                    'bold' => true,
                )
            );
            $style_header1 = array(
                'font' => array(
                    'bold' => true,
                )
            );

            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('H')->setWidth(60);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
            $excel->obj_php_excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);


            $excel->obj_php_excel->getActiveSheet()->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('G')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('H')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('I')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('J')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('K')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $excel->obj_php_excel->getActiveSheet()->getStyle('L')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);


            $excel->obj_php_excel->getActiveSheet()->setCellValue('A1', 'Id');
//				$excel->obj_php_excel->getActiveSheet()->setCellValue('B1', 'Category');
            $excel->obj_php_excel->getActiveSheet()->setCellValue('B1', 'Name');
            //	$excel->obj_php_excel->getActiveSheet()->setCellValue('B1', 'Image');
            $excel->obj_php_excel->getActiveSheet()->setCellValue('C1', 'Code');
            $excel->obj_php_excel->getActiveSheet()->setCellValue('D1', 'Partnumber');
            $excel->obj_php_excel->getActiveSheet()->setCellValue('E1', 'Summary');
            $excel->obj_php_excel->getActiveSheet()->setCellValue('F1', 'Specs'); // overview
            $excel->obj_php_excel->getActiveSheet()->setCellValue('G1', 'Description'); // Specs
            $excel->obj_php_excel->getActiveSheet()->setCellValue('H1', 'Driver');// ProDescription
            $excel->obj_php_excel->getActiveSheet()->setCellValue('I1', 'Short_sumary'); // driverLink
            $excel->obj_php_excel->getActiveSheet()->setCellValue('J1', 'RetailPrice');
            $excel->obj_php_excel->getActiveSheet()->setCellValue('K1', 'DealerPrice');
            $excel->obj_php_excel->getActiveSheet()->setCellValue('L1', 'Published');
            $i = 0;
            $total_money = 0;
            $total_quantity = 0;
            foreach ($list as $item) {
                $key = isset($key) ? ($key + 1) : 2;
                $excel->obj_php_excel->getActiveSheet()->setCellValue('A' . $key, $item->id);
//					$excel->obj_php_excel->getActiveSheet()->setCellValue('B'.$key, @$categories[$item->category_id]->code);		
                $excel->obj_php_excel->getActiveSheet()->setCellValue('B' . $key, $item->name);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('C' . $key, $item->code);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('D' . $key, $item->partnumber);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('E' . $key, $item->summary);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('F' . $key, $item->description);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('G' . $key, ''); // đang làm
                $excel->obj_php_excel->getActiveSheet()->setCellValue('H' . $key, $item->driver);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('I' . $key, $item->promotion_info);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('J' . $key, $item->price);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('K' . $key, $item->dealer_price);
                $excel->obj_php_excel->getActiveSheet()->setCellValue('L' . $key, $item->published);
                $excel->obj_php_excel->getActiveSheet()->getRowDimension($i + 2)->setRowHeight(20);
                $i++;
            }
//				$excel->obj_php_excel->getActiveSheet()->setCellValue('D'.($i+2), 'Tổng');
//				$excel->obj_php_excel->getActiveSheet()->setCellValue('E'.($i+2), $total_quantity);
//				$excel->obj_php_excel->getActiveSheet()->setCellValue('F'.($i+2), $total_money);

            $excel->obj_php_excel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
            $excel->obj_php_excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
            $excel->obj_php_excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Arial');
            $excel->obj_php_excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_header);
            $excel->obj_php_excel->getActiveSheet()->duplicateStyle($excel->obj_php_excel->getActiveSheet()->getStyle('A1'), 'B1:L1');

//				$excel->obj_php_excel->getActiveSheet()->getStyle('A1')->getAlignment()->setIndent(1);// padding cell

            $output = $excel->write_files();

            $path_file = PATH_ADMINISTRATOR . DS . str_replace('/', DS, $output['xls']);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header("Content-type: application/force-download");
            header("Content-Disposition: attachment; filename=\"" . $filename . '.xls' . "\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($path_file));
            readfile($path_file);
        }
    }

    /***********
     * end ADVICES RELATED.
     ************/
    function is_new()
    {
        $this->is_check('is_new', 1, 'is_new');
    }

    function unis_new()
    {
        $this->unis_check('is_new', 0, 'un_new');
    }

    function is_hot()
    {
        $this->is_check('is_hot', 1, 'is_hot');
    }

    function unis_hot()
    {
        $this->unis_check('is_hot', 0, 'un_hot');
    }

    function is_sell()
    {
        $this->is_check('is_sell', 1, 'is_sell');
    }

    function unis_sell()
    {
        $this->unis_check('is_sell', 0, 'is_sell');
    }

    function is_sale()
    {
        $this->is_check('is_sale', 1, 'is_sale');
    }

    function unis_sale()
    {
        $this->unis_check('is_sale', 0, 'is_sale');
    }

    function is_status()
    {
        $this->is_check('is_status', 1, 'is_status');
    }

    function unis_status()
    {
        $this->unis_check('is_status', 0, 'is_status');
    }

    function is_stock()
    {
        $this->is_check('is_stock', 1, 'is_stock');
    }

    function unis_stock()
    {
        $this->unis_check('is_stock', 0, 'is_stock');
    }

    function format_money($row)
    {
        if ($row)
            return format_money($row, 'VNĐ');
        else
            return $row;
    }

}

?>