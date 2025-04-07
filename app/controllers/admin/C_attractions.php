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

	public function __construct(){
		$this->topDistrictsModel = new TopDistrictsModel();
        $this->districtPicsModel = new DistrictsPicsModel();
        $this->attractionsModel = new AttractionsModel();
        $this->attractionPicsModel = new AttractionPicsModel();
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

}