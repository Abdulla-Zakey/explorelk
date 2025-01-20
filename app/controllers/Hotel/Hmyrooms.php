<?php
include '../app/models/Rooms.php';

class Hmyrooms extends Controller
{

    private $model;
    public function index($a = '', $b = '', $c = '')
    {


        $room = $this->model->get_room();
        $this->view('hotel/myrooms', ['room' => $room]);
    }

    public function __construct()
    {
        $this->model = new Rooms();
    }

    public function create_room()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $roomtype = $_POST['roomType'];
            $roomnumber = $_POST['roomNumber'];
            $roomprice = $_POST['roomPrice'];
            $roomdescription = $_POST['roomDescription'];
            $this->model->insert_room($roomnumber, $roomdescription, $roomtype, $roomprice);
            redirect("Hotel/Hmyrooms");
        }
    }

    public function update_room()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $roomnumber = $_POST['roomNumber'];
            $roomprice = $_POST['roomPrice'];
            $roomdescription = $_POST['roomDescription'];
            $this->model->update_room($id,$roomnumber, $roomdescription, $roomprice);
            redirect("Hotel/Hmyrooms");
        }
    }

    public function delete_room(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
        $this->model->delete_room($id);
        redirect("Hotel/Hmyrooms");
    }
    }
}
