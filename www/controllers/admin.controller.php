<?php

class AdminController extends Controller
{
    public function __construct(array $data = array())
    {
        parent::__construct($data);

    }

    public function admin_show()
    {

        if(isset($this->getParams()[0])){

            if(strpos($this->getParams()[0], '_')){
                $objects = $this->getParams()[0]::getExistingRecords();
            }else{
                $objects = ucfirst($this->getParams()[0])::getExistingRecords();
            }

            $this->data['records'] = $objects;

            $nameClass = $this->getParams()[0];


            $parameters = $this->getFields($this->getParams()[0]);

//            $nameClass = $this->getParams()[0];

                 if(preg_match('/[A-Z]/', $this->getParams()[0])){

                     $this->data['nameClass'] = $nameClass;
                 }else{

                     $this->data['nameClass'] = lcfirst($nameClass);
                 }

            $this->data['nameForTable'] = $this->getFields($nameClass)['name'];

            if($parameters){
                $this->data['params'] = $parameters['fields'];
            }

            $this->data['nameClass'] = $this->getParams()[0];

        }

        return "../views/user/admin/show.php";
    }


    public function admin_update()
    {

       $nameClass = ucfirst($this->getParams()[0]);

       $idObject = $this->getParams()[1];

       $object = $nameClass::find($idObject);

       $this->data['object'] = $object;

       $this->data['params'] = $this->getFields($nameClass)['fields'];

//       print_r( $this->data['params']);

       $this->data['nameForTable'] = $this->getFields($nameClass)['name'];

       if(preg_match('/[A-Z]/', $this->getParams()[0])){

           $this->data['nameClass'] = $nameClass;
       }else{

           $this->data['nameClass'] = lcfirst($nameClass);
       }

       if(isset($_POST['save'])){

           $paramsForUpdate = $_POST;

           array_pop( $paramsForUpdate);

           $pathForSaveImage = $this->getPathForSaveImage($this->getParams()[0]);

           if($pathForSaveImage) {

               $file_name = $this->downloadImage($pathForSaveImage);

               if ($file_name != null) {
                   $paramsForUpdate['image'] = $file_name;
               }
           }


           if(strcmp($this->data['nameClass'], 'Order')){
               if(isset($_POST['performance']) && $_POST['performance'] == 1){

                   Car::update(Order::find($idObject)->state_auto_number, ['is_free' => 1]);

                   Driver::update(Order::find($idObject)->driver, ['is_free' => 1]);

                   Order::setNullStateAutoNumber($idObject);

                   $order = Order::find($idObject);
                   if($order){
                       $idClient = $order->client;
                       if($idClient){
                           $countTravels = Discount::find($idClient)->travels;
                           Discount::update($idClient,['travels' => $countTravels+1]);
                           DiscountCards::checkNecessityUpdateDiscount($idClient);
                       }
                   }
               }
           }


           if(strcmp($this->data['nameClass'], 'Order')){
               if(isset($_POST['performance']) && $_POST['performance'] == 1){
                   Order::setNullDriver($idObject);
               }
           }


           $resultUpdate = null;


           try{
               $resultUpdate = $nameClass::update($idObject, $paramsForUpdate);
           }catch (Exception $exception){$exception->getMessage();}

           $this->data['resultUpdate'] = $resultUpdate;

       }

       return "../views/user/admin/update.php";
    }

    public function admin_delete()
    {

        $this->data['showConfirmationBlock'] = 1;

        $this->data['nameClass'] = ucfirst($this->getParams()[0]);


        if(isset($_POST['confirmation']) && $_POST['confirmation'] == 1){


            $this->data['showConfirmationBlock'] = 1;

            $this->data['nameClass'] = ucfirst($this->getParams()[0]);

            $nameClass = ucfirst($this->getParams()[0]);

            $idObject = $this->getParams()[1];

            $this->data['nameForTable'] = $this->getFields(lcfirst($nameClass))['name'];

            $resultDelete = null;

            try{
                $resultDelete = $nameClass::delete($idObject);
            }catch (Exception $ex){}


            if(!$resultDelete){
                $resultDelete = false;
            }

            $this->data['resultDelete'] = $resultDelete;

        }

        return "../views/user/admin/delete.php";
    }


    public function admin_add()
    {
        $nameClass = ucfirst($this->getParams()[0]);

        $needView = $this->getFields($nameClass)['create']['view'];

        $this->data['params'] = $this->getFields($nameClass)['fields'];

        $foreign_params = $this->getFields($nameClass)['foreign'];

        if(empty($foreign_params) == false){

            $foreignRecords = $foreign_params['foreign_table']::getExistingRecords();

            if($foreignRecords){
                $this->data['foreignRecords'] = $foreignRecords;

                $this->data['foreignField'] = $foreign_params["foreign_field"];

                $this->data['foreignFields'] = $this->getFields($foreign_params['foreign_table'])['fields'];
            }
        }

        $this->data['nameForTable'] = $this->getFields($nameClass)['name'];

        $this->data['nameClass'] = $nameClass;

        if($_POST){
            print_r($_POST);

            $paramsForCreate = $_POST;

            array_pop( $paramsForCreate);

            $pathForSaveImage = $this->getPathForSaveImage($this->getParams()[0]);

            if($pathForSaveImage) {

                $file_name = $this->downloadImage($pathForSaveImage);

                if ($file_name != null) {
                    $paramsForCreate['image'] = $file_name;
                }

            }
            $object = new $nameClass($paramsForCreate, true, true);

            $resultCreate = $object->save();

            $this->data['resultCreate'] = $resultCreate;
        }
        if($needView)
        {
            return $needView;

        }else{

            return "../views/user/admin/add.php";

        }

    }

    public function dispatcher()
    {

        $this->data['newOrders'] = Order::getNewOrders();

        return "../views/user/admin/dispatcher/dispatcher_show.php";
    }

    private function getFields($tableSearch)
    {
        $tables = Config::get('adminTables');

        $search_table = null;

        if(preg_match('/[A-Z]/', lcfirst($tableSearch))){
            $search_table = $tableSearch;
        }else{
            $search_table = lcfirst($tableSearch);
        }


        foreach ($tables as $table => $params){
            if(strcmp($table, $search_table) == 0){
                return $params;
            }
        }
        return false;
    }

    private function downloadImage($pathToSave):string
    {
        if(isset($_FILES['image'])){
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            echo $file_name;
            $expensions = array("png", "JPG", "JPEG");

            if($file_size > 2097152){
                $errors = "Файл повинен бути2мб";
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp, $pathToSave.$file_name);
                return $file_name;
            }else{
                print_r($errors);
            }
        }
    }

    private function getPathForSaveImage($table)
    {
        $params = $this->getFields($table);

        return $params['pathForSaveImage'];
    }

}