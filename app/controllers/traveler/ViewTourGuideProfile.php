<?php
    class viewTourGuideProfile extends Controller{

        private $tourguideModel;
        private $tourPackagesModel;
        private $tourPackageImagesModel;

        public function __construct(){
            $this->tourguideModel = new TourGuide_M();
            $this->tourPackagesModel = new TourPackages();
            $this->tourPackageImagesModel = new TourPackageImages();
           
        }

        public function index($guide_id){

            $guide = $this->tourguideModel->first(['guide_id' => $guide_id]);

            $tourPackages = $this->tourPackagesModel->where(
                ['guide_id' => $guide_id], 
                [
                    'order_by' => 'name',
                    'order_type' => 'ASC',
                    'limit' => 3 
                ]
            );

            foreach($tourPackages as $tourPackage){

                $primaryImage = $this->tourPackageImagesModel->first(
                    [
                        'package_id' => $tourPackage->package_id, 
                        'is_primary' => 1
                    ]
                );

                if($primaryImage){
                    // Add primaryImage as a property to each tourPackage
                    $tourPackage->primaryImage = $primaryImage->image_path;
                }
                
            }

            $data['guideData'] = $guide;
            $data['upcomingTours'] = $tourPackages;

            $this->view('traveler/viewTourGuideProfile', $data);
        }
        
    }