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
        $this->errors = [];

        // Validate trip name
        if (empty($data['tripName'])) {
            $this->errors['tripName'] = "Trip name is required.";
        } elseif (strlen($data['tripName']) > 100) {
            $this->errors['tripName'] = "Trip name cannot exceed 100 characters.";
        }

        // Validate starting location
        if (empty($data['startingLocation'])) {
            $this->errors['startingLocation'] = "Starting location is required.";
        }

        // Validate destination
        if (empty($data['destination'])) {
            $this->errors['destination'] = "Destination is required.";
        }

        // Validate dates
        if (empty($data['startDate'])) {
            $this->errors['startDate'] = "Start date is required.";
        }

        if (empty($data['endDate'])) {
            $this->errors['endDate'] = "End date is required.";
        }

        if (!empty($data['startDate']) && !empty($data['endDate'])) {
            $startDate = strtotime($data['startDate']);
            $endDate = strtotime($data['endDate']);

            if ($startDate > $endDate) {
                $this->errors['endDate'] = "End date must be after start date.";
            }
        }

        // Optional validations
        if (!empty($data['numberOfTravelers']) && $data['numberOfTravelers'] <= 0) {
            $this->errors['numberOfTravelers'] = "Number of travelers must be positive.";
        }

        if (!empty($data['budgetPerPerson']) && $data['budgetPerPerson'] < 0) {
            $this->errors['budgetPerPerson'] = "Budget per person cannot be negative.";
        }

        return empty($this->errors);
    }
}