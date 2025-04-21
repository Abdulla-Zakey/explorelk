<?php 

/**
 * Content Management class
 */
class C_commissions extends Controller {
    private $commission_ratesModel;

    public function index() {
        $commission_ratesModel = new Commission_rates();

        $commission_rates = $commission_ratesModel->selectAll();

        // show($commission_rates);

        $data = [
            'commission_rates' => $commission_rates,
        ];

        $this->view('admin/commissions', $data);
    }
}