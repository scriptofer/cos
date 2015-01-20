<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2014-08-25 02:17:16 --> Query error: Unknown column 'undefined' in 'where clause' - SELECT collegeName, en_college.collegeID, en_course.courseCode, seattype, courseName, meritno, percentage, category FROM en_cutoff inner join en_college on en_cutoff.collegeID = en_college.collegeID inner join en_course on en_cutoff.courseCode = en_course.courseCode WHERE seattype = '' and percentage <= 74 and percentage >= 64 and collegeDist = undefined and en_cutoff.subGroup = 'undefined'
ERROR - 2014-08-25 18:39:08 --> New user added - 9763722077|atul kokate|abc@gmail.com
ERROR - 2014-08-25 18:39:38 --> 9763722077|atul kokate|abc@gmail.com|60|Pune|GOPEN|Computer Engineering|Direct Second Year
