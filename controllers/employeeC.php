<?php
class EmployeeController {
    public function construct(){}

    public function index() {
      $this->list();
    }
    public function list(){
      require_once MODELS.DS.'employeeM.php';
      $m=new EmployeeModel();
      $employees=$m->listAll();
      // Affichage au sein de la vue des données récupérées via le model
      require_once CLASSES.DS.'view.php';
      $v=new View();
      $v->setVar('employeelist',$employees);
      $v->render('employee','list');
    }
    public function view($id=null){
      require_once MODELS.DS.'employeeM.php';
      $m=New EmployeeModel();
      require_once CLASSES.DS.'view.php';
      $v=new View();
      if ($employee=$m->listOne($id)) $v->setVar('e',$employee);
      // Affichage au sein de la vue des données récupérées via le model
      $v->render('employee','view');
    }
    public function edit($id=null){
        require_once MODELS.DS.'employeeM.php';
        $m = new EmployeeModel();
        //$data = $m->listOne($id);

        require_once  CLASSES.DS. 'view.php';
        $v = new View();


        // Affichage au sein de la vue des données récupérées via le model
        if(isset($_POST['submit']))
        {
            $data= array
            (

                'EmployeeID'=>$_POST['EmployeeID'],
                'NationalIDNumber'=>$_POST['NationalIDNumber'],
                'LoginID' => $_POST['LoginID'],
                'BirthDate' => $_POST['BirthDate'],
                'MaritalStatus' => $_POST['MaritalStatus'],
                'Gender' => $_POST['Gender'],
                'EmailAddress' => $_POST['EmailAddress'],
                'EmailPromotion' => $_POST['EmailPromotion'],
                'Phone' => $_POST['Phone'],
                'Title' => $_POST['ETitle']

            );
            if ($m->updateOne($data)) {
                $v->render('employee', 'index');
               // $this->index();
            }
        }
        else
        {
            $employee=$m->listOne($id) ;
            $v->setVar('e',$employee);
            $v->render('employee','update');
        }

    }

    public function delete($id=null){
      require_once MODELS.DS.'employeeM.php';
      $m = new EmployeeModel();
      require_once  CLASSES.DS. 'view.php';
      $v = new View();
      $m->deleteOne($id);
      $this->index();

    }

}
?>