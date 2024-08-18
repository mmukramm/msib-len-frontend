<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('api_helper');
    }

    public function index()
    {
        $apiUrl = 'http://localhost:8080/api/projects';

        $response = callAPI('GET', $apiUrl);

        if (isset($response['error']) && $response['error']) {
            // Handle error
            $data['projects'] = array();
            $data['error'] = $response['message'];
        } else {
            $data['projects'] = $response['data'];
            $data['error'] = null;
        }
        $data['title'] = "Projects";

        $this->load->view('page/dashboard', $data);
    }

    public function add_project_page()
    {
        $apiUrl = 'http://localhost:8080/api/locations';

        $response = callAPI('GET', $apiUrl);

        if (isset($response['error']) && $response['error']) {
            $data['locations'] = array();
            $data['error'] = $response['message'];
        } else {
            $data['locations'] = $response['data'];
            $data['error'] = null;
        }

        $data["title"] = "Add Project";
        $this->load->view('page/add-project', $data);
    }

    public function edit_project_page($id)
    {
        $apiUrl = 'http://localhost:8080/api/projects/' . $id;
        $locationApiUrl = 'http://localhost:8080/api/locations';

        $projectResponse = callAPI('GET', $apiUrl);

        $locationsResponse = callAPI('GET', $locationApiUrl);

        if (isset($projectResponse['error']) && $projectResponse['error']) {
            $data['project'] = array();
            $data['error'] = $projectResponse['message'];
        } else {
            $data['project'] = $projectResponse['data'];
            $data['error'] = null;
        }

        if (isset($locationsResponse['error']) && $locationsResponse['error']) {
            $data['locations'] = array();
            $data['error'] = $locationsResponse['message'];
        } else {
            $data['locations'] = $locationsResponse['data'];
            $data['error'] = null;
        }

        $data["title"] = "Edit Project";
        $this->load->view('page/add-project', $data);
    }

    public function delete_project() {
        $id = $this->input->post('id');
        
        if (!$id) {
            show_error('Location ID is required.');
            return;
        }
    
        $apiURL = 'http://localhost:8080/api/projects/' . $id;
    
        $response = callAPI('DELETE', $apiURL, null);
    
        if (isset($response['error']) && $response['error']) {
            show_error($response['message']);
        } else {
            redirect('location'); 
        }
    }

    public function add_project()
    {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        $startDateFormatted = date('Y-m-d\TH:i:s', strtotime($startDate));
        $endDateFormatted = date('Y-m-d\TH:i:s', strtotime($endDate));

        $formattedLocations = $this->formatLocations($this->input->post('locations'));

        $requestForm = array(
            'projectName' => $this->input->post('projectName'),
            'clientName' => $this->input->post('clientName'),
            'projectLeader' => $this->input->post('projectLeader'),
            'projectDetail' => $this->input->post('projectDetail'),
            'startDate' => $startDateFormatted,
            'endDate' => $endDateFormatted,
            'locations' => $formattedLocations
        );

        $apiURL = 'http://localhost:8080/api/projects';


        $response = callAPI('POST', $apiURL, $requestForm);

        // var_dump($response);

        if (isset($response['error']) && $response['error']) {
            echo "Error: " . $response['message'];
        } else {
            redirect('Dashboard/index');
        }
    }

    public function edit_project()
    {
        $id = $this->input->post('id');

        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        $startDateFormatted = date('Y-m-d\TH:i:s', strtotime($startDate));
        $endDateFormatted = date('Y-m-d\TH:i:s', strtotime($endDate));

        $formattedLocations = $this->formatLocations($this->input->post('locations'));

        $requestForm = array(
            'projectName' => $this->input->post('projectName'),
            'clientName' => $this->input->post('clientName'),
            'projectLeader' => $this->input->post('projectLeader'),
            'projectDetail' => $this->input->post('projectDetail'),
            'startDate' => $startDateFormatted,
            'endDate' => $endDateFormatted,
            'locations' => $formattedLocations
        );

        $apiURL = 'http://localhost:8080/api/projects/' . $id;


        $response = callAPI('PUT', $apiURL, $requestForm);


        if (isset($response['error']) && $response['error']) {
            echo "Error: " . $response['message'];
        } else {
            redirect('Dashboard/index');
        }
    }

    private function formatLocations($locations)
    {
        $formattedLocations = array();
        if (!empty($locations)) {
            foreach ($locations as $locationId) {
                $formattedLocations[] = array('id' => $locationId);
            }
        }
        return $formattedLocations;
    }
}
