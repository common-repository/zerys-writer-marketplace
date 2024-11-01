
function ongoingform()
{

var count;
count=document.getElementById('ongoingcount').value;

var i=0;
for(i=1;i<=count;i++)
{
	if(document.deletongoing.elements[i].checked)
	{
	document.deletongoing.submit();
	}
}

}


function longdocform()
{
var count;
count=document.getElementById('longdocCount').value;
var i=0;

for(i=0;i<count;i++)
{
	if(document.deletlongdoc.elements[i].checked)
	{
	document.deletlongdoc.submit();
	}
}
}

function longdoc_arch()
{
var count;
count=document.getElementById('archcount').value;
var i=0;

for(i=1;i<=count;i++)
{
	
	if(document.archorderlist.elements[i].checked)
	{
	document.archorderlist.submit();
	}
}


}

function my_arch()
{

var count;
count=document.getElementById('ongoingcountarch').value;
var i=0;

for(i=1;i<=count;i++)
{
	
	if(document.myarchform.elements[i].checked)
	{
	document.myarchform.submit();
	}
}

//alert(document.getElementById.('my_archlist').value);
//document.myarchform.submit();

}



function openarch(key)
{
if(key=='myproject')
{
document.getElementById('btnproj_close').style.display='block';
document.getElementById('myarchgoing').style.display='block';
document.getElementById('btnproj_open').style.display='none';
}

if(key=='longdoc')
{
document.getElementById('myarc_long').style.display='block';
document.getElementById('btndoc_close').style.display='block';
document.getElementById('btndoc_open').style.display='none';
}

}

function closearch(btnclose,divclose,btnopen)
{
	document.getElementById(btnclose).style.display='none';
	document.getElementById(divclose).style.display='none';
	document.getElementById(btnopen).style.display='block';
		
}
