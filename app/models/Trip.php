<?php

class Trip
{
    use Model;

    protected $table = 'trips';

    protected $allowedColumns = [
        'traveler_Id',
        'tripName',
        'startingLocation',
        'destination',
        'startDate',
        'endDate',
        'departureTime',
        'transportationMode',
        'numberOfTravelers',
        'budgetPerPerson'
    ];

    public function validate($data)
    {
        $errors = [];

        // Validate trip name
        if (empty($data['tripName'])) {
            $errors['tripName'] = "Trip Name is required.";
        } elseif (strlen($data['tripName']) > 20) {
            $errors['tripName'] = "Trip Name cannot exceed 20 characters.";
        }

        // Validate starting location
        if (empty($data['startingLocation'])) {
            $errors['startingLocation'] = "Starting Location is required.";
        }

        // Validate destination
        if (empty($data['destination'])) {
            $errors['destination'] = "Destination is required.";
        }

        // Validate dates
        if (empty($data['startDate'])) {
            $errors['startDate'] = "Start date is required.";
        }
        else if($data['startDate'] < date('Y-m-d')){
            $errors['startDate'] = "Start date cannot be in the past!";
        }

        if (empty($data['endDate'])) {
            $errors['endDate'] = "End date is required.";
        }

        if (!empty($data['startDate']) && !empty($data['endDate'])) {
            $startDate = strtotime($data['startDate']);
            $endDate = strtotime($data['endDate']);

            if ($startDate > $endDate) {
                $errors['endDate'] = "End date must be after start date.";
            }
        }

        // Optional validations
        if (!empty($data['numberOfTravelers']) && $data['numberOfTravelers'] <= 0) {
            $errors['numberOfTravelers'] = "No of travelers must be positive.";
        }

        if (!empty($data['budgetPerPerson']) && $data['budgetPerPerson'] < 0) {
            $errors['budgetPerPerson'] = "Budget per person can't be negative.";
        }

        // return empty($errors);
        return $errors;
    }
}