<?
include("HawkEye_function_file.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;
	charset=utf-8" />
<title>HawkEye</title>
<script src="js/hawkeye_search.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!--<script src="js/jquery_v1.8.js" type="text/javascript"></script>-->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--<link href="js/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">-->
<link 	rel = "stylesheet"
		type = "text/css"
		href = "HawkEyeFormat.css">
</head>
<body>
          <!-- sample modal content -->
          <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 id="myModalLabel">Modal Heading</h3>
            </div>
            <div class="modal-body">
              <h4>Text in a modal</h4>
              <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem.</p>

              <h4>Popover in a modal</h4>
              <p>This <a href="#" role="button" class="btn popover-test" title="A Title" data-content="And here's some amazing content. It's very engaging. right?">button</a> should trigger a popover on hover.</p>

              <h4>Tooltips in a modal</h4>
              <p><a href="#" class="tooltip-test" title="Tooltip">This link</a> and <a href="#" class="tooltip-test" title="Tooltip">that link</a> should have tooltips on hover.</p>

              <hr>

              <h4>Overflowing text to show optional scrollbar</h4>
              <p>We set a fixed <code>max-height</code> on the <code>.modal-body</code>. Watch it overflow with all this extra lorem ipsum text we've included.</p>
              <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
              <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
              <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
              <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            </div>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Close</button>
              <button class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <div class="bs-docs-example" style="padding-bottom: 24px;">
            <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-large">Launch demo modal</a>
          </div>
		</div>
<div id="body" style="width:980px;margin: 0px auto 0px auto; text-align: left">
<?
build_page();
$name='';
$email='';
$phone='';
$referred='';
$name=$_REQUEST['firstname'];
$mail=$_REQUEST['mail'];
$phone=$_REQUEST['phone'];
$referred=$_REQUEST['referred'];
print $mail;
if($mail){

	/* for inhosting */
/*
$dbname = 'abaits5_HawkeyeTest';
$dbTable='AptSearch6';
$conn=mysql_connect("localhost","abaits5_mcbottum","annakai1") or die(mysql_error());	
mysql_select_db($dbname);
*/

/* for home */

$dbname = 'HawkeyeTest';
$dbTable='inquiry';
$conn=mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db($dbname, $conn);

$sql="INSERT INTO $dbTable (name, email, phone, comments)
VALUES
('$name','$mail','$phone','$referred')";

if (mysql_query($sql,$conn)){
echo "You have been added to our mailing list.";
}
mysql_close($conn);

}
?>
			

		<fieldset id="mainpage">
		<br/>
		<table width="100%" class="form">
		<tr><td colspan="100%"><div id = "greyline""></div></td></tr>
		<tr align="center" ><td colspan="4">
		<strong>Welcome to Swoop Search!</strong></td></tr>
		<tr><td colspan="4"> Swoop Search will launch a beta version of its proprietary search technology targeting campus housing. An aggregated database has been created to integrate all Madison area property listings. Swoop’s revolutionary search interface will enable a more efficient and transparent search experience for UW-Madison students and residents.</td>
		<td>
		<fieldset>
				<form 	
				name="form"
				onsubmit='return formValidator2()'
				action = "index2.php"
				method = "post">	
				<table>
				<tr><td align="center">
				<label>Enter Personal Data to Receive Swoop Press Release</label>
				</td></tr>
				<tr><td>
				<label>Name*</label>
				</td></tr>
				<tr><td>
				<input type = "text" size = "55" name="firstname"
						id = "firstname"/>
				</td></tr>
				<tr><td>
				<label>Email*</label>
				</td></tr>
				<tr><td>
				<input type = "text" size = "55" name = "mail"
						id = "mail"/>
				</td></tr>
				<tr><td>
				<label>Phone</label>
				</td></tr>
				<tr><td>
				<input type = "text" size = "55"
						name = "phone"/>
				</td></tr>
				<br>
				<tr><td>
				<select name = "referred" width = "55">
					<option value="">Referred By</option>
					<option value="Friend">Friend</option>
					<option value="Internet_Search">Internet Search</option>
					<option value="Realitor">Realitor</option>
					<option value="UW_Housing">UW Housing</option>
					<option value="Other">Other</option>
				</select>
				</td></tr>
				<tr><td align="center">
				<div id = "submit">
						<input 	type = "submit"
						name = "submit"
						value = "Submit Personal Data"/>
				</div>
				</td></tr>
				</table>
				</form>
		</fieldset>
		</td>
		</tr>
		<tr><td><br></td></tr>
		</table>
		<table id="lower" width="100%">
		<tr>
		<td><a href="mailto:quinn@swoopsrch.com?Subject=Job%20Opportunities">Questions? Contact </a></td>
		<td> Call 651.269.4424 </td>
		<td><a href="SoftwareEngineerPosting.pdf">Job Opportunities</a></td>
		<td>
<input type = "password" size = "10"
		id = "password"/>
		</td></tr>
		</table>
		<form 	
				name="form"
				onsubmit='return formValidator()'
				action = "index1.php"
				method = "post">
		<table id="footer" width="100%">
		<tr><td>
			<p><div id = "greyline""></div></p>
		</td></tr>
		<tr><td align="center">
		<div id = "submit">
				<input 	type = "submit"
						name = "submit"
						value = "Hawkeye Search"/>
		</div>
		</td></tr>
	</table>
	</form>	
	


	</fieldset>
	
	</div>
	

<?build_footer()?>
</body>
</html>