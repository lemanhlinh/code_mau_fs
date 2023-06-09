<?php
/*
 * Huy write
 */

class Pagination
{
    var $limit;
    var $total;
    var $page;
    var $url;

    function __construct($limit, $total, $page, $url = '')
    {
        $this->limit = $limit;
        $this->total = $total;
        $this->page = $page;
//		if(!IS_REWRITE){
        if ($url)
            $this->url = clean($url);
        else {
            $url = $_SERVER['REQUEST_URI'];
//				$url =  trim(preg_replace('/&page=[0-9]+/i', '', $url));
            $this->url = clean($url);
        }
//		} else {
//			if(!$url)
//				$url = $_SERVER['REQUEST_URI'];
////			if(strpos($url,'-page') !== false)
//			$search = preg_match('#-page([0-9]*)#is',$url,$main);
//			if()
//			
//			$url = Route::deURL($url);
//			$url =  trim(preg_replace('/&page=[0-9]+/i', '', $url));
//			$this->url = $url;
//		}
    }

    function create_link_with_page($url, $page)
    {

        if (!IS_REWRITE) {
            $url = trim(preg_replace('/&page=[0-9]+/i', '', $url));

            if (!$page || $page == 1) {
                return $url;
            } else {
                return $url . '&page=' . $page;
            }
        } else {
            if ($url == '' || $url == '/')
                $url = '/sim.html';
            if (!$page || $page == 1) {
                $url = trim(preg_replace('/-page[0-9]+/i', '', $url));
                if ($url == '/sim.html')
                    return URL_ROOT;
                return $url;
            } else {
                $search = preg_match('#-page([0-9]+)#is', $url, $main);
                if ($search) {
                    $url = preg_replace('/-page[0-9]+/i', '-page' . $page, $url);
                } else {
                    $url = preg_replace('/.html/i', '-page' . $page . '.html', $url);
                }
                return $url;
            }
//            var_dump($url);die;
        }
    }

    function create_link_with_page_ajax($url, $page)
    {

        $url = trim(preg_replace('/&page=[0-9]+/i', '', $url));

        if (!$page || $page == 1) {
            return $url;
        } else {
            return $url . '&page=' . $page;
        }
    }

    /*
     * maxpage is max page is show. But It is not last pageg.
     * ex: 1,2,3,4..100.=> 4 is max page
     */
    function showPagination($maxpage = 5)
    {
        $previous = '<i class="fa left fa-angle-left " aria-hidden="true"></i>';
        //$next = "Tiếp";
        $next = '<i class="fa right fa-angle-right " aria-hidden="true"></i>';
        $first_page = '<i class="fa left fa-angle-double-left " aria-hidden="true"></i>';
        $last_page = '<i class="fa right fa-angle-double-right " aria-hidden="true"></i>';


        $current_page = FSInput::get('page');
        if (!$current_page || $current_page < 0)
            $current_page = 1;
        $html = "";

        $url = $this->url;
        $url = clean($url);

        if ($this->limit < $this->total) {
            $num_of_page = ceil($this->total / $this->limit);

            $start_page = $current_page - $maxpage;
            if ($start_page <= 0)
                $start_page = 1;

            $end_page = $current_page + $maxpage;

            if ($end_page > $num_of_page)
                $end_page = $num_of_page;

            //WRITE prefix on screen
            $html .= '<div class="pagination clearfix">';
            //$html .=  "<font class='title_pagination'>" . FSText :: _('') . "</font> ";
            //Write Previous
            if (($current_page > 1) && ($num_of_page > 1)) {
                $html .= "<li class='page-item'>
                            <a class='page-link ' title='first_page' href='" . Pagination::create_link_with_page($url, 0) . "' title='" . FSText::_('First page') . "' >
                            " . $first_page . "
                            </a>
                        </li>";

                $html .= "<li class='page-item'>
                            <a class='page-link' title='pre_page' href='" . Pagination::create_link_with_page($url, $current_page - 1) . "' title='" . FSText::_('Previous') . "' >
                            " . $previous . "
                            </a>
                            </li>";
//                if ($start_page != 1)
//                    $html .= "<b>..</b>";

            }
//            print_r($html);
            for ($i = $start_page; $i <= $end_page; $i++) {
                if ($i != $current_page) {
                    if ($i == 1)
                        $html .= "<li class='page-item'><a class='page-link' title='Page " . $i . "' href='" . Pagination::create_link_with_page($url, 0) . "' >" . $i . "</a></li>";
                    else
                        $html .= "<li class='page-item'><a class='page-link' title='Page " . $i . "' href='" . Pagination::create_link_with_page($url, $i) . "' >" . $i . "</a></li>";
                } else {
                    $html .= "<li class='page-item active '><a class='page-link' title='Page " . $i . "' class='current'>" . $i . "</a></li>";
                }
            }
            //Write Next
            if (($current_page < $num_of_page) && ($num_of_page > 1)) {
//                if ($end_page < $num_of_page)
//                    $html .= "<b>..</b>";
                $html .= "<li class='page-item'>
                            <a class='page-link' title='Next page' href='" . Pagination::create_link_with_page($url, $current_page + 1) . "' >
                                " . $next . "</a>
                            </li>";
                $html .= "<li class='page-item'>
                            <a class='page-link' title='Last page' href='" . Pagination::create_link_with_page($url, $num_of_page) . "' >
                                " . $last_page . "
                            </a>
                        </li>";
            }
            $html .= "</ul>";
//            print_r($html);
        }
        return $html;
    }

    function genareate_limit($url = '')
    {
        if (!$url)
            $url = $this->url;

        $url = clean($url);
        if (!IS_REWRITE) {
            $url = trim(preg_replace('/&page=[0-9]+/i', '', $url));
            $url = trim(preg_replace('/&limit=[0-9]+/i', '', $url));

        } else {
            $url = trim(preg_replace('/-page[0-9]+/i', '', $url));
            $url = trim(preg_replace('/&limit=[0-9]+/i', '', $url));
            $url = trim(preg_replace('/\?limit=[0-9]+/i', '', $url));
        }
        $limit = FSInput::get('limit', 12, 'int');

        $html = '';

        $html .= ' <select onchange="location = this.value;">';
        $arrNumberOfPage = range(12, 48, 4);
        foreach ($arrNumberOfPage as $val) {
            $checked = $limit == $val ? 'selected="selected"' : '';
            $html .= ' <option ' . $checked . ' value="' . $url . '?limit=' . $val . '" >' . $val . '</option>';
        }
        $html .= ' </select>';
        return $html;
    }
}