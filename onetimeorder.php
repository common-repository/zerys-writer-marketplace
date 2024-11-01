<?php
session_id('helsys');

session_start();

if(($_REQUEST['action']=='logout') or ($_SESSION['cname']==''))
{
include('login-file.php');
}
else
{


global $wpdb;
include('zeyers-config.php');


$query="select apikay from zerys";	
$key=$wpdb->get_results($query);
$longstr='';
$ongoingstr='';
$logarch_list='';
$my_list='';



if($_POST['my_archlist']!='')
{

for($i=0;$i<count($_POST['my_archlist']);$i++)
	{
			
		if($i==count($_POST['my_archlist'])-1)
		{
		$my_list.=$_POST['my_archlist'][$i];
		}
		else
		{
		$my_list.=$_POST['my_archlist'][$i].',';
		}
	}


$url =$basePath."Json/UpdateProjectStatus/".$key[0]->apikay."/".$_SESSION['cidd'];


$myarchlist = '{       
   "Flag":"'.$_POST['myarch'].'",
   "ProjectIDDs":"'.$my_list.'"
        }';

$headers = array(
'Accept: application/json',
'Content-Type: application/json',
);

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
curl_setopt($ch,CURLOPT_POSTFIELDS,$myarchlist);
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$going_result = str_replace(array("\n","\r"),"",$result);
    	$going_result = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
    	$going_result=json_decode($going_result,false);
}




if($_POST['longdoc_archlist']!='')
{

for($i=0;$i<count($_POST['longdoc_archlist']);$i++)
	{
			
		if($i==count($_POST['longdoc_archlist'])-1)
		{
		$logarch_list.=$_POST['longdoc_archlist'][$i];
		}
		else
		{
		$logarch_list.=$_POST['longdoc_archlist'][$i].',';
		}
	}


$url =$basePath."Json/UpdateProjectStatus/".$key[0]->apikay."/".$_SESSION['cidd'];



$longarchlist = '{       
   "Flag":"'.$_POST['longdocarch'].'",
   "ProjectIDDs":"'.$logarch_list.'"
        }';



$headers = array(
'Accept: application/json',
'Content-Type: application/json',
);
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
curl_setopt($ch,CURLOPT_POSTFIELDS,$longarchlist);
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$back_longdoc = str_replace(array("\n","\r"),"",$result);
    	$back_longdoc = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
    	$back_longdoc=json_decode($back_longdoc,false);
		

}









if($_POST['longdoclist']!='')
{
	//$str='';
	//echo count($_POST['longdoclist']);
for($i=0;$i<count($_POST['longdoclist']);$i++)
	{
			
		if($i==count($_POST['longdoclist'])-1)
		{
		$longstr.=$_POST['longdoclist'][$i];
		}
		else
		{
		$longstr.=$_POST['longdoclist'][$i].',';
		}
	}


$url =$basePath."Json/UpdateProjectStatus/".$key[0]->apikay."/".$_SESSION['cidd'];


$data = '{       
   "Flag":"'.$_POST['longdoc'].'",
   "ProjectIDDs":"'.$longstr.'"
        }';


$headers = array(
'Accept: application/json',
'Content-Type: application/json',
);

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

		$del_content = str_replace(array("\n","\r"),"",$result);
    	$del_content = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
    	$del_project=json_decode($del_content,false);
		
		
}


if($_POST['ongoinglist']!='')
{

for($i=0;$i<count($_POST['ongoinglist']);$i++)
	{
			
		if($i==count($_POST['ongoinglist'])-1)
		{
		$ongoingstr.=$_POST['ongoinglist'][$i];
		}
		else
		{
		$ongoingstr.=$_POST['ongoinglist'][$i].',';
		}
	}



$url =$basePath."Json/UpdateProjectStatus/".$key[0]->apikay."/".$_SESSION['cidd'];
 
$data = '{       
   "Flag":"'.$_POST['ongoingOptions'].'",
   "ProjectIDDs":"'.$ongoingstr.'"
        }';

$headers = array(
'Accept: application/json',
'Content-Type: application/json',
);

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
        $list_result = str_replace(array("\n","\r"),"",$result);
    	$list_result = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
    	$list_result=json_decode($list_result,false);
	
}

$url = plugins_url();
$red=get_site_url();



		
		$menu_url =  $basePath.'Json/GetMenu/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'];		
		$ch = curl_init($menu_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$json = str_replace(array("\n","\r"),"",$result);
    	$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
    	$arr=json_decode($json,false);
		
		
		
		if($_REQUEST['p']=='')
		{
		$p=1;
		}
		else
		{
		$p=$_REQUEST['p']+1;
		$prev=$_REQUEST['p']-1;
		}
		$size=5;
		$onetimeUrl= $basePath.'Json/GetOrders/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'].'/'.$p.'/'.$size;
		$ontime_content = curl_init($onetimeUrl);
		curl_setopt($ontime_content, CURLOPT_RETURNTRANSFER, true);
		$ontime_result = curl_exec($ontime_content);
		curl_close($ontime_content);
		$ontime_content = str_replace(array("\n","\r"),"",$ontime_result);
    	$ontime_content = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$ontime_result);
    	$arr_ontime=json_decode($ontime_content,false);
		$oneLimit=($arr_ontime->Totalrecords)/5;
		$oneLimit=ceil($oneLimit);
	
		
		//Long Doc Order
		$longdoc= $basePath.'Json/GetProjects/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'].'/1/0';
		$longdoc_content = curl_init($longdoc);
		curl_setopt($longdoc_content, CURLOPT_RETURNTRANSFER, true);
		$longdoc_result = curl_exec($longdoc_content);
		curl_close($longdoc_content);
		$longdoc_content = str_replace(array("\n","\r"),"",$longdoc_result);
    	$longdoc_content = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$longdoc_result);
    	$arr_longdoc=json_decode($longdoc_content,false);
	
		//End
		
		//My Project 
		$project= $basePath.'Json/GetProjects/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'].'/0/0';
		$project_content = curl_init($project);
		curl_setopt($project_content, CURLOPT_RETURNTRANSFER, true);
		$project_result = curl_exec($project_content);
		curl_close($project_content);
		$project_content = str_replace(array("\n","\r"),"",$project_result);
    	$project_content = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$project_result);
    	$arr_project=json_decode($project_content,false);
	
		
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script type="text/javascript">
function logout()
{
   document.logut.submit();
   
}
function opentab(url)
{
newWindow = window.open(url, "_blank");

}
function setdisplay(id)
{
	document.getElementById('myarc_long').style.display='none';
	document.getElementById('myarchgoing').style.display='none';
	if(id == "ontime")
	{
	$('#tabontime').removeClass('left').addClass('active');
	$('#tablongdoc').removeClass('active').addClass('left');
	$('#tabmyproject').removeClass('active').addClass('left');
	
	document.getElementById('longdoc').style.display='none';
	document.getElementById('myproject').style.display='none';
	document.getElementById(id).style.display='block';
	}
	if(id == "myproject")
	{
	$('#tabmyproject').addClass('active');
	$('#tabontime').removeClass('active');
	$('#tablongdoc').removeClass('active').addClass('left');
	document.getElementById('longdoc').style.display='none';
	document.getElementById('ontime').style.display='none';
	document.getElementById(id).style.display='block';
	}
	if(id == "longdoc")
	{
	$('#tablongdoc').addClass('active');
	$('#tabontime').removeClass('active');
	$('#tabmyproject').removeClass('active').addClass('left');
	document.getElementById('ontime').style.display='none';
	document.getElementById('myproject').style.display='none';
	document.getElementById(id).style.display='block';
	}
}
</script>
<div style="display:none">
<?php
include('pass.php');
?>
</div>
<link href="<?php echo $url;?>/zerys-writer-marketplace/css/master.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?php echo $url;?>/zerys-writer-marketplace/js/common.js"></script>
<script language="javascript" src="<?php echo $url;?>/zerys-writer-marketplace/js/modal.popup.js"></script>
<script language="javascript">

    $(document).ready(function() {
            
		//Change these values to style your modal popup
		var align = 'center';									//Valid values; left, right, center
		var top = 100; 											//Use an integer (in pixels)
		var width = 500; 										//Use an integer (in pixels)
		var padding = 10;										//Use an integer (in pixels)
		var backgroundColor = '#FFFFFF'; 						//Use any hex code
		var source = '<?php echo $url;?>/zerys-writer-marketplace/pass.php'; 								//Refer to any page on your server, external pages are not valid e.g. http://www.google.co.uk
		var borderColor = '#333333'; 							//Use any hex code
		var borderWeight = 4; 									//Use an integer (in pixels)
		var borderRadius = 5; 									//Use an integer (in pixels)
		var fadeOutTime = 300; 									//Use any integer, 0 = no fade
		var disableColor = '#666666'; 							//Use any hex code
		var disableOpacity = 40; 								//Valid range 0-100
		var loadingImage = 'lib/release-0.0.1/loading.gif';		//Use relative path from this page
			
		//This method initialises the modal popup
        $(".modal").click(function() {
            modalPopup(align, top, width, padding, disableColor, disableOpacity, backgroundColor, borderColor, borderWeight, borderRadius, fadeOutTime, source, loadingImage);
        });
		  
		
		//This method hides the popup when the escape key is pressed
		$(document).keyup(function(e) {
			if (e.keyCode == 27) {
				closePopup(fadeOutTime);
			}
		});
		
    });
	
</script>

<script language="javascript">

    $(document).ready(function() {
            
		//Change these values to style your modal popup
		var align = 'center';									//Valid values; left, right, center
		var top = 100; 											//Use an integer (in pixels)
		var width = 500; 										//Use an integer (in pixels)
		var padding = 10;										//Use an integer (in pixels)
		var backgroundColor = '#FFFFFF'; 						//Use any hex code
		var source = '<?php echo $url;?>/zerys-writer-marketplace/export.php'; 								//Refer to any page on your server, external pages are not valid e.g. http://www.google.co.uk
		var borderColor = '#333333'; 							//Use any hex code
		var borderWeight = 4; 									//Use an integer (in pixels)
		var borderRadius = 5; 									//Use an integer (in pixels)
		var fadeOutTime = 300; 									//Use any integer, 0 = no fade
		var disableColor = '#666666'; 							//Use any hex code
		var disableOpacity = 40; 								//Valid range 0-100
		var loadingImage = 'lib/release-0.0.1/loading.gif';		//Use relative path from this page
			
		//This method initialises the modal popup
        $(".export").hover(function() {
            modalPopup(align, top, width, padding, disableColor, disableOpacity, backgroundColor, borderColor, borderWeight, borderRadius, fadeOutTime, source, loadingImage);
        });
		  
		
		//This method hides the popup when the escape key is pressed
		$(document).keyup(function(e) {
			if (e.keyCode == 27) {
				closePopup(fadeOutTime);
			}
		});
		
    });
	
</script>

	<!-- FORM CONTAINER -->
	<div id="wrapper">
	<!-- HEADER -->
    <div id="header">
    	<!-- HEADER TOP -->
    	<div>
            <div class="headerLogo">
                <a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/logo.jpg" width="160" height="60" /></a>
            </div>
            <div class="headerRightNav">
                <ul>
					<li>
						 
						<?php if($_SESSION['cname']!='') {?><form name="logut" action="admin.php?page=wp-zerys&action=logout" method="post" >
						<a href="#" onclick="logout();" class="logoutLink">Logout</a></form>
						<?php }else {?>
						<a href="admin.php?page=wp-zerys" class="logoutLink">Login</a>
						<?php }?>
					</li>
					<li><span><?php echo $_SESSION['cname'];?></span></li>
				
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <!-- HEADER TOP -->

        <!-- HEADER NAVIGATION -->
		<div class="headerNav">
		<input type="hidden" id="homeurl" name="homeurl" value="<?php echo $arr->MenuItems[0]->Menu[2]->Url;?>" />
        	<ul>
            	<li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_projects.png" width="200" height="34" /></a>
                    <ul>
					<?php 
					
					for($i=0;$i<count($arr->MenuItems[0]->Menu);$i++) { ?>
                    	<li>
						
						
						<a class="modal" onclick="passlink('<?php echo $arr->MenuItems[0]->Menu[$i]->Url;?>')" href="#" title="<?php echo $arr->MenuItems[0]->Menu[$i]->Name;?>"><?php echo $arr->MenuItems[0]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_funds.png" width="200" height="34" /></a>
                	<ul>
                    		<?php for($i=0;$i<count($arr->MenuItems[1]->Menu);$i++) { ?>
                    	<li><a  class="modal" style="cursor:pointer" onclick="passlink('<?php echo $arr->MenuItems[1]->Menu[$i]->Url;?>')" title="<?php echo $arr->MenuItems[1]->Menu[$i]->Name;?>"><?php echo $arr->MenuItems[1]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_writers.png" width="200" height="34" /></a>
                	<ul>
                    	<?php for($i=0;$i<count($arr->MenuItems[2]->Menu);$i++) { ?>
                    	<li><a class="modal" style="cursor:pointer" onclick="passlink('<?php echo $arr->MenuItems[2]->Menu[$i]->Url;?>')" title="<?php echo $arr->MenuItems[2]->Menu[$i]->Name;?>"><?php echo $arr->MenuItems[2]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_account.png" width="200" height="34" /></a>
                    <ul>
                    <?php for($i=0;$i<count($arr->MenuItems[3]->Menu);$i++) { ?>
                    	<li><a class="modal" style="cursor:pointer" onclick="passlink('<?php echo $arr->MenuItems[3]->Menu[$i]->Url;?>')" title="<?php echo $arr->MenuItems[3]->Menu[$i]->Name;?>"><?php echo $arr->MenuItems[3]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_support.png" width="200" height="34" /></a>
                    <ul>
                    	<?php for($i=0;$i<count($arr->MenuItems[4]->Menu);$i++) { ?>
                    	<li><a class="modal" style="cursor:pointer" onclick="passlink('<?php echo $arr->MenuItems[4]->Menu[$i]->Url;?>')" title="<?php echo $arr->MenuItems[4]->Menu[$i]->Name;?>"><?php echo $arr->MenuItems[4]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
            </ul> 
            <div class="clear"></div>
        </div>
		
		
       
        <!-- /HEADER NAVIGATION -->
    </div>
    <!-- /HEADER -->
	
    <!-- MIDDLE SECTION -->
    <div id="middleSection">
	<?php if($_REQUEST['mode']=='' and $_REQUEST['key']=='') {?>
		<div class="middleNav">
			<ul>
				<li id="tabontime" onclick="setdisplay('ontime');" class="active"><a href="#" title="View On Time Orders">View One Time Orders</a> (<?php echo $arr_ontime->Totalrecords;?>)</li>
				<li id="tablongdoc" onclick="setdisplay('longdoc');" class="left"><a href="#" title="View Long Documents">View Long Documents</a> (<?php echo $arr_longdoc->Totalrecords;?>)</li>
				<li id="tabmyproject" onclick="setdisplay('myproject');" class="left"><a href="#" title="View Project">View On-going Projects</a> (<?php echo $arr_project->Totalrecords;?>)</li>
			</ul>
			<div class="clear"></div>
		</div>
    	
        <!-- ORDER -->
		
        <div id="ontime" class="tableEntry">
			<h1 class="hPaddingTop">My One Time Orders</h1>
		
        	<!-- TABLE -->			
        	<table border="0" cellpadding="0" cellspacing="0" class="borderCall">
            	<tr class="trBackgroundColor">
                	<td width="85px">Order &#35;</td>
                    <td width="85px">Date</td>
                    <td width="85px">On  <br /> Job Board</td>
                    <td width="85px">Direct <br /> Assigned</td> 
                    <td width="85px">In Progress</td>
                    <td width="85px">Pending Revision</td>
                    <td width="85px">Ready for Review</td>
                    <td width="85px">Rejected</td>
                    <td width="85px">Cancelled</td>
                    <td width="85px">Export <a href="#" class="export" title="Help"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/helpme_icon.png" width="16" height="16" /></a> <br /> New/Total</td>
                </tr>
				<?php 
				
				for($i=0;$i<count($arr_ontime->Orderlist);$i++) {?>
                <tr>
	                <td width="85px"><?php echo $arr_ontime->Orderlist[$i]->OrderNo;?></td>
                    <td width="85px"><?php echo $arr_ontime->Orderlist[$i]->Date;?></td>
					
				    <td width="85px"><?php if($arr_ontime->Orderlist[$i]->JobBoard > 0){?>
					<a class="modal" onclick="passlink('<?php echo $arr_ontime->Baseurl.$arr_ontime->Orderlist[$i]->JobBoardLink;?>')"  href="#" ><?php echo $arr_ontime->Orderlist[$i]->JobBoard;?></a><?php }else{?>
					<?php echo $arr_ontime->Orderlist[$i]->JobBoard;?>
					<?php }?>
					</td>
					
					<td width="85px"><?php if($arr_ontime->Orderlist[$i]->DirectAssignment > 0){?>
					<a class="modal"  onclick="passlink('<?php echo $arr_ontime->Baseurl.$arr_ontime->Orderlist[$i]->DirectAssignmentLink;?>')" href="#" ><?php echo $arr_ontime->Orderlist[$i]->DirectAssignment;?></a>				 								<?php }else{?>
					<?php echo $arr_ontime->Orderlist[$i]->DirectAssignment;?>
					<?php }?>
					</td>
					 
          
		  			 <td width="85px"><?php if($arr_ontime->Orderlist[$i]->InProgress > 0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_ontime->Baseurl.$arr_ontime->Orderlist[$i]->InProgressLink;?>');" href="#" ><?php echo $arr_ontime->Orderlist[$i]->InProgress;?></a><?php }else{?>
					<?php echo $arr_ontime->Orderlist[$i]->InProgress;?>
					<?php }?>
					</td>
					
					 <td width="85px"><?php if($arr_ontime->Orderlist[$i]->PendingRevision > 0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_ontime->Baseurl.$arr_ontime->Orderlist[$i]->PendingRevisionLink;?>');" href="#" ><?php echo $arr_ontime->Orderlist[$i]->PendingRevision;?></a><?php                     }else{?>
					<?php echo $arr_ontime->Orderlist[$i]->PendingRevision;?>
					<?php }?>
					</td>
      
                    <td width="85px"><?php if($arr_ontime->Orderlist[$i]->PendingRevision > 0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_ontime->Baseurl.$arr_ontime->Orderlist[$i]->PendingRevisionLink;?>');" href="#" ><?php echo $arr_ontime->Orderlist[$i]->PendingRevision;?></a><?php                    }else{?>
					<?php echo $arr_ontime->Orderlist[$i]->PendingRevision;?>
					<?php }?>
					</td>
					
					    <td width="85px"><?php if($arr_ontime->Orderlist[$i]->Rejected > 0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_ontime->Baseurl.$arr_ontime->Orderlist[$i]->RejectedLink;?>');" href="#" ><?php echo $arr_ontime->Orderlist[$i]->Rejected;?></a><?php                    }else{?>
					<?php echo $arr_ontime->Orderlist[$i]->Rejected;?>
					<?php }?>
					</td>
                    
					<td width="85px"><?php if($arr_ontime->Orderlist[$i]->Cancelled > 0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_ontime->Baseurl.$arr_ontime->Orderlist[$i]->CancelledLink;?>');" href="#" ><?php echo $arr_ontime->Orderlist[$i]->Cancelled;?></a><?php                    }else{?>
					<?php echo $arr_ontime->Orderlist[$i]->Cancelled;?>
					<?php }?>
					</td>
					
                    
                    <td width="85px"><a href="#"><?php echo $arr_ontime->Orderlist[$i]->Totalexport;?></a></td>
					
			
					
                </tr>
				<?php } ?>
                 
            </table>
            <!-- /TABLE -->
			<?php if(count($arr_ontime->Orderlist)>0){ ?>
			<?php if($_REQUEST['p']>=1){
			
			?>
			<a  style="float:left;"href="admin.php?page=wp-zerys&p=<?php echo $prev?>&size=5" class="nextOrderLink">Previous order</a>
			<?php } if($_REQUEST['p']<($oneLimit-1))
			{ ?>
            <a href="admin.php?page=wp-zerys&p=<?php echo $p?>&size=5" class="nextOrderLink">Next 5 Order</a>
			<div style="clear:both"></div>
			<?php }}else{
			if($_REQUEST[p]<$oneLimit)
			{
			?>
			<div style="text-align:center;padding-top:10px;color:#ff0000">No One time orders found</div>
			<?php } }?>
        </div>
		
		<div id="longdoc" class="tableEntry" style="display:none;">
        	<!-- TABLE -->
			<h1 class="hPaddingTop">Long document Orders</h1>
        	<table border="0" cellpadding="0" cellspacing="0" class="borderCall">
            	<tr class="trBackgroundColor">
                	<td width="225px">Document Name</td>
                    <td width="70px">On Job <br /> Board</td>
                    <td width="70px">Direct <br /> Assigned</td> 
                    <td width="70px">In progress</td>
                    <td width="70px">Pending Revision</td>
                    <td width="70px">Ready for Revision</td>
                    <td width="40px">Rejected</td>
                    <td width="40px">Cancelled</td>
                    <td width="85px">Export <a class="export" onclick="" href="#" title="Help"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/helpme_icon.png" width="16" height="16" /></a> <br /> New/Total</td>
                </tr>
		
				<form name="deletlongdoc" id="deletlongdoc" action="" method="post">
				<?php for($i=0;$i<count($arr_longdoc->Orderlist);$i++) {?>
                <tr>
				
	                <td width="85px" class="docName" ><?php echo ucfirst($arr_longdoc->Orderlist[$i]->Name);?></td>
					
                    <td width="85px"><?php if($arr_longdoc->Orderlist[$i]->JobBoard!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->JobBoardLink;?>');"  href="#" ><?php echo $arr_longdoc->Orderlist[$i]->JobBoard;?></a><?php }else{?>
					<?php echo $arr_longdoc->Orderlist[$i]->JobBoard;?>
					<?php }?>
					</td>
					
                    <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->DirectAssignment!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->DirectAssignmentLink;?>');" href="#" ><?php echo $arr_longdoc->Orderlist[$i]->DirectAssignment;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->DirectAssignment; } ?>
					</td>
					
					  <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->InProgress!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->InProgressLink;?>');" href="#" ><?php echo $arr_longdoc->Orderlist[$i]->InProgress;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->InProgress; } ?>
					</td>
                  
				   <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->PendingRevision!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->PendingRevisionLink;?>');"  href="#" ><?php echo $arr_longdoc->Orderlist[$i]->PendingRevision;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->PendingRevision; } ?>
					</td>
				  
				   <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->PendingRevision!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->PendingRevisionLink;?>');" href="#" ><?php echo $arr_longdoc->Orderlist[$i]->PendingRevision;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->PendingRevision; } ?>
					</td>
					
					
					   <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->Rejected!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->RejectedLink;?>');" href="#" ><?php echo $arr_longdoc->Orderlist[$i]->Rejected;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->Rejected; } ?>
					</td>
             
                  
                    <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->Cancelled!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->CancelledLink;?>')"  href="#" ><?php echo $arr_longdoc->Orderlist[$i]->Cancelled;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->Cancelled; } ?>
					</td>
					
					
                    <td width="85px"><a href="#"><?php echo $arr_longdoc->Orderlist[$i]->Totalexport;?></a></td>
					 <!-- <td width="85px"><?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->OrderLink;?>">order
					 
					  </td>-->
					  
					<td width="85px"><input type="checkbox" name="longdoclist[]" id="longdoclist<?php echo $i;?>"  value="<?php echo $arr_longdoc->Orderlist[$i]->Projectidd;?>"  /></td>
                </tr>
				<?php } ?>
				<input type="hidden" value="<?php echo count($arr_longdoc->Orderlist)?>" id="longdocCount" />
                
            </table>
			 <?php
				 if(!count($arr_longdoc->Orderlist)>0)
				 {?>
				<div style="text-align:center;padding-top:10px;color:#ff0000">No long document orders found</div>
				 <?php }
				 ?>
            <div>
			<?php if(count($arr_longdoc->Orderlist)>0) {?>
            	<input id="btndoc_open" type="button" onClick="openarch('longdoc');" value="Show Archived Project" class="project_btn"  />
    			
				<?php }?><input id="btndoc_close" style="display:none;" type="button" onClick="closearch('myarc_long','btndoc_close','btndoc_open');" value="Hide Archived Project" class="project_btn"  />
				<?php if(count($arr_longdoc->Orderlist)>0) {?>
                <select  onchange="longdocform();" class="tableSelectBox" name="longdoc" id="orderOptions">
                    <option >Please Select.. </option>
                    <option class="modalhome"  value="0"><a class="modal" href="#"> Archive </a> </option>
                    <option class="modalhome" value="2"> <a class="modal" href="#">Delete </a></option>
                </select>
				<?php }?>
				</form>
                <div class="clear"></div>
            </div>
            <!-- /TABLE -->
			

        </div>
		<div id="myproject" class="tableEntry tableEntryProject" style="display:none;">
        	<!-- TABLE -->
			
			<h1 class="hPaddingTop">My Projects</h1>
        	<table border="0" cellpadding="0" cellspacing="0" class="borderCall projectTable">
            	<tr class="trBackgroundColor">
                	<td width="270px">Project Name</td>
                    <td width="60px">Keywords <br />/ Topics</td>
                    <td width="60px">Titles</td> 
                    <td width="60px">On Job Board</td>
					<td width="60px">Direct Assigned</td>
					<td width="60px">In Progress</td>
                    <td width="60px">Pending Revision</td>
                    <td width="60px">Ready for Review</td>
                    <td width="40px">Rejected</td>
                    <td width="40px">Cancelled</td>
                    <td width="85px">Export <a href="#" class="export" title="Help"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/helpme_icon.png" width="16" height="16" /></a> <br /> New/Total</td>
                </tr>
				<form name="deletongoing" id="deletongoing" action="" method="post">
				<input type="hidden" value="<?php echo count($arr_project->Orderlist);?>"name="ongoingcount" id="ongoingcount" />
				<?php
				/*echo "<pre>";
				print_r($arr_project->Orderlist);
				echo "</pre>";*/
				 for($i=0;$i<count($arr_project->Orderlist);$i++) {?>
                <tr>
				
	                <td width="270px" class="docName"><?php echo ucfirst($arr_project->Orderlist[$i]->Name);?></td>
					
                    <td width="85px"><?php if($arr_project->Orderlist[$i]->Keywords!=0){?>
					<a class="modal"  onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->KeywordsLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->Keywords;?></a><?php }else{?>
					<?php echo $arr_project->Orderlist[$i]->Keywords;?>
					<?php }?>
					</td>
					
                    <td width="85px">
					<?php if($arr_project->Orderlist[$i]->Titles!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->TitlesLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->Titles;?></a>
					<?php }else{ echo $arr_project->Orderlist[$i]->Titles; } ?>
					</td>
					
					<td width="85px"><?php if($arr_project->Orderlist[$i]->JobBoard!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->JobBoardLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->JobBoard;?></a><?php }else{?>
					<?php echo $arr_project->Orderlist[$i]->JobBoard;?>
					<?php }?>
					</td>
					
					<td width="85px"><?php if($arr_project->Orderlist[$i]->DirectAssignment!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->DirectAssignmentLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->DirectAssignment;?></a><?php }else{?>
					<?php echo $arr_project->Orderlist[$i]->DirectAssignment;?>
					<?php }?>
					</td>
					
					<td width="85px">
					<?php if($arr_project->Orderlist[$i]->InProgress!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->InProgressLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->InProgress;?></a>
					<?php }else{ echo $arr_project->Orderlist[$i]->InProgress; } ?>
					</td>
                  
				   <td width="85px">
					<?php if($arr_project->Orderlist[$i]->PendingRevision!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->PendingRevisionLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->PendingRevision;?></a>
					<?php }else{ echo $arr_project->Orderlist[$i]->PendingRevision; } ?>
					</td>
				  
				  
				   <td width="85px">
					<?php if($arr_project->Orderlist[$i]->ClientReview!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->ClientReviewLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->ClientReview;?></a>
					<?php }else{ echo $arr_project->Orderlist[$i]->ClientReview; } ?>
					</td>
					
					
					 <td width="85px">
					<?php if($arr_project->Orderlist[$i]->Rejected!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->RejectedLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->Rejected;?></a>
					<?php }else{ echo $arr_project->Orderlist[$i]->Rejected; } ?>
					</td>
             
                  
                    <td width="85px">
					<?php if($arr_project->Orderlist[$i]->Cancelled!=0){?>
					<a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->CancelledLink;?>');" href="#" ><?php echo $arr_project->Orderlist[$i]->Cancelled;?></a>
					<?php }else{ echo $arr_project->Orderlist[$i]->Cancelled; } ?>
					</td>
					
					
                    <td width="85px"><a href="#"><?php echo $arr_project->Orderlist[$i]->Totalexport;?></a></td>
					   <td width="85px"><a class="modal" onClick="passlink('<?php echo $arr_project->Baseurl.$arr_project->Orderlist[$i]->OrderLink;?>');" href="#">order </a></td>
					   <!--<td width="85px">   <select style="width:85px;" name="viewprojectOptions" id="viewprojectOptions">
					    <option>Please Select.. </option>
					  <option>Save project as archive </option>
					  <option>delete  this project</option>
					  </select></td>-->
					<td width="85px"><input type="checkbox" name="ongoinglist[]" id="ongoinglist"  value="<?php echo $arr_project->Orderlist[$i]->Projectidd;?>"  /></td>
                </tr>
				<?php } ?>
        
            </table>
            <?php
				 if(!count($arr_project->Orderlist)>0)
				 {?>
				<div style="text-align:center;padding-top:10px;color:#ff0000">No Projects found</div>
				 <?php }
				 ?>
			<div>
			<?php if(count($arr_longdoc->Orderlist)>0) {?>
            	<input id="btnproj_open" type="button" onClick="openarch('myproject');" value="Show Archived Project" class="project_btn"  />
				<?php }?>
				<input style="display:none;" id="btnproj_close" type="button" onClick="closearch('btnproj_close','myarchgoing','btnproj_open');" value="Hide Archived Project" class="project_btn"  />
    
				<?php if(count($arr_longdoc->Orderlist)>=1) {?>
                <select onchange="ongoingform();" class="tableSelectBox" name="ongoingOptions" id="ongoingOptions">
				          <option value="0">Please Select ....... </option>
                 <option class="modalhome" value="0">Archive</option>
                    <option class="modalhome" value="2">Delete</option>
                </select>	
				<?php }?>
				         </form>
                <div class="clear"></div>
            </div>	
            <!-- /TABLE -->
			</div>
			<?php }?>
		<?php 
						
		//My Project Arcihve 
		$arc_project=$basePath.'Json/GetProjects/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'].'/0/1';
		$arc_project_content = curl_init($arc_project);
		curl_setopt($arc_project_content, CURLOPT_RETURNTRANSFER, true);
		$arc_project_result = curl_exec($arc_project_content);
		curl_close($arc_project_content);
		$arc_project_content = str_replace(array("\n","\r"),"",$arc_project_result);
    	$arc_project_content = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$arc_project_result);
    	$archive_project=json_decode($arc_project_content,false);
		?>
			
			<div id="myarchgoing" style="display:none;" class="tableEntry">
        	<!-- TABLE -->
			<h1 class="hPaddingTop">Archived Projects</h1>
        	<table border="0" cellpadding="0" cellspacing="0" class="borderCall">
            	<tr class="trBackgroundColor">
                	<td width="225">Project Name</td>
                    <td width="70">Keywords <br />/ Topics</td>
                    <td width="70">Titles</td> 
                    <td width="70">On Job Board</td>
					<td width="70">Direct Assigned</td>
					<td width="70">In Progress</td>
                    <td width="70">Pending Revision</td>
                    <td width="70">Ready for Review</td>
                    <td width="67">Rejected</td>
                    <td width="68">Cancelled</td>
                    <td width="85">Export <a href="#" title="Help"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/helpme_icon.png" width="16" height="16" /></a> <br /> New/Total</td>
                </tr>
				<form name="myarchform" id="myarchform" action="" method="post" >
				<input type="hidden" value="<?php echo count($archive_project->Orderlist);?>"name="ongoingcountarch" id="ongoingcountarch" />
				<?php for($i=0;$i<count($archive_project->Orderlist);$i++) {?>
                <tr>
				
	                <td width="225" class="docName"><?php echo $archive_project->Orderlist[$i]->Name;?></td>
					
                    <td width="70"><?php if($archive_project->Orderlist[$i]->Keywords!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->KeywordsLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->Keywords;?></a><?php }else{?>
					<?php echo $archive_project->Orderlist[$i]->Keywords;?>
					<?php }?>
					</td>
					
                    <td width="70">
					<?php if($archive_project->Orderlist[$i]->Titles!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->TitlesLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->Titles;?></a>
					<?php }else{ echo $archive_project->Orderlist[$i]->Titles; } ?>
					</td>
					
					<td width="70"><?php if($archive_project->Orderlist[$i]->JobBoard!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->JobBoardLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->JobBoard;?></a><?php }else{?>
					<?php echo $archive_project->Orderlist[$i]->JobBoard;?>
					<?php }?>
					</td>
					
					<td width="70"><?php if($archive_project->Orderlist[$i]->DirectAssignment!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->DirectAssignmentLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->DirectAssignment;?></a><?php }else{?>
					<?php echo $archive_project->Orderlist[$i]->DirectAssignment;?>
					<?php }?>
					</td>
					
					<td width="70">
					<?php if($archive_project->Orderlist[$i]->InProgress!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->InProgressLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->InProgress;?></a>
					<?php }else{ echo $archive_project->Orderlist[$i]->InProgress; } ?>
					</td>
                  
				   <td width="70">
					<?php if($archive_project->Orderlist[$i]->PendingRevision!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->PendingRevisionLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->PendingRevision;?></a>
					<?php }else{ echo $archive_project->Orderlist[$i]->PendingRevision; } ?>
					</td>
				  
				  
				   <td width="70">
					<?php if($archive_project->Orderlist[$i]->ClientReview!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->ClientReviewLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->ClientReview;?></a>
					<?php }else{ echo $archive_project->Orderlist[$i]->ClientReview; } ?>
					</td>
					
					
					 <td width="67">
					<?php if($archive_project->Orderlist[$i]->Rejected!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->RejectedLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->Rejected;?></a>
					<?php }else{ echo $archive_project->Orderlist[$i]->Rejected; } ?>
					</td>
             
                  
                    <td width="68">
					<?php if($archive_project->Orderlist[$i]->Cancelled!=0){?>
					<a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->CancelledLink;?>');" href="#" ><?php echo $archive_project->Orderlist[$i]->Cancelled;?></a>
					<?php }else{ echo $archive_project->Orderlist[$i]->Cancelled; } ?>
					</td>
					
					
                    <td width="85"><a href="#"><?php echo $archive_project->Orderlist[$i]->Totalexport;?></a></td>
					  <!-- <td width="85px"><a onClick="if(confirm('you are about to open a link in new tab. Do you want to proced?'))
opentab('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->OrderLink;?>');
else exit();" href="#">order </a></td>
					   <td width="85px">   <select style="width:85px;" name="viewprojectOptions" id="viewprojectOptions">
					    <option>Please Select.. </option>
					  <option>Save project as archive </option>
					  <option>delete  this project</option>
					  </select></td>-->
					   
		<td width="85px"><a class="modal" onClick="passlink('<?php echo $archive_project->Baseurl.$archive_project->Orderlist[$i]->OrderLink;?>');" href="#">order </a></td>
			<td width="85px"><input type="checkbox" name="my_archlist[]" id="my_archlist"  value="<?php echo $archive_project->Orderlist[$i]->Projectidd;?>"  /></td>

                </tr>
					<?php } ?>
				 </table>
				 
				 <div>
            	
    
                <select onchange="my_arch();" class="tableSelectBox" name="myarch" id="myarch">
				<option>Please Select....</option>
				<option class="modalhome" value="1">Return to Active List</option>
                    <option class="modalhome" value="2">Delete</option>
					
                </select>	
				         </form>
                <div class="clear"></div>
            </div>
				 
				 </div>
			
				
				<?php 
			
						//Long Doc Order
						$longdoc_arch=$basePath.'Json/GetProjects/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'].'/1/1';
						$longdoc_content_arch = curl_init($longdoc_arch);
						curl_setopt($longdoc_content_arch, CURLOPT_RETURNTRANSFER, true);
						$longdoc_result_arch = curl_exec($longdoc_content_arch);
						curl_close($longdoc_content_arch);
						$longdoc_content_arch = str_replace(array("\n","\r"),"",$longdoc_result_arch);
						$longdoc_content_arch = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$longdoc_result_arch);
						$longproject_arch=json_decode($longdoc_content_arch,false);
						
						
		
						?>
				
				
				<div id="myarc_long" style="display:none;" class="tableEntry">
        	<!-- TABLE -->
			<h1 class="hPaddingTop">My Archived Projects</h1>
        	<table border="0" cellpadding="0" cellspacing="0" class="borderCall">
            	<tr class="trBackgroundColor">
                	<td width="225">Project Name</td>
                    <td width="70">Keywords <br />/ Topics</td>
                    <td width="70">Titles</td> 
                    <td width="70">On Job Board</td>
					<td width="70">Direct Assigned</td>
				    <td width="70">In Progress</td>
                    <td width="70">Pending Revision</td>
                    <td width="71">Ready for Review</td>
                    <td width="69">Rejected</td>
                    <td width="65">Cancelled</td>
                    <td width="85">Export <a href="#" title="Help"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/helpme_icon.png" width="16" height="16" /></a> <br /> New/Total</td>
                </tr>
			
				<form name="archorderlist" id="archorderlist" action="" method="post" >
				<input type="hidden" id="archcount" name="archcount" value="<?php echo count($longproject_arch->Orderlist) ?>" />
				<?php 

				for($i=0;$i<count($longproject_arch->Orderlist);$i++) {?>
                <tr>
				
	                <td width="225" class="docName"><?php echo $longproject_arch->Orderlist[$i]->Name;?></td>
					
                    <td width="70"><?php if($longproject_arch->Orderlist[$i]->Keywords!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->KeywordsLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->Keywords;?></a><?php }else{?>
					<?php echo $longproject_arch->Orderlist[$i]->Keywords;?>
					<?php }?>
					</td>
					
                    <td width="70">
					<?php if($longproject_arch->Orderlist[$i]->Titles!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->TitlesLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->Titles;?></a>
					<?php }else{ echo $longproject_arch->Orderlist[$i]->Titles; } ?>
					</td>
					
					<td width="70"><?php if($longproject_arch->Orderlist[$i]->JobBoard!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->JobBoardLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->JobBoard;?></a><?php }else{?>
					<?php echo $longproject_arch->Orderlist[$i]->JobBoard;?>
					<?php }?>
					</td>
					
					<td width="70"><?php if($longproject_arch->Orderlist[$i]->DirectAssignment!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->DirectAssignmentLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->DirectAssignment;?></a><?php }else{?>
					<?php echo $longproject_arch->Orderlist[$i]->DirectAssignment;?>
					<?php }?>
					</td>
					
					<td width="70">
					<?php if($longproject_arch->Orderlist[$i]->InProgress!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->InProgressLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->InProgress;?></a>
					<?php }else{ echo $longproject_arch->Orderlist[$i]->InProgress; } ?>
					</td>
                  
				   <td width="70">
					<?php if($longproject_arch->Orderlist[$i]->PendingRevision!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->PendingRevisionLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->PendingRevision;?></a>
					<?php }else{ echo $longproject_arch->Orderlist[$i]->PendingRevision; } ?>
					</td>
				  
				  
				   <td width="71">
					<?php if($longproject_arch->Orderlist[$i]->ClientReview!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->ClientReviewLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->ClientReview;?></a>
					<?php }else{ echo $longproject_arch->Orderlist[$i]->ClientReview; } ?>
					</td>
					
					
					 <td width="69">
					<?php if($longproject_arch->Orderlist[$i]->Rejected!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->RejectedLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->Rejected;?></a>
					<?php }else{ echo $longproject_arch->Orderlist[$i]->Rejected; } ?>
					</td>
             
                  
                    <td width="65">
					<?php if($longproject_arch->Orderlist[$i]->Cancelled!=0){?>
					<a class="modal" onClick="passlink('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->CancelledLink;?>');" href="#" ><?php echo $longproject_arch->Orderlist[$i]->Cancelled;?></a>
					<?php }else{ echo $longproject_arch->Orderlist[$i]->Cancelled; } ?>
					</td>
					
					
                    <td width="85"><a href="#"><?php echo $longproject_arch->Orderlist[$i]->Totalexport;?></a></td>
					
				<td width="85px"><input type="checkbox" name="longdoc_archlist[]" id="longdoc_archlist"  value="<?php echo $longproject_arch->Orderlist[$i]->Projectidd;?>"  /></td>
					  <!-- <td width="85px"><a onClick="if(confirm('you are about to open a link in new tab. Do you want to proced?'))
opentab('<?php echo $longproject_arch->Baseurl.$longproject_arch->Orderlist[$i]->OrderLink;?>');
else exit();" href="#">order </a></td>
					   -->
					   
                </tr>
			<?php }?>
                 
            </table>
		
		
				<div>
            	
    
                <select onchange="longdoc_arch();" class="tableSelectBox" name="longdocarch" id="longdocarch">
				<option>Please Select....</option>
				<option class="modalhome" value="1">Return to Active List</option>
                <option class="modalhome" value="2">Delete</option>	
                </select>	
				         </form>
                <div class="clear"></div>
            </div>
		
		
            <!-- /TABLE -->
			</div>
				
				
                 
           
			
            <!-- /TABLE -->
			
						
	

     
        <!-- /ORDER -->
    </div>
    <!-- /MIDDLE SECTION -->
    
    <!-- FOOTER -->
    <div align="center" id="footelinks">
    	<a style="cursor:pointer;" class="modal" onClick="passlink('http://www.interactmedia.com/privacy-policy/')">Privacy Policy</a> <span class="seprator">|</span>
        <a style="cursor:pointer;" class="modal" onClick="passlink('http://www.interactmedia.com/terms-of-use/')">Terms of Service</a>
    </div>
    <!-- /FOOTER -->
</div>
<!-- /WRAPPER -->
<?php }
if($del_project->Message=='Success' || (!empty($back_longdoc->Message))) {
?>
		<script>
	document.getElementById('myproject').style.display='none';
	document.getElementById('ontime').style.display='none';
	document.getElementById('longdoc').style.display='block';
		</script>
		
	<?php	}
	if(!empty($going_result->Message) || !empty($list_result->Message)) { ?>
	<script>
		document.getElementById('longdoc').style.display='none';
	document.getElementById('ontime').style.display='none';
	document.getElementById('myproject').style.display='block';
	</script>
	<?php } ?>