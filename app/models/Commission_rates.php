<?php

class Commission_rates {
    use Model;

    protected $table = 'commission_rates';
    
    protected $allowedColumns = [
        'commission_rate_id',
        'service_type',
        'commission_rate',
        'last_updated',
    ];
}