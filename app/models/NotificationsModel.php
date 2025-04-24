<?php

    class NotificationsModel{
        use Model;

        protected $table = 'notifications';
        protected $allowedColumns = [
            'notification_Id',
            'recipient_type',
            'recipient_Id',
            'notification_type',
            'notification_title',
            'notification_text',
            'is_read',
            'created_at'
        ];

        public function getNotifications($recipientType, $recipientId){
            $result = $this->where(
                [
                    'recipient_type' =>$recipientType, 
                    'recipient_Id' => $recipientId
                ],
                [
                    'order_by' => 'created_at',
                    'order_type' => 'DESC'
                ]
            );
            return $result;
        }
    }