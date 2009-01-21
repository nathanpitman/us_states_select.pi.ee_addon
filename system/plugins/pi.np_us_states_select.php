<?php

$plugin_info = array(
	'pi_name'			=> 'US States Select',
	'pi_version'		=> '1.0',
	'pi_author'			=> 'Nathan Pitman',
	'pi_author_url'		=> 'http://www.nathanpitman.com/',
	'pi_description'	=> 'Displays a drop down select of US States',
	'pi_usage'			=> np_us_states_select::usage()
);

class np_us_states_select {

	var $name 		= "";
	var $selected 	= "";
	var $style		= "";
	
	function np_us_states_select()
	{
		global $TMPL;
		
		$usstates = array("Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","North Carolina","North Dakota","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming");

		// Get target from template
		
		$name = $TMPL->fetch_param('name');
		$all = $TMPL->fetch_param('all');
		$selected = $TMPL->fetch_param('selected');
		$style = $TMPL->fetch_param('style');
        
		if ($name != "") {
			
			if ($style != "") {
				$style_string = " style='".$style."'";
			} else {
				$style_string = "";
			}
			
			$string = "<select class='select' name='".$name."'".$style_string.">";
			if ($all == "true") {
				$string .= "<option value=''>All</option>";
			}
			foreach ($usstates as $value) {
				if ($value == $selected) {
					$sel_string = " selected='selected'";
				} else {
					$sel_string = "";
				}
				$string .= "<option value='".$value."'".$sel_string.">".$value."</option>";
			}
			$string .= "</select>";
			$this->return_data = $string;
		} else {
			$this->return_data = "Error: The name parameter is required!";
			return;
		}	
	}
	

// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>
This plug-in is designed to return a drop down select of US states. You must specify a 'name' for the select element.

BASIC USAGE:

{exp:np_us_states_select name="myname" all="true" selected="New York" style="font-size: 12px;"}

PARAMETERS:

name = 'myname' (no default - must be specified)
 - The name you want to apply to the select element
 
all = 'true' (default - false)
 - Specify a parameter of 'all="true"' if you want to include an 'all' option at the top of the select
 
selected = 'New York' (no default)
 - Specify the value of the County you want to be pre-selected in the select

style = 'font-size: 12px;' (no default)
 - Specify an inline CSS style for the select element
	
RELEASE NOTES:

1.0 - Initial Release.

For updates and support check the developers website: http://nathanpitman.com/journal/


<?php
$buffer = ob_get_contents();
	
ob_end_clean(); 

return $buffer;
}


}
?>