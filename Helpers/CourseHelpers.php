<?php

class CourseHelpers {

    private $conn;
    private $course;
    public function __construct()
    {
        $conn = (new Connection())->connect();
        $this->course = new CourseController($conn);
    }


    public function checkToAddCourse(){
        // TO DO 
        
    }
}
