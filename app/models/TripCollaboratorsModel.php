<?php
    class TripCollaboratorsModel{
        use Model;

        protected $table = 'trip_collaborators';

        protected $allowedColumns = [
            'collaborator_Id',
            'trip_Id',
            'collaborator_traveler_Id',
            'trip_owner_Id',
            'role',
            'request_status'
        ];

    }