<?php

class ServicesController extends Controller
{
    public function index()
    {
        if (isset($this->getParams()[0])) {
            $page = $this->getParams()[0];
        } else {
            $page = 1;
        }

        $size = Service::getCountRecords();

        $num = 6;

        $page = intval($page);

        $start = $page * $num - $num;

        $result = Service::getRecordsFromRange($num, $start);

        $this->data['currentBodyTypes'] = $result;

        $paginationBuilder = new PaginationPageBuilder($num, $size, $page, '/services/');

        $this->data['pagination'] = $paginationBuilder->getLinks();


        $this->data['services'] = $result;

        return '../views/services/services.php';
    }

    public function information()
    {
        $id_service = $this->getParams()[0];

        $service = Service::find($id_service);

        $this->data['title'] = $service->sayTitle();

        $this->data['description'] = $service->sayDescription();

        return '../views/services/information.php';
    }
}