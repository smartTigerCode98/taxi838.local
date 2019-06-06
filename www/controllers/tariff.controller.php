<?php


class TariffController extends Controller{

    public function index()
    {
        $services = Service::getExistingRecords();

        $price_behind_km = BodyType::getBodyTypes();


        $this->data['auto_tariffs'] = $price_behind_km;


        $this->data['tariffs'] = $services;

        return '../views/tariff/tariff.php';
    }
}