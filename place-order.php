<?php
$url = plugins_url();
session_start();

		global $wpdb;
		$query="select apikay from zerys";	
		$key=$wpdb->get_results($query);
		// Curl Request For Get Menu
		$menu_url =  'http://64.34.208.101/Json/GetMenu/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'];		
		$ch = curl_init($menu_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$json = str_replace(array("\n","\r"),"",$result);
    	$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
    	$arr=json_decode($json,false);
		
		//Curl Request For Get Content Type
		
		$contentUrl='http://64.34.208.101/Json/GetContentTypes/'.$key[0]->apikay.'/'.$_SESSION['cidd']; 
		//$menu_url =  'http://64.34.208.101/Json/GetMenu/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/'.$_SESSION['cUserId'];		
		$ch_content = curl_init($contentUrl);
		curl_setopt($ch_content, CURLOPT_RETURNTRANSFER, true);
		$content_result = curl_exec($ch_content);
		curl_close($ch_content);
		$json_content = str_replace(array("\n","\r"),"",$content_result);
    	$json_content = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$content_result);
    	$arr_content=json_decode($json_content,false);
		
		
		$url_cat='http://64.34.208.101/Json/GetDirectories/'.$key[0]->apikay.'/'.$_SESSION['cidd'].'/0';
		$cat_content = curl_init($url_cat);
		curl_setopt($cat_content, CURLOPT_RETURNTRANSFER, true);
		$cat_result = curl_exec($cat_content);
		curl_close($cat_content);
		$json_cat = str_replace(array("\n","\r"),"",$cat_result);
    	$json_cat = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$cat_result);
    	$arr_cat_list=json_decode($json_cat,false);
		
?>
<script type="text/javascript">
function logout()
{
   document.location.href="admin.php?page=wp-zerys";
}
</script>
<link href="<?php echo $url;?>/ZERYS/css/master.css" rel="stylesheet" type="text/css" />
	<!-- FORM CONTAINER -->
	<div id="wrapper">
	<!-- HEADER -->
    <div id="header">
    	<!-- HEADER TOP -->
    	<div>
            <div class="headerLogo">
                <a href="#"><img src="<?php echo $url;?>/ZERYS/images/logo.jpg" width="160" height="60" /></a>
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
                	<a href="#"><img src="<?php echo $url;?>/ZERYS/images/my_projects.png" width="200" height="34" /></a>
                    <ul>
					<?php for($i=0;$i<count($arr->MenuItems[0]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[0]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[0]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[0]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/ZERYS/images/my_funds.png" width="200" height="34" /></a>
                	<ul>
                    		<?php for($i=0;$i<count($arr->MenuItems[1]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[1]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[1]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[1]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/ZERYS/images/my_writers.png" width="200" height="34" /></a>
                	<ul>
                    	<?php for($i=0;$i<count($arr->MenuItems[2]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[2]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[2]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[2]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/ZERYS/images/my_account.png" width="200" height="34" /></a>
                    <ul>
                    <?php for($i=0;$i<count($arr->MenuItems[3]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[3]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[3]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[3]->Menu[$i]->Name;?></a></li>
						<?php } ?>
                    </ul>
                </li>
                <li>
                	<a href="#"><img src="<?php echo $url;?>/ZERYS/images/my_support.png" width="200" height="34" /></a>
                    <ul>
                    	<?php for($i=0;$i<count($arr->MenuItems[4]->Menu);$i++) { ?>
                    	<li><a <?php if($arr->MenuItems[4]->Menu[$i]->IsNewWindow=='1') {?>target="_blank"<?php } ?> href="<?php echo $arr->MenuItems[4]->Menu[$i]->Url;?>" title="Place One Time Order"><?php echo $arr->MenuItems[4]->Menu[$i]->Name;?></a></li>
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
    	<h1>Place a One-Time Content Order</h1>
        <!-- ORDER CONTENT -->
        <div class="orderContent">
        	<!-- LEFT COL -->
        	<div class="leftCol">
            	<!-- BLOCK 1 -->
            	<div class="roundCorner">
                	<!-- TOP-->
                    <div class="top">
                    	<div class="topLeft"></div>
	                    <div class="topRight"></div>
                    </div>
                    <!-- /TOP-->
                    
                    <!-- MIDDLE -->
                    <div class="middle">
                    	<!-- WHITE BLOCK -->
                        <div class="whiteBlock">
                        	<h2>1. Select Order Settings</h2>
                            <form method="post">
	                            <dl class="orderSetting">
                                	<label>
                                    	<dt>Order Type:</dt>
                                        <dd>
                                        	<span>
                                            	<input type="radio" name="group2" checked="checked" class="fLeft" /> <span class="orderTxt fLeft">New Order</span> <span class="clr"></span>
                                            </span>
                                            <span class="padingLT20 fLeft">
                                            	<input type="radio" name="group2" class="fLeft" /> <span class="orderTxt fLeft">Saved Template </span> <span class="clr"></span>                                            </span>
                                            <span class="clear"></span>
                                        </dd>
                                    </label>
                                    <label>
                                    	<dt>Content Type:</dt>
                                        <dd>
                                        	<select class="width180">
											<?php for($i=0;$i<count($arr_content);$i++) {?>
											 <option value="<?php echo $arr_content[$i]->id; ?>"><?php echo $arr_content[$i]->Name;?></option>
											<?php }?>
                                            </select>
                                        </dd>
                                    </label>
                                    <label>
                                    	<dt>Content Category:</dt>
                                        <dd>
                                        	<select class="width180">
											<?php for($i=0;$i<count($arr_cat_list);$i++) {?>
                                            	<option value="<?php echo $arr_cat_list[$i]->id?>"><?php echo $arr_cat_list[$i]->Name?></option>
                                               <?php }?>
                                            </select>
                                        </dd>
                                    </label>
                                    <label>
                                    	<dt>Word Count Range: <a href="#"><img src="<?php echo $url;?>/ZERYS/images/helpme_icon.png" /></a></dt>
                                        <dd>
                                        	<select class="width260">
                                                <option value="0">Select</option>
                                                <option value="1">(10-25) sentence, tweet</option>
                                                <option value="2">(50-75) short paragraph</option>
                                                <option value="3">(75-100) long paragraph</option>
                                                <option value="4">(200-400) short blog/article</option>
                                                <option value="5">(400-600) mid-sized blog/article</option>
                                                <option value="6">(600-800) long blog/article</option>
                                                <option value="7">(800-1,200) very long blog/article OR short white paper</option>
                                                <option value="8">(1,200-3,000) mid-sized white paper</option>
                                                <option value="9">(3,000-6,000) long white paper OR short 6-12 pg. ebook</option>
                                                <option value="10">(6,000-12,000) very long white paper OR mid-sized 12-24 pg. ebook</option>
                                                <option value="11">(12,000-24,000) long 24-48 pg. ebook</option>
                                                <option value="12">Custom Range</option>
                                            </select>
                                        </dd>
                                    </label>
                                    <label>
                                    	<dt>Writer Assignment: </dt>
                                        <dd>
                                        	<span>
                                            	<input type="radio" name="group1" checked="checked" class="fLeft" /> 
                                                <span class="orderTxt fLeft">SmartPost</span> 
                                                <a href="#" class="fLeft orderTxt"><img src="<?php echo $url;?>/ZERYS/images/helpme_icon.png" width="16" height="16" /></a>
                                                <span class="clr"></span>
                                            </span>
                                            <span class="padingLT20 fLeft">
                                            	<input type="radio" name="group1" class="fLeft" /> 
                                                <span class="orderTxt fLeft">Direct Assign</span> 
                                                <a href="#" class="fLeft orderTxt"><img src="<?php echo $url;?>/ZERYS/images/helpme_icon.png" width="16" height="16" /></a>
                                                <span class="clr"></span>                                            
                                            </span>
                                            <span class="clear"></span>
                                        </dd>
                                    </label>
                                </dl>
                                <div class="clear"></div>
                            </form>
							<div class="height10"></div>
                        </div>
                        <!-- /WHITE BLOCK -->
                    </div>
                    <!-- /MIDDLE -->
                    
                    <!-- BOTTOM -->
                    <div class="bottom">
                    	<div class="bottomLeft"></div>
	                    <div class="bottomRight"></div>
                    </div>
                    <!-- /BOTTOM -->
                </div>
                <!-- /BLOCK 1 -->
                
                
                <!-- BLOCK 2 -->
            	<div class="roundCorner marginTop30">
                	<!-- TOP-->
                    <div class="top">
                    	<div class="topLeft"></div>
	                    <div class="topRight"></div>
                    </div>
                    <!-- /TOP-->
                    
                    <!-- MIDDLE -->
                    <div class="middle">
                    	<!-- WHITE BLOCK -->
                        <div class="whiteBlock minHeight370">
                        	<h2>2. Create Individual Page Titles/Headlines</h2>
                            <form method="post" class="paddingLT8">
                            	<div class="paddingBT7">
                                	<input type="radio" name="group4" class="fLeft" />
                                    <span class="fLeft writersTxt">Use Title Suggestion Tool</span>
                                    <a href="#" class="fLeft help" ><img src="<?php echo $url;?>/ZERYS/images/helpme_icon.png" width="16" height="16"  /></a>
                                    <div class="clear"></div>
                                </div>
                                <div class="paddingBT7">
                                	<input type="radio" name="group4" class="fLeft" />
                                    <span class="fLeft writersTxt">Enter titles manually</span>
                                    <a href="#" class="fLeft help" ><img src="<?php echo $url;?>/ZERYS/images/helpme_icon.png" width="16" height="16"  /></a>
                                    <div class="clear"></div>
                                </div>
                                
                                <h2 align="center">Title Suggestion Tool</h2>
                                <div class="marginBT10">
                                	<label>
                                        <span class="fLeft enterKeyTxt">Enter Keyword :</span>
                                        <input type="text" class="enterKeyInput" />
                                    </label>
                                	<div class="clear"></div>
                                </div>
                                <p>Search the following Sites:</p>
                                <div class="socialSite">
                                	<input type="radio" name="group5"  /> <span>Blogs</span>
                                    <input type="radio" name="group5"  /> <span>Ezinearticles </span>
                                    <input type="radio" name="group5"  /> <span>Web</span>
                                    <input type="radio" name="group5"  /> <span>News</span>
                                </div>
                                <div align="center">
                                	<input type="submit" value="Get Title Suggestions" class="suggestion_btn" /> 
                                </div>
                            </form>
                        </div>
                        <!-- /WHITE BLOCK -->
                    </div>
                    <!-- /MIDDLE -->
                    
                    <!-- BOTTOM -->
                    <div class="bottom">
                    	<div class="bottomLeft"></div>
	                    <div class="bottomRight"></div>
                    </div>
                    <!-- /BOTTOM -->
                </div>
                <!-- /BLOCK 2 -->
            </div>
            <!-- /LEFT COL -->
            
            <!-- RIGHT COL -->
            <div class="rightCol">
            	<!-- BLOCK 1 -->
            	<div class="roundCorner">
                	<!-- TOP-->
                    <div class="top">
                    	<div class="topLeft"></div>
	                    <div class="topRight"></div>
                    </div>
                    <!-- /TOP-->
                    
                    <!-- MIDDLE -->
                    <div class="middle">
                    	<!-- WHITE BLOCK -->
                        <div class="whiteBlock">
                        	<h2>3. Tell the Writers What You Need <a href="#"><img src="<?php echo $url;?>/ZERYS/images/helpme_icon.png" width="16" height="16" /></a></h2>
                            <p class="paddingLT8"><strong>Note:</strong> These instructions will apply to ALL titles in this order. To add additional instructions for individual pages, use the page-specific instruction (PSI) field below.</p>
                            <form method="post" class="paddingLT8">
                            	<div>
                                	<span class="fLeft">
                                    	<input type="radio" name="group3" class="fLeft" /> <span class="writersTxt">Simple Instructions Form </span>
                                        <span class="clear"></span> 
                                    </span>
                                    <span class="padingLT20 fLeft">
                                    	<input type="radio" name="group3" class="fLeft"/> <span class="writersTxt">Use Detailed Instructions Form</span>
                                        <span class="clear"></span>
                                    </span>
                                    <span class="clear"></span>
                                </div>
                                
                                <textarea class="msgContent"></textarea>
                            </form>
                        </div>
                        <!-- /WHITE BLOCK -->
                    </div>
                    <!-- /MIDDLE -->
                    
                    <!-- BOTTOM -->
                    <div class="bottom">
                    	<div class="bottomLeft"></div>
	                    <div class="bottomRight"></div>
                    </div>
                    <!-- /BOTTOM -->
                </div>
                <!-- /BLOCK 1 -->
                
                
                <!-- BLOCK 2 -->
            	<div class="roundCorner marginTop30">
                	<!-- TOP-->
                    <div class="top">
                    	<div class="topLeft"></div>
	                    <div class="topRight"></div>
                    </div>
                    <!-- /TOP-->
                    
                    <!-- MIDDLE -->
                    <div class="middle">
                    	<!-- WHITE BLOCK -->
                        <div class="whiteBlock minHeight370">
                        	<h2>4. Title Order List <a href="#"><img src="<?php echo $url;?>/ZERYS/images/helpme_icon.png" width="16" height="16" /></a></h2>
                            <!-- SEARCH RESULT TABLE -->
                            <div class="searchResultTable">
                                <table border="0" cellpadding="0" cellspacing="0">
                                	<tr class="trBackgroundColor">
                                    	<td width="100px">Keyword</td>
                                        <td width="263px">Title</td>
                                        <td width="35px">PSI</td>
                                        <td width="30px"></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /SEARCH RESULT TABLE -->
                            <p align="center" class="redColor">No Title(s) Found.</p>
                            
                            <!-- SHOW RESULT -->
                            <div class="showResultTable">
                            	<table border="0" cellpadding="0" cellspacing="0" class="borderCall">
                                	<tr>
                                    	<td width="197px">Total Word Count Range: </td>
                                        <td width="100px"> 0 to 0 words </td>
                                    </tr>
                                    <tr>
                                    	<td width="197px">Order Cost Range:  </td>
                                        <td width="100px"> &#36;0.00 to &#36;0.00</td>
                                    </tr>
                                    <tr>
                                    	<td width="197px">Funds Available:  </td>
                                        <td width="100px">&#36;<span class="greencolor">0.00</span> </td>
                                    </tr>
                                    <tr>
                                    	<td width="197px">Additional Funds Required: </td>
                                        <td width="100px">&#36;<span class="redColor">0.00</span> - </td>
                                    </tr>
                                </table>
                                <div align="right">
                                	<a href="#" class="addFundsLink">Add Funds</a>
                                </div>
                            </div>
                            <!-- /SHOW RESULT -->
                            <div align="center">
                            	<input type="submit" value="Place Order" class="suggestion_btn" />
                            </div>
                        </div>
                        <!-- /WHITE BLOCK -->
                    </div>
                    <!-- /MIDDLE -->
                    
                    <!-- BOTTOM -->
                    <div class="bottom">
                    	<div class="bottomLeft"></div>
	                    <div class="bottomRight"></div>
                    </div>
                    <!-- /BOTTOM -->
                </div>
                <!-- /BLOCK 2 -->
            </div>
            <!-- /RIGHT COL -->
            <div class="clear"></div>
        </div>
        <!-- /ORDER CONTENT -->
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
