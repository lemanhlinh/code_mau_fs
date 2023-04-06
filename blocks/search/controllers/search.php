<?php
/**
 * Class SearchBControllersSearch
 * author: AnhPT4
 * date: 2018-18-1 11:18 AM
 */
include 'blocks/search/models/search.php';
class SearchBControllersSearch
{
    function __construct()
    {
    }

    function display($parameters = array(), $title = '')
    {
        $style = $parameters->getParams('style');
        $style = $style ? $style : 'default';

        $model = new SearchBModelsSearch();
        //$field_work = $model->get_field_work();

        // call views
        include 'blocks/search/views/search/' . $style . '.php';
    }

}