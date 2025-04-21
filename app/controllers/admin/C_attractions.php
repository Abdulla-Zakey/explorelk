<?php 

/**
 * Content Management class
 */
class C_attractions extends Controller
{
	private $topDistrictsModel;
	private $districtPicsModel;
	private $attractionsModel;
	private $attractionPicsModel;
	private $thingsToDoModel;

	public function __construct(){
		$this->topDistrictsModel = new TopDistrictsModel();
        $this->districtPicsModel = new DistrictsPicsModel();
        $this->attractionsModel = new AttractionsModel();
        $this->attractionPicsModel = new AttractionPicsModel();
		$this->thingsToDoModel = new ThingsToDoModel();
	}

	public function index($action = '', $district_id = '')
	{
		$districts = $this->topDistrictsModel->selectALL();
		$topDistricts = $this->topDistrictsModel->selectAll();

		$selectedDistrict = NULL;

		if ($action == 'district' && !empty($district_id)) {
			$selectedDistrict = $district_id;
			$attractions = $this->attractionsModel->getByDistrict($district_id);
		} else {
			$attractions = $this->attractionsModel->selectAll();
		}

		$data = [
			'districts' => $districts,
			'attractions' => $attractions,
			'top_districts' => $topDistricts,
			'selected_district' => $selectedDistrict,
		];

		$this->view('admin/attractions', $data);
	}

	public function districtFilter($district_id = '') {
		$this->index('district', $district_id);
	}

	public function editAttraction() {
		$district_id = $_GET['district_id'] ?? null;
		$attraction_name = $_GET['attraction_name'] ?? null;
		
		if($district_id === null || $attraction_name === null) {
			header("Location: " . ROOT . "/admin/C_attractions");
			exit();
		}
		
		// Get attraction details
		$attractionDetails = $this->attractionsModel->getAttractionByNameAndDistrict($attraction_name, $district_id);
		// show($attractionDetails->attraction_id);

		$attraction_id = $attractionDetails->attraction_id;


		// Get districts data for dropdown
		$districts = $this->topDistrictsModel->selectALL();
		$attractionPics = $this->attractionPicsModel->getPicturesForAttraction($attraction_id);
		$thingsToDo = $this->thingsToDoModel->getThingsToDo($attraction_id);
		// show($thingsToDo);

		$data = [
			'districts' => $districts,
			'attraction' => $attractionDetails,
			'attractionPics' => $attractionPics,
			'thingsToDo' => $thingsToDo,
		];
		
		// Load the edit view with the data
		$this->view('admin/editAttraction', $data);
	}

	public function viewAttraction(){
		$district_id = $_GET['district_id'] ?? null;
		$attraction_name = $_GET['attraction_name'] ?? null;

		// Get attraction details
		$attractionDetails = $this->attractionsModel->getAttractionByNameAndDistrict($attraction_name, $district_id);
		// show($attractionDetails->attraction_id);

		$attraction_id = $attractionDetails->attraction_id;


		// Get districts data for dropdown
		$districts = $this->topDistrictsModel->selectALL();
		$attractionPics = $this->attractionPicsModel->getPicturesForAttraction($attraction_id);
		$thingsToDo = $this->thingsToDoModel->getThingsToDo($attraction_id);
		// show($thingsToDo);

		$data = [
			'district_id' => $district_id,
			'attraction' => $attractionDetails,
			'attractionPics' => $attractionPics,
			'thingsToDo' => $thingsToDo,
		];

		$this->view('admin/viewAttraction', $data);
	}

}