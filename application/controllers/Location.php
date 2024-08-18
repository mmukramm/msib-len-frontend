<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Location extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('api_helper');
    }

    public function index()
    {
        $apiUrl = 'http://localhost:8080/api/locations';

        $response = callAPI('GET', $apiUrl);

        if (isset($response['error']) && $response['error']) {
            // Handle error
            $data['locations'] = array();
            $data['error'] = $response['message'];
        } else {
            $data['locations'] = $response['data'];
            $data['error'] = null;
        }
        $data['title'] = "Locations";

        $this->load->view('page/location', $data);
    }

    public function add_location_page()
    {
        $data["title"] = "Add Location";
        $this->load->view('page/add-location', $data);
    }

    public function create_location()
    {
        $requestForm = array(
            'locationName' => $this->input->post('locationName'),
            'country' => $this->input->post('country'),
            'province' => $this->input->post('province'),
            'city' => $this->input->post('city')
        );

        $apiURL = 'http://localhost:8080/api/locations';

        $response = callAPI('POST', $apiURL, $requestForm);

        if (isset($response['error']) && $response['error']) {
            echo "Error: " . $response['message'];
        } else {
            redirect('Location/index');
        }
    }
    
    public function delete_location() {
        $id = $this->input->post('id');
        
        if (!$id) {
            show_error('Location ID is required.');
            return;
        }
    
        $apiURL = 'http://localhost:8080/api/locations/' . $id;
    
        $response = callAPI('DELETE', $apiURL, null);
    
        if (isset($response['error']) && $response['error']) {
            show_error($response['message']);
        } else {
            redirect('location'); 
        }
    }

    public function edit_location_page($id)
    {
        $apiURL = 'http://localhost:8080/api/locations/' . $id;

        $response = callAPI('GET', $apiURL, null);
        $data["title"] = "Edit Location";

        if (isset($response['error']) && $response['error']) {
            echo "Error: " . $response['message'];
        } else {
            $data['location'] = $response['data'];
            $this->load->view('page/add-location', $data);
        }
    }

    public function edit_location()
    {
        $id = $this->input->post('id');
        $data = array(
            'locationName' => $this->input->post('locationName'),
            'country' => $this->input->post('country'),
            'province' => $this->input->post('province'),
            'city' => $this->input->post('city')
        );

        $apiURL = 'http://localhost:8080/api/locations/' . $id; 

        $response = callAPI('PUT', $apiURL, $data);

        if (isset($response['error']) && $response['error']) {
            echo "Error: " . $response['message'];
        } else {
            redirect('Location/index');
        }
    }
}
