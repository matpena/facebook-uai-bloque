<?php
$allowHTML = get_config('test', 'Allow_HTML');



class block_test extends block_list {
    
    public function init() {
        $this->title = get_string('UAI', 'block_test');
    }
    // The PHP tag and the curly bracket for the class definition 
    // will only be closed after there is another function added in the next section.
   public function get_content() {
  if ($this->content !== null) {
    return $this->content;
  }
 global $DB, $USER, $CFG, $PAGE, $COURSE; 
 $idCurso = $COURSE->id; //id del curso actual 
 $idProf = $USER->id; // id del usuario
  $this->content         = new stdClass;
  $this->content->items  = array();
  $this->content->icons  = array();
  //$this->content->footer = 'Footer here...';
/*             $results5 = $DB->get_records_sql("SELECT 
	c.id, 
	c.shortname, 
	u.id, 
	u.username, 
	CONCAT(u.firstname, ' ', u.lastname) AS name 
FROM 
	{mdl_course c} 
	{LEFT OUTER JOIN mdl_context cx ON c.id = cx.instanceid }
	{LEFT OUTER JOIN mdl_role_assignments ra ON cx.id = ra.contextid} 
	{AND ra.roleid = '3' }
	{LEFT OUTER JOIN mdl_user u ON ra.userid = u.id }
WHERE 
	cx.contextlevel = '50' 
	AND c.id = :idCurso
        AND u.id =:idProf", array('idCurso' => $idCurso, 'idProf' => $idProf)); */
            
            $context = context_course::instance($COURSE->id);
            if(has_capability('mod/assignment:addinstance', $context)) {
            	// I have a teacher in front of me
            	if ($courseid==1){
            		$this->content->items[0] = html_writer::tag('a', 'Información de la cuenta', array('href' => $CFG->wwwroot.'/local/facebook/connect.php'));
            		$this->content->icons[0] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
            		$this->content->items[1] = html_writer::tag('a', 'Ir a la aplicación', array('href' => 'https://apps.facebook.com/webcursosuai/'));
            		$this->content->icons[1] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
            		$this->content->items[2] = html_writer::tag('a', 'Editar notificaciones', array('href' => 'http://webcursos.uai.cl/message/edit.php'));
            		$this->content->icons[2] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
            	}
            	else {
            		$this->content->items[0] = html_writer::tag('a', 'Información de la cuenta', array('href' => $CFG->wwwroot.'/local/facebook/connect.php'));
            		$this->content->icons[0] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
            		$this->content->items[1] = html_writer::tag('a', 'Ir a la aplicación', array('href' => 'https://apps.facebook.com/webcursosuai/'));
            		$this->content->icons[1] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
            		$this->content->items[2] = html_writer::tag('a', 'Editar notificaciones', array('href' => 'http://webcursos.uai.cl/message/edit.php'));
            		$this->content->icons[2] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
            		$this->content->items[3] = html_writer::tag('a', 'Ver alumnos inscritos', array('href' => $CFG->wwwroot.'/local/facebook/ver.php?id='.$idCurso));
            		$this->content->icons[3] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
            		$this->content->items[4] = html_writer::tag('a', 'Enviar Invitación', array('href' => $CFG->wwwroot.'/local/facebook/revisar.php?id='.$idCurso));
            		$this->content->icons[4] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
            }
            if (mysql_num_rows($results5)==1 ) {

            }
            }
else {
     $this->content->items[0] = html_writer::tag('a', 'Información de la cuenta', array('href' => 'http://localhost:8888/moodle/local/facebook/connect.php'));
  $this->content->icons[0] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
  $this->content->items[1] = html_writer::tag('a', 'Ir a la aplicación', array('href' => 'https://apps.facebook.com/webcursosuai/'));
  $this->content->icons[1] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
  $this->content->items[2] = html_writer::tag('a', 'Editar notificaciones', array('href' => 'http://webcursos.uai.cl/message/edit.php'));
  $this->content->icons[2] = html_writer::empty_tag('img', array('src' => $CFG->wwwroot.'/blocks/test/fa-file.png', 'class' => 'icon'));
    
}
 
  return $this->content;
}
public function specialization() {
    if (isset($this->config)) {
        if (empty($this->config->title)) {
            $this->title = get_string('defaulttitle', 'block_test');            
        } else {
            $this->title = $this->config->title;
        }
 
        if (empty($this->config->text)) {
            $this->config->text = get_string('defaulttext', 'block_test');
        }    
    }
    
}
function has_config() {return true;}

public function instance_config_save($data,$nolongerused =false) {
  if(get_config('simplehtml', 'Allow_HTML') == '1') {
    $data->text = strip_tags($data->text);
  }
 
  // And now forward to the default implementation defined in the parent class
  return parent::instance_config_save($data,$nolongerused);
}

function applicable_formats() {
  // Default case: the block can be used in courses and site index, but not in activities
  return array(
    'all' => true, 
      'local' => true, 
    'mod' => false,
  );
}




}
