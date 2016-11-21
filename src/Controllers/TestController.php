<?php

namespace App\Controllers;
use App\Business\EstimatesBSN;
use App\Business\SpecialistBSN;
use App\Business\SurgeryRoomsBSN;
use App\forms\DermatologyForm;
use App\Models\Turns;
use App\Models\PdfCreator;

use App\Business\UserBSN;
use App\Business\TurnBSN;
use App\Business\AgendaBSN;
use App\Business\PaymentBSN;
use App\Business\ProceduresBSN;
use App\Business\MedicalHistoryBSN;
use App\Business\MedicalPlanBSN;
use App\Business\PavilionBSN;
use App\Models\Process;
use App\Business\BranchOfficeBSN;
use App\Business\PreinvoicesBSN;
use App\Business\BedsBSN;
use App\Business\InformesBSN;
use Dompdf\Dompdf;



class TestController extends ControllerBase
{

    public function indexAction()
    {

        $this->view->pick("test/test_form");
        //$this->view->pick("test/dermatology");
    }

    /**
     * Crea turnos
     *
     * Crea turnos de agendamiento en estado 0, partirá
     * desde el día del parámetro enviado hasta el 30 del mes
     * (* No válido para febrero, modificar código)
     *
     * @param integer $data['count'] : cantidad de turnos a crear
     * @param date $data['date'] : dia del mes del cual empezar a crear turnos
     *
     *  
     */
    private function createTurnsAction($param){

        for ($i=0; $i < $param['count'] ; $i++) { 

            $dt = new \DateTime($param['date']);

            $turn = new Turns();
            $turn->usb_id = mt_rand(1,6);
            $turn->turn_state_id = 1;
            $turn->datetime_turn = $dt->format('Y-m')."-".mt_rand($dt->format('d'),30)." ".mt_rand(9,16).":00:00";

            //print_r($turn->toArray());
            if($turn->save() == true)
            {
                foreach ($turn->getMessages() as $message) {
                    $val = $message->getMessage();
                    echo $val."<br>";
                }
            } else{
                echo "Turno {$i} fecha: {$turn->datetime_turn} creado correctamente. <br>";
            }
        }       

    }





    public function  userListAction(){
        $userBSN = new UserBSN();
        $users = $userBSN->index(array('pagination'=> true, 'role' => 'Especialista'));
        foreach ($users->items as $user){
            echo $user->username . ' ' . $user->role;
            echo "<br><br>";
        }
        echo $users->current;
    }

    public function getUserAction(){
        $userBSN = new UserBSN();
        $user = $userBSN->show(array('id' => 3));
        echo $user['app\Models\Users']->username;
        //var_dump($user);
    }

    public function getTurnsDailyAction(){

        $data['date'] = '2016-10-06';

        // En caso de seleccionar un especialista 
        //$data['usb_id'] = 4;


        // En caso de no seleccionar especialista
        $data['specialty_id'] = 6;
        $data['branchOffice_id'] = 1;

        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->getDailyTurns($data);
    }

    public function getTurnsWeeklyAction(){

        $data['date'] = '2016-10-06';
        $data['usb_id'] = 1;

        $agendaBSN = new AgendaBSN();
        $result1 = $agendaBSN->getWeeklyTurns($data);
        print_r($agendaBSN->error);
        $result2 = $agendaBSN->getDaysOfWeekTurn($data);
        print_r($agendaBSN->error);
        print_r($result1);
        print_r($result2);      
    }


    public function turnScheduleAction(){

        /* CREATE ACTIVADO
        $data['create'] = 1;
        $data['turn_id'] = 2;
        $data['data'] = array(
                'firstname' => 'firstname',
                'lastname' => 'lastname',
                'rut' => 'rut',
                'location' => 'location',
                'phone_fixed' => 'phone_fixed',
                'phone_mobile' => 'phone_mobile',
                'medical_plan_id' => '1',
                'email' => 'paciente@prueba.cl'
            );

            */

        /* CREATE DESACTIVADO (SOLO UPDATE)

        $data['turn_id'] = 2;
        $data['data'] = array(
                'patient_id' => 103,
                'rut' => 'rut_mod',
                'phone_fixed' => 'phone_fixed_mod',
                'medical_plan_id' => '2'
            );        

        */

        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->storeTurnSchedule($data);
        print_r($agendaBSN->error);
    }

    public function turnConfirmAction()
    {
        $data['turn_id'] = 2;
        $data['data'] = array(
                'patient_id' => 103,
                'rut' => 'rut',
                'phone_fixed' => 'phone_fixed_remod',
                'medical_plan_id' => '1'
            );        

        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->storeTurnConfirm($data);
        print_r($agendaBSN->error);        
    }

    public function turnReceptionAction()
    {
        $data['turn_id'] = 2;
        $data['data'] = array(
                'patient_id' => 103,
                'phone_fixed' => 'phone_fixed_final'
            );        

        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->storeTurnReception($data);
        print_r($agendaBSN->error);        
    }    

    public function turnPaymentAction()
    {
        $data['turn_id'] = 517;
        $data['data'] = array(
                'payment_category_id' => 1,
                'medical_plan_id' => '1',
                'total' => '10000'
            );        
        $data['agreements'] = array(1);
        $data['payment_details'] = array(
                                           array("payment_id" => 1,
                                                 "payment_method_id" =>1,
                                                 "amount" => 10000
                    )
            );


        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->storeTurnPayment($data);
        print_r($agendaBSN->error);   
    }      


    public function getSchedule(){
        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->index();
        print_r($result->toArray());
    }

    public function paymentmethodsAction(){
        $paymentBSN = new PaymentBSN();
        $result = $paymentBSN->getPaymentMethods();
        print_r($result->toArray());

    }

    public function getSpecialistsUSBAction(){
        $data['specialty_id'] = 1;
        $data['branchOffice_id'] = 1;

        $userBSN = new UserBSN();
        $result = $userBSN->getListSpecialistUSB($data);

        //Ejemplo para acceder a details
        //print_r($result->getFirst()->Users->UserDetails->getFirst()->firstname);
    }

    public function getTurnAction(){
        //$data['turn_id'] = 4;
        $data['datetime'] = "2016-09-21 13:00:00";
        $turnBSN = new TurnBSN();
        $result = $turnBSN->getTurn($data);
        print_r($result);
        print_r($turnBSN->error);
    }


    public function getcitiesbydistrictsAction($districtId){

        $userBSN = new UserBsn();
        $response = $userBSN->getCitiesByDistricts($districtId);

        print_r($response);

    }

    public function getdistrictsAction(){

        $userBSN = new UserBsn();
        $response = $userBSN->getDistricts();

        print_r($response->toArray());

    }



    public function getTurnsAlternativeAction()
    {
        $param['turn_id'] = 1;
        $param['count'] = 3;
        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->getTurnsAlternative($param);
        print_r($result);
        print_r($agendaBSN->error);
    }


    public function getPaymentCategoriesAction()
    {
        $paymentBSN = new PaymentBSN();
        $result = $paymentBSN->getListPaymentCategories();
        print_r($result->toArray());
        print_r($paymentBSN->error);
    }

    public function getBenefitsAction()
    {
        $paymentBSN = new PaymentBSN();
        $result = $paymentBSN->getListBenefits();
        print_r($result->toArray());
        print_r($paymentBSN->error);     
    }

    public function getAgreementsAction(){
        $param['medical_plan_id'] = 1;
        $param['user_id'] = 1;
        $param['specialty_id'] = 1;
        $param['turn_attention_id'] = 1;

        $paymentBSN = new PaymentBSN();

        
        $result = $paymentBSN->getListAgreements($param);


        if($result!=false){

        print_r($result->toArray());

        }
        print_r($paymentBSN->error);   

      
    }


    public function getconfirmationcategoriesAction(){
        $turnBSN = new TurnBSN();
        $result = $turnBSN->getConfirmationCategories();

        print_r($result->toArray());
    }

    public  function listTurnConfigAction(){
        $turnBSN = new TurnBSN();
        $result = $turnBSN->listConfigurations(array('user_id' => 1,
            'specialty_id'=> 1));
        foreach ($result as $var) {
            $temp = $var->toArray();
            foreach ($temp as $value) {
                echo  ' <br>';
                foreach ($value as $key=>$item) {
                    echo '*' . $key . ' : ' . $item . '<br>';
                }
            }
            echo ' <br>';
        }
    }


    public function editMobileTemporaAction() {
        #js custom
        $this->assets->addJs('js/pages/mobileedite.js');
        $this->view->pick("controllers/patient/editmobile/_index");
    }



    public  function deleteTurnConfigAction(){
        $turnBSN = new TurnBSN();
        $result = $turnBSN->deleteConfiguration(2);
        echo $result;
    }

    public function generatePdfAction() {

        $done = $this->pdfcreator->createFromTemplate(
            'test', array('name'=>'Jorge', 'lastname' => 'Cociña'));
        if($done)
        {
            echo 'creado';
        }
        else {
            echo 'error';
        }
    }

    public function pdfcreateAction(){  
        

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();



        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>Turnos test</title>
                        <style type="text/css" >
                          .table {
                              display: table;
                              height:200px;
                              width:200px;
                              margin: 0 auto;
                          }
                          .tr {
                              display: table-row;
                          }
                          .highlight {
                              background-color: greenyellow;
                              display: table-cell;
                          }
                          p{
                            text-align: center;
                          }
                        </style>
                    </head>
               <body>
                <!-- NO MORE CRASH HERE -->
                
                <p>Here is <span class="table"><span class="tr"><span class="highlight">a span</span></span></span> with no padding.</p>

                </body>
            </html>' ;

        
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $fecha = (string)date("d-m-Y");
        $dompdf->stream("Turno ".$fecha);

    }

    public function bloqueaturnoAction($param){

        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->blockTurnbyId($param);
        print_r($agendaBSN->error);
        if($result){
            echo "Exito";
        }else{
            echo "Problemas";
        }
    }

    public function anulaturnoAction(){
        $param['turn_id'] = 517;
        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->cancelTurnbyId($param);
        print_r($agendaBSN->error);
        if($result){
            echo "Exito";
        }else{
            echo "Problemas";
        }
    }

    public function getproceduresAction(){
        $proceduresBSN = new ProceduresBSN();
        $result = $proceduresBSN->getProcedures();

        
        print_r($result->toArray());
    }


    public function getbenefitsbyprocedureidAction($param){
        $proceduresBSN = new ProceduresBSN();
        $result = $proceduresBSN->getProcedure($param);

        echo "<pre> Procedure";
        print_r($result->toArray());

        echo "<br>ProcedureBenefits";
        print_r($result->ProcedureBenefits->toArray());

        echo "<br>Benefits";

        foreach ($result->ProcedureBenefits as $ProcedureBenefits) {

            print_r($ProcedureBenefits->Benefits->toArray());
        
        }

    }

    public function getavailableexamsAction(){
        
        $param['procedure_id']=1;
        $param['date']= "2016-09-21 14:00:00";
        $param['limit']=5;
        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->getAvailableSoonExamsByProcedureId($param);

        print_r($result);
        print_r($agendaBSN->error);
    }


    public function swaltestAction(){

        $this->mifaces->newFaces();





        $config = [
            "type" => "warning",
        ];


        $view = "controllers/scheduling/reception/swal_confirm";
        $toRend = $this->view->getPartial($view);


        $this->mifaces->addToSwalRend($config, $toRend);






        $this->mifaces->run();

    }



    public function storeturnovercrowdAction(){

        //Creando un usuario
        $param['create'] = 1;
        $param['data']['email']='rorigo.s.c.1994@gmail.com';
        $param['data']['patient_id']=11;
        $param['data']['phone_fixed']= 12312312;
        $param['data']['phone_mobile'] = 12312312;
        $param['data']['medical_plan_id'] = 1;
        $param['data']['firstname']="Rodrigo";
        $param['data']['lastname']="Soto";
        $param['data']['rut']= "18.7083.549-k";
        $param['data']['location'] = "Viña del Mar";
        $param['data']['medical_plan_id']=1;

        $param['turn']['usb_id'] = 1;
        $param['turn']['turn_category_id']= 1;
        $param['turn']['datetime_turn']= "2016-09-15 09:00:00";
        $param['turn']['turn_configuration_id']=0;

        $agendaBSN = new AgendaBSN();

        $result = $agendaBSN->storeTurnOvercrowd($param);
        
        print_r($result);

    }

    public function getagreementbyidAction($parametro){

        $param['agreement_id']=$parametro;

        $agendaBSN = new AgendaBSN();

        $agreements = $agendaBSN->getAgreementbyId($param);

        if($agreements != false){
            print_r($agreements->toArray());
        }else{
            print_r($agendaBSN->error);
        }
    }

    public function hmpdfAction() {

            $param = [
                "nombre" => "Hoja de Agendamiento Diario"
            ];

            $this->pdfcreator->createFromTemplate('mh', $param, 'MedicalHistory');

        }    


    public function initAttentionAction(){
        $param['turn_id'] = 3;
        $medicalBSN = new MedicalHistoryBSN();
        $medicalBSN->initAttention($param);
    }

    public function finishAttentionAction(){    
        $param['turn_id'] = 3;
        $medicalBSN = new MedicalHistoryBSN();
        $medicalBSN->finishAttention($param);
    }    


    public function getTimelineAction(){
        $param['user_patient_id'] = 12;
        $param['specialty_id'] = 1;
        $medicalBSN = new MedicalHistoryBSN();
        $medicalBSN->getTimeline($param);

    }


    public function editUserAction(){

        $param['email'] = 'ssilvac@zmed.cl';
        $param['user_id'] = 1;

        $userBSN = new UserBSN();
        $result = $userBSN->editUser($param);
        print_r($result);
    }

    public function getListMedicalHistoryTypeBySpecialtyAction(){
        $param['specialty_id'] = 6;
        $medicalBSN = new MedicalHistoryBSN();
        $result = $medicalBSN->getListMedicalHistoryTypeBySpeciality($param);
        print_r($result->toArray());
    }



    public function creaConfTurnAction(){

        $param['config']['date_ini'] = "2016-12-01";
        $param['config']['date_end'] = "2016-12-05";
        $param['config']['hour_ini'] = "9:00";
        $param['config']['hour_end'] = "18:00";
        $param['config']['interval'] = 30;

        $days = array("1" => true,
                      "2" => true,
                      "3" => true,
                      "4" => true,
                      "5" => true,
                      "6" => false,
                      "7" => false
                );

        $param['config']['days'] = json_encode($days);
        $param['config']['hour_ini_restriction'] = "14:00:00" ;
        $param['config']['hour_end_restriction'] = "15:00:00" ;
        $param['turn']['especialty_id'] = 6;
        $param['turn']['user_id'] = 1;
        $param['turn']['branch_office_id'] = 1;
        $param['turn']['turn_attention_id'] = 1;

        $turnBSN = new TurnBSN();

        $result = $turnBSN->createTurnConfiguration($param);

        echo $result;

        print_r($turnBSN->error);


    }

    public function traelistaAction(){

        $paymentBSN = new PaymentBSN();

        $result = $paymentBSN->getListBenefits();

        print_r($result);
        print_r($paymentBSN->error);

    }

    public function pruebapruebaAction(){

        $result =  Process::find();

        var_dump($result->count());

        if(!$result->count()){
            echo "Retorna False";
            echo "<br>";
            print_r($result);

        }else{
           echo "Retorna otros datos";
           echo "<br>";
           print_r($result);
        }
        

    }

    public function pruebaprueba2Action(){

        $phql = "SELECT * FROM App\Models\Process";

        $result = $this->modelsManager->createQuery($phql)
              ->execute();

        var_dump($result->count());

        if(!$result->count()){
            echo "Retorna False";
            echo "<br>";
            print_r($result);

        }else{
           echo "Retorna otros datos";
           echo "<br>";
           print_r($result);
        }
    }
    

    public function ValidateFormAction(){
       
        $this->mifaces->newFaces();
        $post = $this->request->getPost();

        //print_r($post);exit();
        /*foreach ($post as $key => $value) {

            $arreglo[] =array($key,"*Campo Requerido");
        }*/
        $form = new DermatologyForm();
        $form->set($post);
        if($form->isValid($post)) {
            $this->mifaces->addErrorsForm(array('todo' => 'ok'));
        }
        else {
            $errors = $form->formatMessages();
            $this->mifaces->addErrorsForm($errors);   
            //$this->mifaces->addErrorsForm($form->formatMessages());
        }


        $this->mifaces->run();
    }

    public function pruebaprueba3Action(){
        echo "Prueba";
        $proceduresBSN = new ProceduresBSN();
        $result = $proceduresBSN->getProcedure(500);
        print_r($result);
        print_r($proceduresBSN->error);
    }

    public function pruebaprueba4Action(){
        echo "Prueba 4";
        $branchOfficeBSN = new BranchOfficeBSN();

        $result = $branchOfficeBSN->getBranchOffices();

        print_r($result);

    }

    public function  getSpeBySurgeryRoleAction() {
        $spe = new SpecialistBSN();
        $result = $spe->getSpecialistBySurgeryRole(array('roleId' => 20));
        foreach ($result as $val) {
            echo $val->id . '</br>';
        }
    }

    public function getFreeSurgeryRoomsAction() {
        $sgryRooms = new SurgeryRoomsBSN();
        $result = $sgryRooms->getRooms(array('occupied' => false, 'type' => $sgryRooms->getTypoProcedimientos()));
        if($result == false) {
            print_r($sgryRooms->error);
        }
        else {
            foreach ($result as $val) {
                echo $val->id . '</br>';
            }
        }
    }
    public function getFreeBedsAction() {
        $beds = new BedsBSN();
        $result = $beds->getBeds(array('occupied' => false, 'type' => $beds->getTypeAislada()));
        if($result == false) {
            print_r($beds->error);
        }
        else {
            foreach ($result as $val) {
                echo $val->id . '</br>';
            }
        }
    }

    public function createEstiamteAction() {
        $estimate = new EstimatesBSN();
        /*$date = new DateTime('now');
        $date->format('d-m-Y H:i:s');*/
        $param = array(
            'user_id' => 3,
            'user_specialties_branch_office_id' => 1,
            'benefit_id' => 1
        );
        if($estimate->createEstimate($param)) {
            echo 'done';
        }
        else {
            echo 'fail </br>';
            print_r($estimate->error);
        }
    }

    public function getEstimatesAction(){

        $pavilionBSN = new PavilionBSN();

        $param = array("patient_id" => 1,
                      "order" => array(
                              'created_at' => 'ASC',
                              'approved' => 'DESC')
            );



        $estimates = $pavilionBSN->getEstimatesByPatient($param);

        if ($estimates) {
            echo "<pre>";
            print_r($estimates->toArray());
        }else{
            echo $pavilionBSN->error;
        }
    }

    public function getEstimateAction(){

        $pavilionBSN = new PavilionBSN();

        $param['estimate_id'] = 24;
        $estimate = $pavilionBSN->getEstimateById($param);

        if ($estimate) {
            print_r($estimate);
        }else{
            echo $pavilionBSN->error;
        }
    }


    public function getPreinvoicesByPatientAction(){

        $pavilionBSN = new PavilionBSN();

        $param['patient_id'] = 1;
 
        $invoices = $pavilionBSN->getPreinvoicesByPatientId($param);

        print_r($invoices->toArray());
    }

    public function getPreinvoicesByIdAction(){

        $pavilionBSN = new PavilionBSN();

        $param['preinvoice_id'] = 24;
 
        $invoices = $pavilionBSN->getPreinvoiceById($param);

        print_r($invoices->toArray());

    }



    public function getAdmissionByPatientAction(){

        $pavilionBSN = new PavilionBSN();

        $param['patient_id'] = 2;

        $admissions = $pavilionBSN->getAdmissionsByPatientId($param);


        print_r($admissions->toArray());

    }

    public function getAdmissionByIdAction(){


        $admissionsBSN = new PavilionBSN();
        $param['admission_id'] = 219;

        $admission = $admissionsBSN->getAdmissionById($param);

        if($admission){
            print_r($admission->toArray());
        }
        else{
            echo $admissionsBSN->error;
        }
    }


    public function getAvailabilityAction(){

        $param = ['usb_id' => 1,
                  'surgery_room_id' => 1,
                  'bed_categories_id' => 1];

        $preinvoiceBsn = new PreinvoicesBSN();
        $result = $preinvoiceBsn->getAvailability($param);
    }

    public function getMatchAction(){

        $param['specialists'] = [1,2,3];
        $param['date'] = '2016-10-24';

        $turnBsn = new TurnBSN();
        $result = $turnBsn->getMatchTurnsSpecialists($param);
        print_r($result);


    }

    public function getDaysWeekMatchAction(){

        $param['specialists'] = [1,2,3];
        $param['date'] = '2016-10-24';

        $turnBsn = new TurnBSN();
        $result = $turnBsn->getDaysOfWeekMatchSpecialists($param);
        print_r($result);


    }    


    public function getAvailableBedsAction(){

        $param['date'] = '2016-10-26 00:00:00';
        $param['bedDays'] = 3;
        $param['surgeryTime'] = 30; // Minutos

        $bedBsn = new BedsBSN();

        $result = $bedBsn->getAvailableBeds($param);

        print_r($result);
    }


   public function getAvailableSurgeryRoomsAction(){

        $param['date'] = '2016-10-24 15:00:00';
        $param['surgeryTime'] = 60; // Minutos

        $surgeryRoomsBsn = new SurgeryRoomsBSN();

        $result = $surgeryRoomsBsn->getAvailableSurgeryRooms($param);

        print_r($result);
    }    


    public function finishPreinvoiceAction(){

        $param['surgery_room_id']       = 19;
        $param['bed_id']                = 19; 
        $param['estimate_id']           = 21;         
        $param['surgery_date']          = '2016-10-25 00:00:00';
        $param['surgeryTime']           = 2;         
        $param['bedDays']               = 5;             
        $param['users_surgery_roles']    = [22,23];
        $param['consent']               = 1;
        $param['turns']                 = [5082,5083,5084];


        $preinvoiceBsn = new PreinvoicesBSN();
        $result = $preinvoiceBsn->finishPreinvoice($param);
        if($result){
            print_r($result);
        } else{
            print_r($preinvoiceBsn->error);
        }

    }

    public function createOvercrowdAction(){

        $data['data'] = array(
                'patient_id' => 103,
                'rut' => 'rut_mod',
                'phone_fixed' => '72917289',
                'phone_mobile' => '28482924',
                'turn_category_id' => '1',
                'medical_plan_id' => '2',
                'comments' => '',
                'email' => 'orlando.sc91@gmail.com'
            );        

        $data['usb_id'] = 1;
        $data['date'] = '2016-11-03';
        $data['time'] = '14:00';


        $agendaBSN = new AgendaBSN();
        $result = $agendaBSN->createOvercrowd($data);
        if($result){
            var_dump($result);
        } else {
            print_r($agendaBSN->error);            
        }
        


    }


    public function deleteConfigurationAction() {

        $param['turn_configuration_id'] = 74;

        $turnBsn = new TurnBSN();
        $result = $turnBsn->deleteConfigurationWithTurns($param);
        if($result){
            var_dump($result);
        } else {
            print_r($turnBsn->error);            
        }        



    }

    public function tcpdfAction(){

        
        $this->pdfcreator->pdfEjemplo();
       

    }


    public function  existeConfiguracionAction() {

        $param['config']['interval'] = 15;
        $param['config']['date_ini'] = '2016-11-07';
        $param['config']['date_end'] = '2016-11-09';
        $param['config']['hour_ini'] = '07:00';
        $param['config']['hour_end'] = '09:00';
        $param['config']['hour_ini_restriction'] = '07:00';
        $param['config']['hour_end_restriction'] = '07:00';
        $param['user_id']    = 2;

        $param['config']['days']     = json_encode([1=>true,2=>true,3=>true,5=>true,
            6=>false,
            7=>false]);

        $turnBsn = new TurnBSN();
        $result = $turnBsn->existsTurnConfig($param);
        if($result)
            var_dump($result);
        else
            print_r($turnBsn->error);



    }

    public function  existeConfiguracionExamenAction() {

        $param['config']['date_ini'] = '2016-11-07';
        $param['config']['date_end'] = '2016-11-09';
        $param['user_id']    = 2;

        $param['config']['days']     = json_encode([1=>true,2=>true,3=>true,5=>true,
            6=>false,
            7=>false]);
        $param['exams']    = [
                                '7' => '08:00',
                                '1' => '09:00',
                                '2' => '10:00'
                            ];

        $turnBsn = new TurnBSN();
        $result = $turnBsn->existsTurnConfigExam($param);
        if($result)
            var_dump($result);
        else
            print_r($turnBsn->error);



    }    


    public function getListConfigAction(){

        $param['usb_id'] = 2;

        $turnBsn = new TurnBSN();
        $result = $turnBsn->getListConfiguration($param);
        if($result)
            var_dump($result);
        else
            print_r($turnBsn->error);

    }

    public function probarFiltrosAction(){

        $userBsn = new UserBSN();
        $medicalPlanBsn = new MedicalPlanBSN();
        $paymentBsn    = new PaymentBSN();
        $branchOfficeBsn = new BranchOfficeBSN();
        $turnBsn = new TurnBSN();


        // traer especialistas
        $param['role'] = 3;
        $specialists = $userBsn->index($param);



        // traer previsiones
        $medicalPlan = $medicalPlanBsn->getListMedicalPlan();


        // traer especialidades

        $specialties = $userBsn->getListSpecialties();

        // traer metodos de pago

        $paymentsMethods = $paymentBsn->getPaymentMethods();

        // tipos de pago

        $paymentCategories = $paymentBsn->getListPaymentCategories();

        // sucursales

        $branchOffices = $branchOfficeBsn->getBranchOffices();


        // estados de turno

        $turnStates = $turnBsn->getListTurnStates();

    }

    public function getTurnsFilteredAction() {

        $informesBsn = new InformesBSN();

        $param = [

            'date_ini' => '2016-11-09',
            'date_end' => '2016-11-10',
            'user_id' => 0,
            'medical_plan_id' => 0,
            'specialty_id' => 0,
            'payment_method_id' => 0,
            'payment_category_id' => 0,
            'branch_office_id' => 0,
            'turn_state_id' => 0,

            'pagination' => false,
            'page'       => 1,
            'limit'      => 10

        ];

        $result = $informesBsn->getTurnsFiltered($param);

    }


    public function createTurnosExamenesAction(){


        $param['config']['date_ini'] = '2016-11-07';
        $param['config']['date_end'] = '2016-11-08';

        $param['config']['days']     = json_encode([  1=>true,
                                            2=>true,
                                            3=>true,
                                            4=>true,
                                            5=>true,
                                            6=>false,
                                            7=>false]);

        $param['usb_id'] = 10;

        $param['exams']    = [
                                '7' => '08:30',
                                '1' => '09:30',
                                '2' => '10:30'
                            ];

        $turnBsn = new TurnBSN();
        $result = $turnBsn->createTurnConfigurationExams($param);

        if($result){
            var_dump($result);
        } else {
            print_r($turnBsn->error);
        }
        

    }


    public function getDisponibilidadExamenAction(){


        $turnBsn = new TurnBSN();

        $param['date'] = '2016-11-05';
        $param['limit'] = 3;
        $param['procedure_id'] = 8;

        $result = $turnBsn->getAvailableExams($param);

        if($result)
            print_r($result->toArray());
        else
            print_r($turnBsn->error);

    }

    public function getDiagnosticosAction(){


        $medicalType = 3;
        $dataTurn['turn_id'] = 5239;

        $turnObj = new TurnBSN();
        $medicalObj = new MedicalHistoryBSN();

        $turn = $turnObj->getTurn($dataTurn);


        if(  $medicalType == 3 ){

            $param['specialty_id'] = $turn->UsersSpecialtiesBranchoffices->specialty_id;
            
            $list = $medicalObj->getListDiagnostics($param);
            //$this->mifaces->addToDataSelect()

            print_r($list->toArray()); exit;

        }

    }


}