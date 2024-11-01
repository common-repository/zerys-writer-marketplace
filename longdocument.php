<?php
$url = plugins_url();
$red=get_site_url();
session_start();

		global $wpdb;
		$query="select apikay from zerys";	
		$key=$wpdb->get_results($query);
		$menu_url =  'http://64.34.208.101/Json/GetMenu/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'];		
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
		}
		$size=5;
		//$onetimeUrl='http://64.34.208.101/Json/GetOrders/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'].'/'.$p.'/'.$size;
		$longdoc='http://64.34.208.101/Json/GetProjects/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'].'/1/0';
		$longdoc_content = curl_init($longdoc);
		curl_setopt($longdoc_content, CURLOPT_RETURNTRANSFER, true);
		$longdoc_result = curl_exec($longdoc_content);
		curl_close($longdoc_content);
		$longdoc_content = str_replace(array("\n","\r"),"",$longdoc_result);
    	$longdoc_content = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$longdoc_result);
    	$arr_longdoc=json_decode($longdoc_content,false);

?>
<script type="text/javascript">
function logout()
{
   document.location.href="admin.php?page=wp-zerys";
}
</script>

<link href="<?php echo $url;?>/zerys-writer-marketplace/css/master.css" rel="stylesheet" type="text/css" />
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
                    <li><span><?php echo $_SESSION['cname'];?></span></li>
				
                       <li><?php if($_SESSION['cname']!='') {?><a href="#" onclick="logout();" class="logoutLink">Logout</a><?php }else {?>
					<a href="#" onclick="logout();" class="logoutLink">Login</a>
					<?php }?>
					</li>
				
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <!-- HEADER TOP -->
        
        <!-- HEADER NAVIGATION -->
		<div class="headerNav">
        	<ul>
            	<li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_projects.png" width="200" height="34" /></a>
                    <ul>
					<?php for($i=0;$i<count($arr->MenuItems[0]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[0]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[0]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[0]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_funds.png" width="200" height="34" /></a>
                	<ul>
                    		<?php for($i=0;$i<count($arr->MenuItems[1]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[1]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[1]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[1]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_writers.png" width="200" height="34" /></a>
                	<ul>
                    	<?php for($i=0;$i<count($arr->MenuItems[2]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[2]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[2]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[2]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_account.png" width="200" height="34" /></a>
                    <ul>
                    <?php for($i=0;$i<count($arr->MenuItems[3]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[3]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[3]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[3]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_support.png" width="200" height="34" /></a>
                    <ul>
                    	<?php for($i=0;$i<count($arr->MenuItems[4]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[4]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[4]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[4]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
            </ul> 
            <div class="clear"></div>
        </div>
		
		
        <?php /*?><div class="headerNav">
        	<ul>
            	<li><a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_projects.png" width="200" height="34" /></a></li>
                <li><a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_funds.png" width="200" height="34" /></a></li>
                <li><a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_writers.png" width="200" height="34" /></a></li>
                <li><a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_account.png" width="200" height="34" /></a></li>
                <li><a href="#"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/my_support.png" width="200" height="34" /></a></li>
            </ul> 
            <div class="clear"></div>
        </div><?php */?>
        <!-- /HEADER NAVIGATION -->
    </div>
    <!-- /HEADER -->
	
    <!-- MIDDLE SECTION -->
    <div id="middleSection">
    	<h1 class="hPaddingTop">Long Document Orders</h1>
        <!-- ORDER -->
        <div class="tableEntry">
        	<!-- TABLE -->
			
        	<table border="0" cellpadding="0" cellspacing="0" class="borderCall">
            	<tr class="trBackgroundColor">
                	<td width="85px">Document Name</td>
                    <td width="85px">On Job <br /> Board</td>
                    <td width="85px">Direct <br /> Assigned</td> 
                    <td width="85px">In progress</td>
                    <td width="85px">Pendeing Revision</td>
                    <td width="85px">ready for Revision</td>
                    <td width="85px">Rejected</td>
                    <td width="85px">Cancelled</td>
                    <td width="85px">Export <a href="#" title="Help"><img src="<?php echo $url;?>/zerys-writer-marketplace/images/helpme_icon.png" width="16" height="16" /></a> <br /> New/Total</td>
                </tr>
				<?php for($i=0;$i<count($arr_longdoc->Orderlist);$i++) {?>
                <tr>
				
	                <td width="85px"><?php echo $arr_longdoc->Orderlist[$i]->Name;?></td>
					
                    <td width="85px"><?php if($arr_longdoc->Orderlist[$i]->JobBoard!=0){?>
					<a href="<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->JobBoardLink;?>" ><?php echo $arr_longdoc->Orderlist[$i]->JobBoard;?></a><?php }else{?>
					<?php echo $arr_longdoc->Orderlist[$i]->JobBoard;?>
					<?php }?>
					</td>
					
                    <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->DirectAssignment!=0){?>
					<a href="<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->DirectAssignmentLink;?>" ><?php echo $arr_longdoc->Orderlist[$i]->DirectAssignment;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->DirectAssignment; } ?>
					</td>
					
					  <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->InProgress!=0){?>
					<a href="<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->InProgressLink;?>" ><?php echo $arr_longdoc->Orderlist[$i]->InProgress;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->InProgress; } ?>
					</td>
                  
				   <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->PendingRevision!=0){?>
					<a href="<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->PendingRevisionLink;?>" ><?php echo $arr_longdoc->Orderlist[$i]->PendingRevision;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->PendingRevision; } ?>
					</td>
				  
				   <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->PendingRevision!=0){?>
					<a href="<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->PendingRevisionLink;?>" ><?php echo $arr_longdoc->Orderlist[$i]->PendingRevision;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->PendingRevision; } ?>
					</td>
					
					
					   <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->Rejected!=0){?>
					<a href="<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->RejectedLink;?>" ><?php echo $arr_longdoc->Orderlist[$i]->Rejected;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->Rejected; } ?>
					</td>
             
                  
                    <td width="85px">
					<?php if($arr_longdoc->Orderlist[$i]->Cancelled!=0){?>
					<a href="<?php echo $arr_longdoc->Baseurl.$arr_longdoc->Orderlist[$i]->CancelledLink;?>" ><?php echo $arr_longdoc->Orderlist[$i]->Cancelled;?></a>
					<?php }else{ echo $arr_longdoc->Orderlist[$i]->Cancelled; } ?>
					</td>
					
					
                    <td width="85px"><a href="#"><?php echo $arr_longdoc->Orderlist[$i]->Totalexport;?></a></td>
                </tr>
				<?php } ?>
                 
            </table>
            <!-- /TABLE -->
			

        </div>
        <!-- /ORDER -->
    </div>
    <!-- /MIDDLE SECTION -->
    
    <!-- FOOTER -->
    <div align="center" id="footer">
    	<a href="#">Privacy Policy</a> <span class="seprator">|</span>
        <a href="#">Terms of Service</a>
    </div>
    <!-- /FOOTER -->
</div>
<!-- /WRAPPER -->
