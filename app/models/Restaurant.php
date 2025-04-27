<?php
class Restaurant
{
    use Model;
    protected $table = 'restaurant';
    protected $allowedColumns = [
        'restaurantName',
        'ownerName',
        'restaurantEmail',
        'restaurantPassword',
        'restaurantMobileNum',
        'restaurantAddress',
        'district',
        'province',
        'BRNum',
        'yearStarted',
        'profilePhoto',
        'hotelPhotos',
        'description'
    ];

    public function find($id)
    {
        $query = "SELECT * FROM $this->table WHERE restaurant_id = :restaurant_id LIMIT 1";
        $result = $this->query($query, ['restaurant_id' => $id]);
        return $result ? $result[0] : null;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->query($query);
        return $result ?: [];
    }

    public function update($id, $data)
    {
        $data = array_intersect_key($data, array_flip($this->allowedColumns));
        $set = [];
        $params = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
            $params[$key] = $value;
        }
        $params['restaurant_id'] = $id;
        $query = "UPDATE $this->table SET " . implode(', ', $set) . " WHERE restaurant_id = :restaurant_id";
        return $this->query($query, $params);
    }
}