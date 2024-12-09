<?php

class C_addTour extends Controller {

    public function index()
    {
        $this->view('tourGuide/addTour');
    }

    public function add()
{
    // Collect POST data for the tour package
    $data = [
        'package_name' => $_POST['package-name'] ?? '',
        'tour_location' => $_POST['tour-location'] ?? '',
        'duration' => $_POST['duration'] ?? '',
        'number_of_people' => $_POST['number-of-people'] ?? '',
        'rate' => $_POST['rate'] ?? '',
        'description' => $_POST['description'] ?? '',
        'activity_name' => $_POST['activity-name'] ?? '',
        'images' => $_FILES['images'] ?? [], // Handle file uploads
    ];

    // Validate the data
    $errors = [];
    if (empty($data['package_name'])) {
        $errors['package_name'] = 'Tour package name is required';
    }
    if (empty($data['tour_location'])) {
        $errors['tour_location'] = 'Tour location is required';
    }
    if (empty($data['duration'])) {
        $errors['duration'] = 'Duration is required';
    }
    if (empty($data['number_of_people'])) {
        $errors['number_of_people'] = 'Number of people is required';
    }
    if (empty($data['rate'])) {
        $errors['rate'] = 'Rate is required';
    }
    if (empty($data['description'])) {
        $errors['description'] = 'Description is required';
    }
    if (empty($data['activity_name'])) {
        $errors['activity_name'] = 'Activity name is required';
    }

    // Validate file upload
    if (empty($data['images']['name'][0])) {
        $errors['images'] = 'At least one image is required';
    } else {
        // File upload logic
        $uploadedImages = [];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Allowed image types
        $uploadDir = '../public/assets/images/'; // Upload directory

        foreach ($data['images']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($data['images']['name'][$key]);
            $fileTmpPath = $data['images']['tmp_name'][$key];
            $fileType = $data['images']['type'][$key];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            // Validate file type
            if (!in_array($fileType, $allowedTypes)) {
                $errors['images'] = 'Invalid image type. Only JPG, PNG, or GIF are allowed.';
                break;
            }

            // Sanitize and create unique file name
            $sanitizedFileName = uniqid('tour_image_', true) . '.' . $fileExtension;
            $uploadPath = $uploadDir . $sanitizedFileName;

            // Ensure directory exists
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                $uploadedImages[] = '/assets/images/' . $sanitizedFileName; // Save the relative path
            } else {
                $errors['images'] = 'File upload failed. Please try again.';
                break;
            }
        }

        if (!empty($uploadedImages)) {
            // Add the uploaded image paths to the data
            $data['images'] = implode(',', $uploadedImages);
        }
    }

    if (!empty($errors)) {
        // Pass errors to the view
        $this->view('/tourGuide/addTour', ['errors' => $errors, 'data' => $data]);
        return;
    }

    // Save tour package data to the database
    $tourPackageModel = $this->loadModel('TourPackageModel');
    $tourPackageModel->save($data);

    // Redirect to the tour package list or success page
    redirect('tourGuide/C_tourPackages');
}

}
