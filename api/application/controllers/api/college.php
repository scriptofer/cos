<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class College extends REST_Controller
{
    public function colleges_get()
    {
        // Display all colleges
		$this->load->database();
		$this->response($this->db->get('colleges')->result());
    }

	public function districts_get() {
		// Display all colleges
		$this->load->database();
		$this->db->cache_on();
		$result = $this->db->get('district')->result();
		$this->db->cache_off();
		$this->response($result);
	}

  public function advertise_get() {
    // Display all colleges
    $this->load->database();

    $sql = 'SELECT * FROM advertise';
    $sql = $sql.' WHERE isGeneric=1';

    if( $this->get('district') ) {
      $sql = $sql . ' OR districtID='. $this->get('district');
    }

    //echo $sql;
    $query = $this->db->query( $sql );

    $arr = $query->result();

    $this->response($arr);
  }

  public function universities_get() {
    // Display all colleges
    $this->load->database();
    $this->db->cache_on();
    $result = $this->db->get('university')->result();
    $this->db->cache_off();
    $this->response($result);
  }

	public function singlecollege_get()
    {
	    if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }
        // Display all colleges
		$this->load->database();
		$query = $this->db->query('SELECT id,name,address FROM colleges WHERE id='.$this->get('id'));

		$row = $query->row_array();

		$this->response($row);
    }

    public function college_post()
    {
        // Create a new college
    }
	function deletecollege_post()
    {
        if(!$this->post('id'))
        {
        	$this->response(NULL, 400);
        }
        // Display all colleges
		$this->load->database();

		//$query = $this->db->query('DELETE * FROM colleges WHERE id='.$this->get('id'));
		$this->db->where('id', $this->post('id'));
		$this->db->delete('colleges');
		//$row = $query->row_array();
		$message = array('id' => $this->post('id'), 'message' => 'DELETED!');

		$this->response($message, 200);
    }
	 public function addcollege_post()
    {
		$this->load->database();
		$data = array(
			   'collegeID' =>  $this->post('id'),
               'collegeName' =>  $this->post('name'),
               'collegeDist' =>  $this->post('dist'),
			   'collegeType' =>  $this->post('type')
            );
		$query = $this->db->insert('college', $data);
		$message = array("query"=> $query, "message" => "Added Successfuly");
		$this->response($message, 200);
    }

	public function addcourse_post()
    {
		$this->load->database();
		$data = array(
			   'courseCode' =>  $this->post('code'),
               'courseName' =>  $this->post('name'),
               'intake' =>  $this->post('intake'),
			   'startingyear' =>  $this->post('startingyear'),
			   'collegeID' =>  $this->post('collegeID')
            );
		$query = $this->db->insert('course', $data);
		$message = array("query"=> $query, "message" => "Added Successfuly");
		$this->response($message, 200);
    }

	public function adduser_post()
    {
		$this->load->database();

		if($this->post('userMobile')) {
		$query = $this->db->query('SELECT * FROM cutoffuser where mobile = "'.$this->post('userMobile').'"');


		date_default_timezone_set('Asia/Kolkata');
		$createdTime = date("Y-m-d H:i:s");
		if($query->num_rows() == 0) {
				$data = array(
			   		'mobile' =>  $this->post('userMobile'),
               		'name' =>  $this->post('userName'),
               		'email' =>  $this->post('userEmail'),
               		'ipAdd' => $_SERVER['REMOTE_ADDR'],
               		'isMobile' => $this->post('isMobileDevice'),
               		'createdTime' => $createdTime
            	);
			$query = $this->db->insert('cutoffuser', $data);
		} else {
			$sql = "UPDATE cutoffuser SET loginCnt = loginCnt + 1, createdTime = '$createdTime' WHERE mobile = ".$this->post('userMobile');
		    $query = $this->db->query($sql);
        	$data = $query->result();
		}
		$userAdded = $this->post('userMobile').'|'.$this->post('userName').'|'.$this->post('userEmail');
		log_message('error', 'New user added - '. $userAdded);
		$message = array("query"=> $query, "message" => "Added Successfuly");
		$this->response($message, 200);
		} else {
			$message = array("message" => "Please try again by refresing the page. Please enter valid data. OR contact administrator at info@gitcpl.com", "errorcode" => 404);
			$this->response($message, 200);
		}
    }

	public function addcutoff_post()
    {
		$this->load->database();
		$data = array(
			   'collegeID' =>  $this->post('collegeID'),
			   'courseCode' =>  $this->post('courseID'),
               'seattype' =>  $this->post('seattype'),
               'category' =>  $this->post('category'),
			   'percentage' =>  $this->post('percentage'),
			   'meritno' =>  $this->post('meritno')
            );
		$query = $this->db->insert('cutoff', $data);
		$message = array("query"=> $query, "message" => "Added Successfuly");
		$this->response($message, 200);
    }

	function updatesearchcounter_post() {
		$this->load->database();
		date_default_timezone_set('Asia/Kolkata');
		$createdTime = date("Y-m-d H:i:s");
		$sql = "UPDATE cutoffuser SET searchCnt = searchCnt + 1, createdTime = '$createdTime' WHERE mobile = ".$this->post('mobileNumber');
	    $query = $this->db->query($sql);
	    //echo $sql;
        //$data = $query->result();

        //if($data) {
            $this->response('updated search counter', 200);
        //} else {
        //    $this->response(array('error' => 'No Records Found'), 200);
        //}
	}


	function searchdirectsecondcollege_post()
    {
		$this->load->database();

		$percentageUpper = $this->post('percentage') + 5;
		$percentageLower = $this->post('percentage') - 5;

        $sql = "SELECT collegeName, en_college.collegeID, en_course.courseCode, seattype, courseName, meritno, percentage, category FROM en_cutoff inner join en_college on en_cutoff.collegeID = en_college.collegeID";
        $sql = $sql . " inner join en_course on en_cutoff.courseCode = en_course.courseCode WHERE";

        $seattypesql = "";

        if($this->post('isPhysical')) {
        	$seattypesql= $seattypesql. " seattype like 'PWD%'" ;
        }
		else {
        	$seattypesql = $seattypesql. " seattype = '" .$this->post('seatType')."'";
        }
        $sql = $sql.$seattypesql;
//        $sql = $sql." and percentage <= ".$this->post('percentage');
		$sql = $sql." and percentage <= ".$percentageUpper;
		$sql = $sql." and percentage >= ".$percentageLower;

        $sql = $sql." and collegeDist = ".$this->post('distictid');
		$sql = $sql." and en_cutoff.subGroup = '".$this->post('group')."'";


        if($this->post('courseName')) {
        	$sql = $sql . " and en_course.courseName like '".$this->post('courseName')."%' ";
        }

        //$sql = $sql. " order by percentage desc";
        //echo $sql;
         $query = $this->db->query($sql);
        $data = $query->result();
	//log_message('error', $sql);
	date_default_timezone_set('Asia/Kolkata');
	$log_info = $this->post('userMobile')."|".$this->post('userName')."|".$this->post('userEmail')."|".$this->post('percentage')."|".$this->post('distictName')."|".$this->post('seatType')."|".$this->post('courseName')."|Direct Second Year";
	log_message('error', $log_info);
        if($data) {
            $this->response($data, 200);
            //$this->response(array('upper' => $percentageUpper, 'lower' => $percentageLower, 'error' => 'No Records Found'), 200);

		} else {
            $this->response(array('upper' => $percentageUpper, 'lower' => $percentageLower, 'error' => 'No Records Found'), 200);
        }

    }

    function percentile_post()
    {
      $this->load->database();

      $sql = "SELECT * FROM percentile_2014 where mark <=" . $this->post('score');
      $sql = $sql. " and coursename='" .$this->post('coursename'). "' Limit 0,1";

      $query = $this->db->query($sql);
      $data = $query->result();

      if($data) {
        $this->response($data, 200);
        //$this->response(array('msg' => $sql), 200);
      } else {
        $this->response(array('error' => 'No Records Found'), 200);
      }
    }

    function searchengcollege_post()
    {
      $this->load->database();

      $percentageUpper = $this->post('percentage') + 5;
      $percentageLower = $this->post('percentage') - 5;

      $sql = "SELECT * FROM en_cutoff_2014 inner join en_college_2014 on";
      $sql = $sql . " en_cutoff_2014.collegeID = en_college_2014.collegeID";
      $sql = $sql . " inner join en_course_2014 on en_cutoff_2014.courseCode = en_course_2014.courseCode WHERE";

      $seattypesql = "";

      if($this->post('isPhysical')) {
        $seattypesql= $seattypesql. " seattype like 'PH%".substr($this->post('seatType'), -1)."' " ;
      }
      /*else if($this->post('seatType')[0] === "M" ) {
      $seattypesql= $seattypesql. " seattype like '".substr($this->post('seatType'), 0, 2)."%".substr($this->post('seatType'), -1)."' " ;
    } */
    else if( $this->post('allindia') ) {
      $seattypesql = $seattypesql. " seattype = 'AI'";
    } else {
      $seattypesql = $seattypesql. " seattype = '" .$this->post('seatType')."'";
    }

    $sql = $sql.$seattypesql;
    //$sql = $sql." and percentage <= ".$this->post('percentage');
    if( $this->post('percentage') ) {
      $sql = $sql." and percentage <= ".$percentageUpper;
      $sql = $sql." and percentage >= ".$percentageLower;
    }

    if( $this->post('allindia') ) {
      $sql = $sql." and indiarank <= ". $this->post('allindia');
    }

    if( $this->post('statemerit') ) {
      $sql = $sql." and meritno <= ". $this->post('statemerit');
    }

    if( !$this->post('autonomous') ) {
      $sql = $sql." and collegeUniversity = ".$this->post('universityid');
      $sql = $sql." and isAutonomous = 0";//.$this->post('universityid');
    }

    if( $this->post('autonomous') ) {
      $sql = $sql." and en_college_2014.collegeID = ".$this->post('autonomous');
      $sql = $sql." and isAutonomous = 1";//.$this->post('universityid');
    }

    if($this->post('courseName')) {
      $sql = $sql . " and en_course_2014.courseName like '".$this->post('courseName')."%' ";
    }
    //echo $sql;
    //$sql = $sql. " order by percentage desc";
    //  echo $sql;
    //return;

    $query = $this->db->query($sql);
    $data = $query->result();
    //log_message('error', $sql);
    date_default_timezone_set('Asia/Kolkata');
    $log_info = $this->post('userMobile')."|".$this->post('userName')."|".$this->post('userEmail')."|".$this->post('percentage')."|".$this->post('distictName')."|".$this->post('seatType')."|".$this->post('courseName');
    $log_info = $log_info."|Engineering2014";
    log_message('error', $log_info);
    if($data) {
      $this->response($data, 200);
      //$this->response(array('msg' => $sql), 200);
    } else {
      $this->response(array('error' => 'No Records Found'), 200);
    }

  }

	function searchcollege_post()
    {
		$this->load->database();

		$percentageUpper = $this->post('percentage') + 5;
		$percentageLower = $this->post('percentage') - 5;

        $sql = "SELECT * FROM poly_cutoff_2014 inner join poly_college_2014 on poly_cutoff_2014.collegeID = poly_college_2014.collegeID";
        $sql = $sql . " inner join poly_course_2014 on poly_cutoff_2014.courseCode = poly_course_2014.courseCode WHERE";

        $seattypesql = "";

        if($this->post('isPhysical')) {
        	$seattypesql= $seattypesql. " seattype like 'NPH%".substr($this->post('seatType'), -1)."' " ;
        }
        /*else if($this->post('seatType')[0] === "M" ) {
			$seattypesql= $seattypesql. " seattype like '".substr($this->post('seatType'), 0, 2)."%".substr($this->post('seatType'), -1)."' " ;
		} */
		else {
        	$seattypesql = $seattypesql. " seattype = '" .$this->post('seatType')."'";
        }
        $sql = $sql.$seattypesql;
        //$sql = $sql." and percentage <= ".$this->post('percentage');
		$sql = $sql." and percentage <= ".$percentageUpper;
		$sql = $sql." and percentage >= ".$percentageLower;

		$sql = $sql." and collegeDist = ".$this->post('distictid');

		if($this->post('isTfws')) {
        	$sql = $sql . " and isTfws = 1";
        }

        if($this->post('courseName')) {
        	$sql = $sql . " and poly_course_2014.courseName like '".$this->post('courseName')."%' ";
        }

        //$sql = $sql. " order by percentage desc";
        //echo $sql;
         $query = $this->db->query($sql);
        $data = $query->result();
	//log_message('error', $sql);
	date_default_timezone_set('Asia/Kolkata');
	$log_info = $this->post('userMobile')."|".$this->post('userName')."|".$this->post('userEmail')."|".$this->post('percentage')."|".$this->post('distictName')."|".$this->post('seatType')."|".$this->post('courseName');
  $log_info = $log_info."|Polytechnic2014";
  log_message('error', $log_info);
        if($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'No Records Found'), 200);
        }

    }

//	SELECT DISTINCT SUBSTRING(courseName,1,LOCATE("[", courseName)-2) FROM course
  public function engautonomous_get() {
    $this->load->database();
    $this->db->cache_on();
    $sql = 'SELECT collegeId, collegeName FROM en_college_2014 where isAutonomous=1';
    $query = $this->db->query($sql);
    $this->db->cache_off();
    $data = $query->result();

    if($data) {
      $this->response($data, 200);
    } else {
      $this->response(array('error' => 'No Records Found'), 200);
    }

  }

	public function courses_get() {
		// Display all colleges
		$this->load->database();
		$this->db->cache_on();
		$sql = 'SELECT DISTINCT SUBSTRING(courseName,1,LOCATE("[", courseName)-2) as courseName FROM course order by courseName';
        $query = $this->db->query($sql);
		$this->db->cache_off();
        $data = $query->result();

        if($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'No Records Found'), 200);
        }
	}

	public function encourses_get() {
		// Display all colleges
		$this->load->database();
		$this->db->cache_on();
		$sql = 'SELECT DISTINCT courseName FROM en_course order by courseName';
        $query = $this->db->query($sql);
		$this->db->cache_off();
        $data = $query->result();

        if($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'No Records Found'), 200);
        }
	}

  public function engcourses_get() {
    // Display all colleges
    $this->load->database();
    $this->db->cache_on();
    $sql = 'SELECT DISTINCT courseName FROM en_course_2014 order by courseName';
    $query = $this->db->query($sql);
    $this->db->cache_off();
    $data = $query->result();

    if($data) {
      $this->response($data, 200);
    } else {
      $this->response(array('error' => 'No Records Found'), 200);
    }
  }

	function submitfeedback_post() {
		$this->load->library('email');
		$config['mailtype'] = 'html';

		$this->email->initialize($config);
		$this->email->from('contact@cutoffsearch.com', 'Cutoffsearch');
		$this->email->to('info@gitcpl.com');
		$this->email->cc('vishnutekale13@gmail.com');


		$this->email->subject('Feedback/Contact - '.$this->post('userMobile'));

		$message = "Hello Admin, <br/><br/>Below is the user feedback<br/><br/>";
		$message .= "User Name -: ".$this->post('userName');
		$message .= "<br/><br/>User Address -: ".$this->post('userAddress');
		$message .= "<br/><br/>Feedback -: ".$this->post('feedback');
		$message .= "<br/><br/>Mobile-: ".$this->post('userMobile');
		$this->email->message($message);

		$this->email->send();
		$message = array("message" => "Feedback sent Successfuly");
		$this->response($message, 200);
	}

	function logaddevent_post() {
		date_default_timezone_set('Asia/Kolkata');
		$log_info = "AddTracker" ."|". $this->post('userMobile') ."|".$this->post('userName') ."|". $this->post('userAction') ."|". $this->post('pageName');
		log_message('error', $log_info);
		$message = array("message" => "Feedback sent Successfuly");
		$this->response($message, 200);
	}
}
