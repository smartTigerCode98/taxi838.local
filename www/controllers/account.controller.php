
<?php

class AccountController extends  Controller
{
    public function __construct(array $data = array())
    {
        parent::__construct($data);

    }

    public function index()
    {
        return "../views/user/account.php";
    }
    public function admin_index()
    {
        $this->data['tables'] = Config::get("adminTables");
        return "../views/user/admin_account.php";
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location:/');
    }

    public function admin_logout()
    {
        unset($_SESSION['user']);
        header('Location:/admin/login');
    }

    public function order()
    {

        $this->data['where'] = '';
        $this->data['whence'] = '';
        $this->data['when'] = '';
        $this->data['comment'] = '';

        if(isset($_POST['toOrder'])){

            if(isset($_POST['where_']) && isset($_POST['whence'])
                && isset($_POST['when_']) && isset($_POST['time'])
                && isset($_POST['automobile']) && isset($_POST['services'])){

                    $this->data['where'] = $_POST['where_'];
                    $this->data['whence'] = $_POST['whence'];
                    $this->data['when'] = $_POST['when_'];
                    $this->data['comment'] = $_POST['comment'];

            }else{
                $this->data['descriptor'] = 2;
                $this->data['error'] = 'Будь-ласка, заповніть усі поля';
            }

            if (isset($_POST['distance']) && $_POST['distance'] != null && $_POST['distance'] != 0) {
                    $client = User::find(Session::get('user'));
                    $service = Service::find($_POST['services']);
                    $this->data['price'] = Order::calculatePrice($_POST['distance'], $_POST['services'], $_POST['automobile'])*(1-(($client->discount)->discount)/100);
                    $this->data['descriptor'] = 0;
                    Session::set('detailsOrder', array(
                        'client' => $client->id,
                        'where_' => $_POST['where_'],
                        'whence' => $_POST['whence'],
                        'when_' => $_POST['when_'],
                        'time' => $_POST['time'],
                        'automobile' => $_POST['automobile'],
                        'service' => $service->title,
                        'comment' => (isset($_POST['comment'])) ? $_POST['comment'] : '',
                        'mobile_number' => $client->mobile,
                        'price' => $this->data['price'],
                        'distance' => $_POST['distance']
                    ));

            } else {
                $this->data['descriptor'] = 2;
                $this->data['error'] = 'Маршруту не існує';
            }

        }

        if (isset($_POST['answer']) && $_POST['answer'] == 'success') {
            $detailsOrder = Session::get('detailsOrder');
            $this->model = new Order(['client' => $detailsOrder['client'],
                'where_' => $detailsOrder['where_'],
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
        $this->data['services'] = Service::getExistingRecords();
        $this->data['bodyTypes'] = BodyType::getAllBodyTypeWhosCarsIsFree();
        return  "../views/user/order.php";
    }

    public function history()
    {

        $client = User::find(Session::get('user'));

        $this->data['orders'] = $client->orders()->and('performance = ?', 1)->orderBy('when_', 'DESC')->get();

        $this->data['services'] = Service::getExistingRecords();

        $this->data['automobile'] = BodyType::getExistingRecords();

        $minPrice = null;
        $maxPrice = null;

        $minDistance = null;
        $maxDistance = null;

        $service = null;
        $automobile = null;

        $this->data['minPrice'] = null;
        $this->data['maxPrice'] = null;

        $this->data['minDistance'] = null;
        $this->data['maxDistance'] = null;

        if(isset($_POST['filterTrips'])){
            if(isset($_POST['minPrice'])){
                $minPrice = $_POST['minPrice'];
                $this->data['minPrice'] = $_POST['minPrice'];
            }

            if(isset($_POST['maxPrice'])){
                $maxPrice = $_POST['maxPrice'];
                $this->data['maxPrice'] = $_POST['maxPrice'];
            }

            if(isset($_POST['minDistance'])){
                $minDistance = $_POST['minDistance'];
                $this->data['minDistance'] = $_POST['minDistance'];
            }

            if(isset($_POST['maxDistance'])){
                $maxDistance = $_POST['maxDistance'];
                $this->data['maxDistance'] = $_POST['maxDistance'];
            }

            if(isset($_POST['serviceFilter'])){
                $service = $_POST['serviceFilter'];
            }

            if(isset($_POST['automobileFilter'])){
                $automobile = $_POST['automobileFilter'];
            }

            $resultOrders = Order::filterOrders(Session::get('user'),$minPrice, $maxPrice, $minDistance, $maxDistance, $service, $automobile);

            if($resultOrders){
                $this->data['orders'] = $resultOrders;
            }
        }

        $this->data['totalPrice'] = 0;

        $this->data['totalDistance'] = 0;

        if($this->data['orders']){
            $this->data['totalPrice'] = Order::calculateTotalPrice($this->data['orders']);

            $this->data['totalDistance'] = Order::calculateTotalDistance($this->data['orders']);
        }



//        $discount = $client->discount;

        return  "../views/user/history.php";
    }

    public function current_orders()
    {
        $client = User::find(Session::get('user'));
        $this->data['current_orders'] = $client->orders()->and('performance = ?', 0)->get();
        return '../views/user/delete_order.php';
    }

    public function delete_order()
    {

        $this->data['showConfirmationBlock'] = 1;

        if(isset($_POST['confirmation']) && $_POST['confirmation'] == 1){


            $this->data['showConfirmationBlock'] = 1;

            $order = Order::find($this->getParams()[0]);

            $driver = $order->driver;

            $car = $order->state_auto_number;

            Driver::update($driver, ['is_free' => 1]);

            Car::update($car, ['is_free' => 1]);

            try{
                $resultDelete = Order::delete($this->getParams()[0]);
            }catch (Exception $ex){}


            if(!$resultDelete){
                $resultDelete = false;
            }

            $this->data['resultDelete'] = $resultDelete;

        }
        $this->data['showConfirmationBlock'] = 1;
        return '../views/user/delete_current_order.php';
    }

    public function personal_data()
    {
        $this->data['user'] = User::find(Session::get('user'));

        $this->data['discount'] = $this->data['user']->discount;

        return '../views/user/personal_data.php';
    }
}