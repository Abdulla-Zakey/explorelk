<?php 

/**
 * Content Management class
 */
class C_commissions extends Controller {
    private $commission_ratesModel;
	private $tourGuideCommissionModel;

    public function __construct(){
        $this->commission_ratesModel = new Commission_rates();
		$this->tourGuideCommissionModel = new TourGuideCommissions; 
    }

    public function index() {
        $commission_rates = $this->commission_ratesModel->selectAll();

        $tourGuideCommissions = $this->tourGuideCommissionModel->where(['status' => 'pending']);

        // show($commission_rates);

        $data = [
            'commission_rates' => $commission_rates,
            'tourGuideCommissions' => $tourGuideCommissions,
        ];

        $this->view('admin/commissions', $data);
    }

    public function approve(){
        // echo 'hi';
        $commission_id = $_GET['commission_id'];
        $user = $_GET['user'];
        // echo $user;
        // $this->tourGuideCommission
        if ($user == 'tourGuide') {
            // echo 'tour';
            $data = [
                'status' => 'approved',
            ];
            $this->tourGuideCommissionModel->update($commission_id, $data, 'commission_id');
        }

        $current_tab = $_GET['current_tab'] ?? 'commission';
        $service_tab = $_GET['service_tab'] ?? 'tour-guide';
        
        // Redirect back with the tab parameters
        redirect("admin/C_commissions?tab=$current_tab&service=$service_tab");
    }
}