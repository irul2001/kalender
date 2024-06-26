<?php
class Calendar extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Schedule_model');
        $this->load->helper(array('form', 'url')); // Memuat helper form dan url
        $this->load->library('form_validation'); // Memuat library form validation
    }

    public function index($month = NULL, $year = NULL) {
        if ($month === NULL) {
            $month = date('m');
        }
        if ($year === NULL) {
            $year = date('Y');
        }

        $data['schedules'] = $this->Schedule_model->get_schedules($month, $year);
        $data['month'] = $month;
        $data['year'] = $year;

        $this->load->view('templates/header');
        $this->load->view('calendar/index', $data);
        $this->load->view('templates/footer');
    }


    public function add() {
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('event', 'Event', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('calendar/add');
            $this->load->view('templates/footer');
        } else {
            $this->Schedule_model->add_schedule(array(
                'date' => $this->input->post('date'),
                'event' => $this->input->post('event'),
                'description' => $this->input->post('description')
            ));
            redirect('calendar');
        }
    }

    public function edit($id) {
        $data['schedule'] = $this->Schedule_model->get_schedule($id);

        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('event', 'Event', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('calendar/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Schedule_model->update_schedule($id, array(
                'date' => $this->input->post('date'),
                'event' => $this->input->post('event'),
                'description' => $this->input->post('description')
            ));
            redirect('calendar');
        }
    }

    public function delete($id) {
        $this->Schedule_model->delete_schedule($id);
        redirect('calendar');
    }
}
