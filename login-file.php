<?php
session_id('hey123');
session_start();
unset($_SESSION['cname']);
unset($_SESSION['cidd']);
unset($_SESSION['cUserId']);
unset($_SESSION['user']);
$url = WP_PLUGIN_URL;
$red=get_site_url();
   function showMessage($message, $errormsg = false)
{
	if ($errormsg) {
		echo '<div id="message" class="error">';
	}
	else {
		echo '<div id="message" class="updated fade">';
	}

	echo "<p><strong>$message</strong></p></div>";
} 
?>

<link href="<?php echo $url;?>/zerys-writer-marketplace/css/form.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $url;?>/zerys-writer-marketplace/css/common.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<!--<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>	-->
<script type="text/javascript" src="<?php echo $url;?>/zerys-writer-marketplace/js/jquery.validate.js"></script>
	 <script>
	 
var popupWindow = null;
function positionedPopup(url,winName,w,h,t,l,scroll){
settings =
'height='+h+',width='+w+',top='+t+',left='+l+',scrollbars='+scroll+',resizable'
popupWindow = window.open(url,winName,settings)
}
  $(document).ready(function(){
	$("#newAcc").validate({
		rules: {
			firstname: {
				required: true,
				minlength: 4
			},
			lname: {
				required: true,
				minlength: 4
			},
			cname: {
				required: true,
				
			},
			www: {
				required: true,
				
			},
			phone: {
				required: true,
				number:true
				
			},
			emailaddr: {
				 required: true,
       			 email: true

				
			},
			pass: {
				 required: true,
				
			},
			repass: {
			required: true,
				 equalTo: "#pass"
				
			},
			terms: {
				 required: true,
				
			},
			
		},
		messages: {
			firstname:"Please Enter your firstname",
			lname: "Please Enter your lastname",
			www: "Please Enter your Website url",
			 emailaddr: {
       required: "Please Enter Your Email address",
       email: "Your email address must be in the format of name@domain.com"
     },

			pass: "Please Enter your password",
			
		}
	});
	
	
	
	$("#loginform").validate({
		rules: {
			useremail: {
				required: true,
				email: true
			
			},
			userpass: {
				required: true,
				minlength: 4
			}
			
		},
		messages: {
			useremail:{
       required: "Please Enter Your Email address",
       email: "Your email address must be in the format of name@domain.com"
     },
			lname: "Please enter your password",
			
			

			
			
		}
	});
	
	
  });
  
 
  </script>
  <?php
		include('zeyers-config.php');
		global $wpdb;
		$query="select apikay from zerys";	
		$key=$wpdb->get_results($query);
		if($_REQUEST['emailaddr']!='')
		{
		
		$url =$basePath."json/new_account/".$key[0]->apikay;

$data = '{

   "Comapanyname":"'.$_REQUEST['cname'].'", 	
	
	"Email":"'.$_REQUEST['emailaddr'].'",

   "Firstname":"'.$_REQUEST['firstname'].'",

   "Lastname":"'.$_REQUEST['lname'].'",
   
   "Password":"'.$_REQUEST['pass'].'",
   
   "Phone":"'.$_REQUEST['phone'].'",
   
   "Ext":"'.$_REQUEST['ext'].'",
   
   "Website":"'.$_REQUEST['www'].'"

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

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 

curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

$result = curl_exec($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$json = str_replace(array("\n","\r"),"",$result);
$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
$arr=json_decode($result,false);



if($arr->Result=='1')
{
session_id('helsys');
session_start();
$_SESSION['cname']=$arr->Companyname;
$_SESSION['cidd']=$arr->Cidd;
$_SESSION['cUserId']=$arr->ClientUserID;
$_SESSION['user']=$arr->Login;
?>
<script type="text/javascript">
window.location.href="<?php echo $red?>/wp-admin/admin.php?page=wp-zerys";
</script>

<?php }else{
echo "<h3>".$arr->Message."</h3>";
}
}

//Login API Hit
if($_REQUEST['useremail']!='')
{



$url =$basePath."json/login/".$key[0]->apikay;

$data = '{       

   "Email":"'.$_POST['useremail'].'",

   "Password":"'.$_POST['userpass'].'"

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

$json = str_replace(array("\n","\r"),"",$result);
$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
$arr=json_decode($json,false);


if(($arr->Result=='1') and ($arr->ClientUserID!=-5))
{


session_id('helsys');
session_start();
$_SESSION['cname']=$arr->Companyname;
$_SESSION['cidd']=$arr->Cidd;
$_SESSION['cUserId']=$arr->ClientUserID;
$_SESSION['user']=$arr->Login;
?>
<script type="text/javascript">
window.location.href="<?php echo $red?>/wp-admin/admin.php?page=wp-zerys";
</script>

<?php }else if($arr->ClientUserID==-5)
{

add_action('admin_notices', 'showAdminMessages');

  showMessage("We noticed you are logging in as an Agency. We are sorry, but currently, the ZerysWordPress plugin does not support Zerys for Agencies users. We will be adding this functionality soon.");

   
}
else
{
$msg= "Email Or Password Incorrect";
}

}


  ?>
	<!-- FORM CONTAINER -->
	<div class="fromStyle">
		
		<!-- COL LEFT -->
		<form name="newAcc" id="newAcc"  method="post" action="">
		<div class="fleft">
			<h2>Create New Account</h2>
			<div class="fromTwoColStruct">
				<dl>
					<dt>First name<span class="txtRed">*</span></dt>
					<dd><input type="text" name="firstname" id="firstname" /></dd>
					
					<dt>Last name<span class="txtRed">*</span></dt>
					<dd><input type="text" name="lname" id="lname" /></dd>
							
					<dt>Company Name<span class="txtRed">*</span></dt>
					<dd><input type="text"  id="cname" name="cname" /></dd>
					
					<dt>Website<span class="txtRed">*</span></dt>
					<dd><input type="text" name="www" id="www" /></dd>
					
					<dt>Phone<span class="txtRed">*</span></dt>
					<dd><input type="text" name="phone" id="phone" /></dd>
					
					<dt>&nbsp;</dt>
					<dd>&nbsp;</dd>
					
					<dt>Extn</dt>
					<dd><input type="text" name="ext" id="ext" /></dd>
					
					<dt>Email<span class="txtRed">*</span></dt>
					<dd><input type="text" name="emailaddr" id="emailaddr"  /></dd>
					
					<dt>Password<span class="txtRed">*</span></dt>
					<dd><input type="password" name="pass" id="pass" /></dd>
					
					<dt>Retype Password<span class="txtRed">*</span></dt>
					<dd><input type="password" name="repass" id="repass" /></dd>
				</dl>
				
				<div class="clr">
					<div class="paddingB10"><strong>Terms &amp; Service</strong></div>
					<!-- <textarea rows="5" cols="" class="width370">adasdas</textarea> -->
					
					<div class="termsCondition">
					<p>
						INTERACT MEDIA, LLC ("INTERACT MEDIA") IS WILLING TO GRANT YOU RIGHTS TO ESTABLISH
						AN ACCOUNT AND TO USE THE SERVICES PROVIDED BY THIS SITE ONLY UPON THE CONDITION
						THAT YOU ACCEPT ALL OF THE TERMS CONTAINED IN THIS AGREEMENT. PLEASE READ THE TERMS
						CAREFULLY. BY CLICKING ON "I ACCEPT", YOU WILL INDICATE YOUR AGREEMENT WITH THEM.
						IF YOU ARE ENTERING INTO THIS AGREEMENT ON BEHALF OF A COMPANY OR OTHER LEGAL ENTITY
						OR PERSON, YOUR ACCEPTANCE REPRESENTS THAT YOU HAVE THE AUTHORITY TO BIND SUCH ENTITY
						OR PERSON TO THESE TERMS. IF YOU DO NOT AGREE WITH THESE TERMS, OR IF YOU DO NOT
						HAVE THE AUTHORITY TO BIND YOUR ENTITY OR PERSON, THEN INTERACT MEDIA IS UNWILLING
						TO GRANT YOU RIGHTS TO ESTABLISH AN ACCOUNT AND TO USE THE SERVICES PROVIDED BY
						THIS SITE.</p>
					<p>
						<b>SUBSCRIPTION AGREEMENT</b>
					</p>
					<p>
						Effective Date: August 10, 2010
					</p>
					<p>
						To review material modifications and their effective dates scroll to the bottom
						of the page.
					</p>
					<p>
						</p><ol>
							<li><strong>Parties.</strong> The parties to this legal Agreement are you, and the owner
								of this interactmedia.com website business, Interact Media. If you are not acting
								on behalf of yourself as an individual, then "you", "your", and "yourself" means
								your company or organization or the person you are representing. All references
								to "we", "us", "our", "this website" or "this site" shall be construed to mean this
								interactmedia.com website business and Interact Media. <br><br></li>
							<li><strong>Agreement</strong>. The legal Agreement between you and Interact Media consists
								of this SUBSCRIPTION AGREEMENT, plus our Terms of Use and Privacy Policy which are
								incorporated herein and accessible on this site's home page. If there is any conflict
								between this SUBSCRIPTION AGREEMENT and the Terms of Use, this SUBSCRIPTION AGREEMENT
								shall take precedence.  <br><br></li>
							<li><strong>Modification of Agreement.</strong> We reserve the right to modify this
								Agreement at any time by posting an amended Agreement that is always accessible
								through a link on this site's home page and/or by giving you prior notice of a modification.
								You should check this Agreement periodically for modifications by scrolling to the
								bottom of this page for a listing of material modifications and their effective
								dates. IF ANY MODIFICATION IS UNACCEPTABLE TO YOU, YOUR ONLY RECOURSE IS TO TERMINATE
								THIS AGREEMENT. YOUR CONTINUED USE OF THIS SITE FOLLOWING OUR POSTING OF AN AMENDED
								AGREEMENT OR PROVIDING YOU NOTICE OF A MODIFICATION WILL CONSTITUTE BINDING ACCEPTANCE.
							<br><br></li>
							<li><strong>Subscription Eligibility.</strong> Subscriptions are not available to minors
								under the age of 18 years of age and any user that has been suspended or removed
								from the system.  <br><br></li>
							<li><strong>Subscription Services.</strong> Subscription services include User will
								have access to the Zerys Content Development Platform and Writer Marketplace. User
								will have full access to all setup tools. User will be able to search for writers
								within the Interact Media writer network, post titles to the writer job board, assign
								titles directly to individual writers, communicate with writers using the Zerys
								communication system, and negotiate long-term payment rates with individual writers.
								User can review content, request revisions, or approve content. Once content is
								approved, user can export content and publish it anywhere the client chooses. ("Services").
								We reserve the right to update and modify the Services from time to time.  <br><br></li>
							<li><strong>Subscription Use And Restrictions.</strong> Subject to the terms and conditions
								of this Agreement, our Terms of Use, and our Privacy Policy, you may access and
								use this site's Services, but only for your own internal purposes. All rights not
								expressly granted in this Agreement are reserved by us and our licensors.<ul style="list-style:none;"><br>
								<li>6.1&nbsp; You
								will be granted a single login ID and password for each subscription that you purchase,
								and your access and use the Services will be limited to one person at a time per
								ID and password. You agree not to access (or attempt to access) this site by any
								means other than through the interface we provide, unless you have been specifically
								allowed to do so in a separate agreement. You agree not to access (or attempt to
								access) this site through any automated means (including use of scripts or web crawlers),
								and you agree to comply with the instructions set out in any robots.txt file present
								on this site. <br><br></li> <li> 6.2&nbsp; You are not authorized to (i) resell, sublicense, transfer, assign,
								or distribute the site, its Services or content; (ii) modify or make derivative
								works based upon the site, its Services or content; or (iii) "frame" or "mirror"
								any site, its Services or content on any other server or Internet-enabled device. <br><br></li> 
							   <li>6.3&nbsp; You are not authorized to use our Services or servers for the propagation, distribution,
								housing, processing, storing, or otherwise handling in any way lewd, obscene, or
								pornographic material, or any other material which we deem to be objectionable.
								The designation of any such materials is entirely at our sole discretion.</li></ul>   <br><br></li>
							<li><strong>Ownership.</strong> The material provided on this site and via our Services
								is protected by law, including, but not limited to, United States copyright law
								and international treaties. The copyrights and other intellectual property rights
								in this material are owned by us and/or others. Except for the limited rights granted
								herein, all other rights are reserved.  <br><br></li>
							<li><strong>Termination.</strong> You agree that we may terminate your account and access
								to the Services for cause without prior notice, upon the occurrence of any one of
								the following: (i) any material breach of this Agreement, including without limitation
								any failure to pay fees as they become due or any unauthorized use of the site or
								Services, or (ii) requests by law enforcement or other government agencies. Termination
								of your account includes (i) removal of access to all Services, and (ii) deletion
								of your login data, password, and all related information. Further, you agree that
								all terminations shall be made in our sole discretion, and that we will not be liable
								to you or any third-party for any termination of your account or access to Services.
						   <br><br></li>
							<li><strong>Your Account-Related Responsibilities.</strong> You are responsible for
								maintaining the confidentiality of your login ID, password, and any additional information
								that we may provide regarding accessing your account. If you knowingly share your
								login ID and password with another person who is not authorized to use the Services,
								this Agreement is subject to termination for cause. You agree to immediately notify
								us of any unauthorized use of your login ID, password, or account or any other breach
								of security.  <br><br></li>
							<li><strong>No Monthly Subscription Fees.</strong> For standard subscription services
								there are no monthly subscription charges. Users that choose to add their own in-house
								writers pay a flat monthly fee per writer, as shown on the In-house writer screen
								within the user account. <br><br></li>
							<li><strong>Technical Support.</strong> We shall answer questions by email and telephone
								during our normal business hours regarding the use of the Services.  <br><br></li>
							<li><strong>Warranty Disclaimers.</strong> EXCEPT AS MAY BE PROVIDED IN ANY SEPARATE
								WRITTEN AGREEMENTS SIGNED BY THE PARTIES, THE SERVICES, CONTENT, AND/OR PRODUCTS
								ON THIS SITE ARE PROVIDED "AS-IS", AND NEITHER WE NOR ANY OF OUR LICENSORS MAKE
								ANY REPRESENTATION OR WARRANTY WITH RESPECT TO SUCH PRODUCTS, SERVICES, AND/OR CONTENT.
								EXCEPT AS MAY BE PROVIDED IN ANY SEPARATE WRITTEN AGREEMENT SIGNED BY THE PARTIES
								OR SEPARATE AGREEMENT ORIGINATING FROM THIS SITE, THIS SITE AND ITS LICENSORS SPECIFICALLY
								DISCLAIM, TO THE FULLEST EXTENT PERMITTED BY LAW, ANY AND ALL WARRANTIES, EXPRESS
								OR IMPLIED, RELATING TO THIS SITE OR PRODUCTS, SERVICES AND/OR CONTENT ACQUIRED
								FROM THIS SITE, INCLUDING BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY,
								COMPLETENESS, TIMELINESS, CORRECTNESS, NON-INFRINGEMENT, OR FITNESS FOR ANY PARTICULAR
								PURPOSE. THIS SITE AND ITS LICENSORS DO NOT REPRESENT OR WARRANT THAT THIS SITE,
								ITS PRODUCTS, SERVICES, AND/OR CONTENT: (A) WILL BE SECURE, TIMELY, UNINTERRUPTED
								OR ERROR-FREE OR OPERATE IN COMBINATION WITH ANY OTHER HARDWARE, SOFTWARE, SYSTEM
								OR DATA, (B) WILL MEET YOUR REQUIREMENTS OR EXPECTATIONS, OR (C) WILL BE FREE OF
								VIRUSES OR OTHER HARMFUL COMPONENTS. USER UNDERSTANDS THAT CONTENT RECEIVED FROM
								WRITERS MAY CONTAIN FACTUAL ERRORS AND THE OPINIONS OF THE WRITER AND INTERACT MEDIA
								IN NO WAY GUARANTEES THE ACCURACY OF THE INFORMATION RECEIVED FROM WRITERS WITHIN
								THE ZERYS CONTENT PLATFORM. THIS SITE IS NOT ENGAGED IN THE PRACTICE OF LAW. NO
								ATTORNEY-CLIENT RELATIONSHIP IS CREATED BY OR THROUGH THE USE OF THIS SITE. WE DO
								NOT PROVIDE MEDICAL ADVICE FOR ANY PURPOSE. ALL MATERIALS ARE PROVIDED FOR INFORMATIONAL
								PURPOSES ONLY. THESE DISCLAIMERS CONSTITUTE AN ESSENTIAL PART OF THIS AGREEMENT.
								NO PURCHASE OR USE OF THE ITEMS OFFERED BY THIS SITE IS AUTHORIZED HEREUNDER EXCEPT
								UNDER THESE DISCLAIMERS. IF IMPLIED WARRANTIES MAY NOT BE DISCLAIMED UNDER APPLICABLE
								LAW, THEN ANY IMPLIED WARRANTIES ARE LIMITED IN DURATION TO THE PERIOD REQUIRED
								BY APPLICABLE LAW. SOME STATES OR JURISDICTIONS DO NOT ALLOW LIMITATIONS ON HOW
								LONG AN IMPLIED WARRANTY MAY LAST, SO THE ABOVE LIMITATIONS MAY NOT APPLY TO YOU.
							<br><br></li>
							<li><strong>Limitation of Liability.</strong> IN NO EVENT SHALL EITHER PARTY AND/OR
								ITS LICENSORS BE LIABLE TO ANYONE FOR ANY DIRECT, INDIRECT, PUNITIVE, SPECIAL, EXEMPLARY,
								INCIDENTAL, CONSEQUENTIAL OR OTHER DAMAGES OF ANY TYPE OR KIND (INCLUDING LOSS OF
								DATA, REVENUE, PROFITS, USE OR OTHER ECONOMIC ADVANTAGE) ARISING OUT OF, OR IN ANY
								WAY CONNECTED WITH THE SUBSCRIPTION SERVICE, INCLUDING WITHOUT LIMITATION THE USE
								OR INABILITY TO USE THE SERVICES, OR FOR ANY CONTENT OBTAINED FROM OR THROUGH THE
								SERVICES OR THIS SITE, ANY INTERRUPTION, INACCURACY, ERROR OR OMISSION, REGARDLESS
								OF CAUSE, EVEN IF THE PARTY FROM WHICH DAMAGES ARE BEING SOUGHT OR SUCH PARTY'S
								LICENSORS HAVE BEEN PREVIOUSLY ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.  <br><br></li>
							<li><strong>Confidential Information.</strong> You agree that all non-public information
								that we provide regarding the Services, including without limitation, our pricing,
								marketing methodology, and business processes, is our proprietary confidential information.
								You agree to use this confidential information only for purposes of exercising your
								rights as our affiliate while in strict compliance with this Agreement, and you
								further agree not to use or disclose this confidential information for a period
								of three (3) years after termination as our affiliate. <br><br></li>
							<li><strong>Intended For Use Only In The United States.</strong> This site is intended
								for use only from within the United States. We do not represent that this site is
								appropriate for use elsewhere. Access to this site from locations where its contents
								are illegal is not authorized. <br><br></li>
							<li><strong>Onward Transfer of Personal Information Outside Your Country of Residence.</strong>
								Any personal information which we may collect on this site will be stored and processed
								in our servers located only in the United States. If you reside outside the United
								States, you consent to the transfer of personal information outside your country
								of residence to the United States.  <br><br></li>
							<li><strong>Export Control.</strong> This site provides Services and uses software and
								technology that may be subject to United States export controls administered by
								the U.S. Department of Commerce, the United States Department of Treasury Office
								of Foreign Assets Control, and other U.S. agencies and the export control regulations
								of Switzerland and the European Union. The user of this site ("User") acknowledges
								and agrees that the site and Services shall not be used in, and none of the underlying
								information, software, or technology may be transferred or otherwise exported or
								re-exported to, countries to which the United States, Switzerland and/or the European
								Union maintains an embargo (collectively, "Embargoed Countries"), or to or by a
								national or resident thereof, or any person or entity on the U.S. Department of
								Treasury's List of Specially Designated Nationals or the U.S. Department of Commerce's
								Table of Denial Orders (collectively, "Designated Nationals"). The lists of Embargoed
								Countries and Designated Nationals are subject to change without notice. By using
								the Services, you represent and warrant that you are not located in, under the control
								of, or a national or resident of an Embargoed Country or Designated National. You
								agree to comply strictly with all U.S., Swiss and European Union export laws and
								assume sole responsibility for obtaining licenses to export or re-export as may
								be required.  <br><br></li>
							<li><strong>Registration Data.</strong> Registration is required for you to establish
								an account at this site. You agree (i) to provide certain current, complete, and
								accurate information about you as prompted to do so by our online registration form
								("Registration Data"), and (ii) to maintain and update such Registration Data as
								required to keep such information current, complete and accurate. You warrant that
								your Registration Data is and will continue to be accurate and current, and that
								you are authorized to provide such Registration Data. You authorize us to verify
								your Registration Data at any time. If any Registration Data that you provide is
								untrue, inaccurate, not current or incomplete, we retain the right, in its sole
								discretion, to suspend or terminate rights to use your account. Solely to enable
								us to use information you supply us internally, so that we are not violating any
								rights you might have in that information, you grant to us a nonexclusive license
								to (i) convert such information into digital format such that it can be read, utilized
								and displayed by our computers or any other technology currently in existence or
								hereafter developed capable of utilizing digital information, and (ii) combine the
								information with other content provided by us in each case by any method or means
								or in any medium whether now known or hereafter devised.  <br><br></li>
							<li><strong>How We Treat Postings To This Site.</strong> We will not treat information
								that you post to areas of this site that are viewable by others (for example, to
								a blog, forum or chat-room) as proprietary, private, or confidential. We have no
								obligation to monitor posts to this site or to exercise any editorial control over
								such posts; however, we reserve the right to review such posts and to remove any
								material that, in our judgment, is not appropriate. Posting, transmitting, promoting,
								using, distributing or storing content that could subject us to any legal liability,
								whether in tort or otherwise, or that is in violation of any applicable law or regulation,
								or otherwise contrary to commonly accepted community standards, is prohibited, including
								without limitation information and material protected by copyright, trademark, trade
								secret, nondisclosure or confidentiality agreements, or other intellectual property
								rights, and material that is obscene, defamatory, constitutes a threat, or violates
								export control laws. <br><br></li>
							<li><strong>Defamation; Communications Decency Act Notice.</strong> This site is a provider
								of "interactive computer services" under the Communications Decency Act, 47 U.S.C.
								Section 230, and as such, our liability for defamation and other claims arising
								out of any postings to this site by third parties is limited as described therein.
								We are not responsible for content or any other information posted to this site
								by third parties. We neither warrant the accuracy of such postings or exercise any
								editorial control over such posts, nor do we assume any legal obligation for editorial
								control of content posted by third parties or liability in connection with such
								postings, including any responsibility or liability for investigating or verifying
								the accuracy of any content or any other information contained in such postings.
						 <br><br></li>
							<li><strong>Monitoring.</strong> We reserve the right to monitor your access and use
								of this website without notification to you. We may record or log your use in a
								manner as set out in our Privacy Policy that is accessible through the Privacy Policy
								link on this site's home page.  <br><br></li>
							<li><strong>Privacy And Security.</strong> You may access, read, and print our policies
								regarding privacy and security through the Privacy Policy link on our site's home
								page. As stated in our Privacy Policy, we reserve the right to modify our terms
								regarding privacy and security from time to time. In your review of our Privacy
								Policy, please note our policies regarding email notice to you and your rights to
								opt out of such emails. Provided that we comply with the security policies specified
								in our Privacy Policy, we will not, under any circumstances, be held responsible
								or liable for situations where information or transmissions are accessed by third
								parties through illegal or illicit means or through the exploitation of security
								vulnerabilities in our site and network. We will promptly report to you any unauthorized
								access to your information promptly upon discovery, and we will use diligent efforts
								to promptly remedy any security vulnerability that permitted the unauthorized access.
								If notification to persons affected by the unauthorized access is required, you
								agree to be solely responsible for any and all such notifications at your expense.
							<br><br></li>
							<li><strong>Notices.</strong> We may give notice to you by means of (i) a general notice
								in your account information, (ii) by electronic mail to your e-mail address on record
								in your Registration Data, or (iii) by written communication sent by first class
								mail or pre-paid post to your address on record in your Registration Data. Such
								notice shall be deemed to have been given upon the expiration of forty eight (48)
								hours after mailing or posting (if sent by first class mail or pre-paid post) or
								twelve (12) hours after sending (if sent by email). You may give notice to us (such
								notice shall be deemed given when received by us) at any time by any of the following:
								(a) by letter sent by confirmed facsimile to us at the following fax number, 877-605-6882;
								or (b) by letter delivered by nationally recognized overnight delivery service or
								first class postage prepaid mail to us as follows: Interact Media, LLC, 9319 Hermitage
								Rd, , Chardon, OH 44024, in either case, addressed to the attention of "President
								of the Company". Notices will not be effective unless sent in accordance with the
								above requirements.  <br><br></li>
							<li><strong>Arbitration.</strong> Except for actions to protect intellectual property
								rights and to enforce an arbitrator's decision hereunder, all disputes, controversies,
								or claims arising out of or relating to this Agreement or a breach thereof shall
								be submitted to and finally resolved by arbitration under the rules of the American
								Arbitration Association ("AAA") then in effect. There shall be one arbitrator, and
								such arbitrator shall be chosen by mutual agreement of the parties in accordance
								with AAA rules. The arbitration shall take place in Cleveland, Ohio, USA, and may
								be conducted by telephone or online. The arbitrator shall apply the laws of the
								State of Ohio, USA to all issues in dispute. The controversy or claim shall be arbitrated
								on an individual basis, and shall not be consolidated in any arbitration with any
								claim or controversy of any other party. The findings of the arbitrator shall be
								final and binding on the parties, and may be entered in any court of competent jurisdiction
								for enforcement. Enforcements of any award or judgment shall be governed by the
								United Nations Convention on the Recognition and Enforcement of Foreign Arbitral
								Awards. Should either party file an action contrary to this provision, the other
								party may recover attorney's fees and costs up to $1000.00.  <br><br></li>
							<li><strong>Jurisdiction And Venue.</strong> The courts of Geauga County in the State
								of Ohio, USA and the nearest U.S. District Court shall be the exclusive jurisdiction
								and venue for all legal proceedings that are not arbitrated under this Agreement.
						   <br><br></li>
							<li><strong>Severability.</strong> If any provision of this Agreement is declared invalid
								or unenforceable, such provision shall be deemed modified to the extent necessary
								and possible to render it valid and enforceable. In any event, the unenforceability
								or invalidity of any provision shall not affect any other provision of this Agreement,
								and this Agreement shall continue in full force and effect, and be construed and
								enforced, as if such provision had not been included, or had been modified as above
								provided, as the case may be.  <br><br></li>
							<li><strong>Force Majeure.</strong> We shall not be liable for damages for any delay
								or failure of delivery arising out of causes beyond our reasonable control and without
								our fault or negligence, including, but not limited to, Acts of God, acts of civil
								or military authority, fires, riots, wars, embargoes, Internet disruptions, hacker
								attacks, or communications failures.  <br><br></li>
							<li><strong>U.S. Government End-Users.</strong> The software for this site consists
								of "commercial items," as that term is defined in 48 C.F.R. 2.101 (Oct. 1995), consisting
								of "commercial computer software" and "commercial computer software documentation,"
								as such terms are used in 48 C.F.R. 12.212 (Sept. 1995). Consistent with 48 C.F.R.
								12.212 and 48 C.F.R. 227.7202-1 through 227.7202-4 (June 1995), all U.S. Government
								end-users of this site acquire only those rights as are granted to all other end
								users pursuant to the terms and conditions herein. Unpublished-rights reserved under
								the copyright laws of the United States. <br><br></li>
							<li><strong>Survival.</strong> Those clauses the survival of which is necessary for
								the interpretation or enforcement of this Agreement shall continue in full force
								and effect in accordance with their terms notwithstanding the expiration or termination
								hereof, such clauses to include, without limitation, the following: License Restrictions,
								Warranty Disclaimer, Limitation of Liability, Privacy And Security, Notices, Arbitration,
								Jurisdiction and Venue, Severability, Force Majeure, and Miscellaneous.  <br><br></li>
							<li><strong>Miscellaneous.</strong> This Agreement, our Terms of Use, and our Privacy
								Policy (collectively the "Website Terms and Conditions") constitute the entire understanding
								of the parties with respect to this site and merges all prior communications, representations,
								and agreements. If any provision of these Website Terms and Conditions is held to
								be unenforceable for any reason, such provision shall be reformed only to the extent
								necessary to make it enforceable. These Website Terms and Conditions shall be construed
								under the laws of the State of Ohio, USA, excluding rules regarding conflicts of
								law. The application the United Nations Convention of Contracts for the International
								Sale of Goods is expressly excluded. This license is written in English, and English
								is its controlling language. If you are located outside the U.S., then the following
								provisions shall apply: (i) Les parties aux presentes confirment leur volonte que
								cette convention de meme que tous les documents y compris tout avis qui siy rattache,
								soient rediges en langue anglaise (translation: "The parties confirm that this Agreement
								and all related documentation is and will be in the English language."); and (ii)
								you are responsible for complying with any local laws in your jurisdiction which
								might impact your right to import, export or use this site, and you represent that
								you have complied with any regulations or registration procedures required by applicable
								law to make this agreement enforceable. <br><br></li>
						</ol>
					<p></p>
					<p>
						Material Modifications Since August 10, 2010: none.
					</p>
				</div>
					
					
					
					<div class="txtCenter">
						<div class="paddingTB15"><input type="checkbox" name="terms" id="terms" /> I accept the Terms of Service</div>
						<input type="submit" value="Submit" class="btn90" />
			</form>
					</div>
				</div>
			</div>
		</div>
	<!--/ COL LEFT Close -->
		
		<!-- COL RIGHT -->
		<div class="fright">
			
			<h2>Already Have an Account?</h2>
			<div class="fromTwoColStruct2">
			<form name="loginform" id="loginform"  method="post">
				<dl>
					<dt><strong>Email:</strong></dt>
					
					<dd><input type="text" name="useremail" id="useremail" /></dd>
					
					<dt><strong>PW:</strong></dt>
					<dd>
						<input type="password" name="userpass" id="userpass" />
						<div class="paddingT3"><a onclick="positionedPopup('http://my.zerys.com/Forgotpassword.aspx','myWindow','600','150','100','200','yes');return false" href="#">forgot password</a></div>
						<label style="color:#FF0000;"><?php echo "<br>".$msg;?></label>
					</dd>
					
					<dt>&nbsp;</dt>
					<dd><input type="submit" value="Sign In" class="btn70" /></dd>
					
				</dl>
				</form>
			</div>
		</div><!--/ COL RIGHT Close -->
		<div class="clr"></div>
	</div><!--/ FORM CONTAINER Close -->
