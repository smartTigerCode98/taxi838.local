<?php

class AutoParkController extends Controller
{

    public function show()
    {

        $this->data['showTypeAutoGallery'] = 1;

        $this->data['bodyTypes'] = BodyType::getAllBodyTypes();

        if(!isset($this->getParams()[1])) {

            if (isset($this->getParams()[0])) {
                $page = $this->getParams()[0];
            } else {
                $page = 1;
            }

            $size = BodyType::getCountRecords();

            $num = 4;

            $page = intval($page);

            $start = $page * $num - $num;

            $result = BodyType::getRecordsFromRange($num, $start);

            $this->data['currentBodyTypes'] = $result;

            $paginationBuilder = new PaginationPageBuilder($num, $size, $page, '/cars/');

            $this->data['pagination'] = $paginationBuilder->getLinks();
        }else{

            $this->data['showTypeAutoGallery'] = 0;

            $bodyType = BodyType::find( BodyType::getIdByTypeName($this->getParams()[0]));


            if($bodyType) {

                $nameType = $bodyType->saidTypeEnglish();

                $countCars = count($bodyType->cars);

                $countCarsOnPage = 4;

                $page = intval($this->getParams()[1]);

                $start = $page * $countCarsOnPage - $countCarsOnPage;

//                echo '<pre>';
//                print_r($bodyType);

                $cars = $bodyType->cars()->limit($countCarsOnPage)->offset($start)->get();

                $this->data['cars'] = $cars;

                $paginationBuilder = new PaginationPageBuilder($countCarsOnPage, $countCars, $page, "/cars/$nameType/");

                $this->data['pagination'] = $paginationBuilder->getLinks();
//
                $this->data['showCars'] = 1;
            }
        }


//
//        if(isset($this->getParams()[0])){
//            $idBodyType = $this->getParams()[0];
//        }
//        if (isset($idBodyType))
//        {
//            $sedans = BodyType::find($idBodyType);
//
//            if($sedans){
//                $cars = $sedans->cars;
//
//                echo '<pre>';
//                print_r($cars);
//            }
//        }
        return "../views/autopark/autopark.php";
    }
}