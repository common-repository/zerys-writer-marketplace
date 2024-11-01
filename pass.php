
<script type="text/javascript">
function passlink(id)
{
document.getElementById('link').value=id;
}
function gotoLink()
{
var lk=document.getElementById('link').value;
if(lk!='')
	{
var open_link = window.open('','_blank');
document.getElementById('blockModalPopupDiv').style.display='none';
	document.getElementById('outerModalPopupDiv').style.display='none';
open_link.location=lk;
}
else
{
var lk=document.getElementById('homeurl').value;
var open_link = window.open('','_blank');
document.getElementById('blockModalPopupDiv').style.display='none';
	document.getElementById('outerModalPopupDiv').style.display='none';
open_link.location=lk;
}

}
function cancel()
{
	document.getElementById('blockModalPopupDiv').style.display='none';
	document.getElementById('outerModalPopupDiv').style.display='none';
	
}
</script>
<p style="font-family:Verdana,Geneva,sans-serif">The Zerys screen you are about to visit is not within the WordPress Plug-in. Once you click OK on this window, a new window will open and you will be auto-logged into your main Zerys account, outside of your WordPress account. Your WordPress account window will remain open behind the new window. When you return to your original WordPress account, you may need to refresh to see any changes.</p>

<div align="center">
<input   type="button" onclick="gotoLink()" value="ok"  />
<input  type="button" onclick="cancel()" value="cancel"  />
<input type="hidden" value="" id="link"  />
</div>