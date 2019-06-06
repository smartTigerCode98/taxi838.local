<?php

class MainController extends Controller{


    public function __construct(array $data = array())
    {
        parent::__construct($data);
    }

    public function index()
    {

        $this->data['startDiscount'] = DiscountCards::getStartDiscount();

        $this->data['where'] = '';
        $this->data['whence'] = '';
        $this->data['when'] = '';
        $this->data['comment'] = '';
        $this->data['mobile'] = '';

        if ($_POST) {

            $controlMobile = false;

            if (isset($_POST['number']) && $_POST['number'] != '') {
                if($this->checkMobile($_POST['number'])){
                    $this->model = new Order(['mobile_number' => $_POST['number']], true, true);
                    $this->data['resultAddOrder'] = $this->model->save();
                    if ($this->data['resultAddOrder'] == 1) {
                        $this->data['descriptor'] = 1;
                    }
                    return null;
                }else{
                    $this->data['descriptor'] = 2;
                    $this->data['error'] = 'Не валідний формат номера мобільного телефону.
                 Введіть у форматі: +38XXXXXXXXXX';
                }
//                header('Location:/');
            }


            if(isset($_POST['whereFirst']) && $_POST['whereFirst'] != ''){
                $this->data['where'] = $_POST['whereFirst'];
            }

            if(isset($_POST['whereSecond']) && $_POST['whereSecond'] != ''){
                $this->data['where'] = $_POST['whereSecond'];
            }

            if(isset($_POST['whenceFirst']) && $_POST['whenceFirst'] != ''){
                $this->data['whence'] = $_POST['whenceFirst'];
            }

            if(isset($_POST['whenceSecond']) && $_POST['whenceSecond'] != ''){
                $this->data['whence'] = $_POST['whenceSecond'];
            }

            if(isset($_POST['comment'][0]) && $_POST['comment'][0] !=''){
                $this->data['comment'] = $_POST['comment'][0];
            }

            if(isset($_POST['comment'][1]) && $_POST['comment'][1] !=''){
                $this->data['comment'] = $_POST['comment'][1];
            }

            if(isset($_POST['when'][0]) && $_POST['when'][0] !=''){
                $this->data['when'] = $_POST['when'][0];
            }

            if(isset($_POST['when'][1]) && $_POST['when'][1] !=''){
                $this->data['when'] = $_POST['when'][1];
            }

            if(isset($_POST['mobile'][0]) && $_POST['mobile'][0] !=''){
                $this->data['mobile'] = $_POST['mobile'][0];
                $controlMobile = $this->checkMobile($_POST['mobile'][0]);
            }

            if(isset($_POST['mobile'][1]) && $_POST['mobile'][1] !=''){
                $this->data['mobile'] = $_POST['mobile'][1];
                $controlMobile = $this->checkMobile($_POST['mobile'][1]);
            }


            if (isset($_POST['toOrder']) &&
                (isset($_POST['whereFirst']) || isset($_POST['whereSecond'])) &&
                ($_POST['whereFirst'] != '' || $_POST['whereSecond'] != '') &&
                (isset($_POST['whenceFirst']) || isset($_POST['whenceSecond'])) &&
                ($_POST['whenceFirst'] != '' || $_POST['whenceSecond'] != '') &&
                isset($_POST['when']) && $_POST['when'] != '' &&
                isset($_POST['time']) &&
                ((isset($_POST['automobileFirst']) && $_POST['automobileFirst']!='') ||
                (isset($_POST['automobileSecond']) && $_POST['automobileSecond']!='')) &&
                isset($_POST['services']) &&
                isset($_POST['mobile']) && $_POST['mobile'] != '' && $controlMobile) {

                $variant = null;

                $where = null;
                $whence = null;
                $automobile = null;

                if (isset($_POST['whereFirst']) && isset($_POST['whenceFirst']) && $_POST['whereFirst'] != '') {
                    $variant = 1;
                    $where = $_POST['whereFirst'];
                    $whence = $_POST['whenceFirst'];
                    $automobile = $_POST['automobileFirst'];
                } else {
                    $variant = 2;
                    $where = $_POST['whereSecond'];
                    $whence = $_POST['whenceSecond'];
                    $automobile = $_POST['automobileSecond'];
                }


                if (isset($_POST['distance']) && $_POST['distance'] != null && $_POST['distance'] != 0) {


                    if ($variant) {
                        $service = Service::find($_POST['services'][$variant - 1]);
                        $this->data['price'] = Order::calculatePrice($_POST['distance'], $_POST['services'][$variant - 1], $automobile);
                        $this->data['descriptor'] = 0;
                        Session::set('detailsOrder', array(
                            'where_' => $where,
                            'whence' => $whence,
                            'when_' => $_POST['when'][$variant - 1],
                            'time' => $_POST['time'][$variant - 1],
                            'automobile' => $automobile,
                            'service' => $service->title,
                            'comment' => (isset($_POST['comment'][$variant - 1])) ? $_POST['comment'][$variant - 1] : '',
                            'mobile_number' => $_POST['mobile'][$variant - 1],
                            'price' => $this->data['price'],
                            'distance' => $_POST['distance']
                        ));
                    }
                } else {
                    $this->data['descriptor'] = 2;
                    $this->data['error'] = 'Маршруту не існує';
                }

            } elseif (!$controlMobile){
                $this->data['descriptor'] = 2;
                $this->data['error'] = 'Не валідний формат номера мобільного телефону.
                 Введіть у форматі: +38XXXXXXXXXX';
            } else {
                $this->data['descriptor'] = 2;
                $this->data['error'] = 'Будь-ласка, заповніть усі поля';
            }
            if (isset($_POST['answer']) && $_POST['answer'] == 'success') {
                $detailsOrder = Session::get('detailsOrder');
                $this->model = new Order(['where_' => $detailsOrder['where_'],
                    'whence' => $detailsOrder['whence'],
                    'when_' => $detailsOrder['when_'],
                    'time' => $detailsOrder['time'],
                    'automobile' => $detailsOrder['automobile'],
                    'state_auto_number' => Car::getFirstCarWhoIsFree($detailsOrder['automobile']),
                    'service' => $detailsOrder['service'],
                    'comment' => $detailsOrder['comment'],
                    'mobile_number' => $detailsOrder['mobile_number'],
                    'driver' => Driver::getFirstDriverWhoIsFree(),
                    'price' => $detailsOrder['price'],
                    'distance' => $detailsOrder['distance'],
                    'performance' => 0],
                    true, true);
                $this->data['resultAddOrder'] = $this->model->save();
                $this->data['descriptor'] = 1;
                Session::delete('detailsOrder');
//                header('Location:/');

            }

        }

            $this->data['bodyTypes'] = BodyType::getAllBodyTypeWhosCarsIsFree();

            $this->data['services'] = Service::getExistingRecords();
            return '../views/main/index.php';

    }

    private function checkMobile($mobile)
    {
        $pattern = "/^\+380\d{9}$/";
        if(preg_match($pattern, $mobile)){

            return true;
        }
        return false;
    }

}