function editAdmin(id)
{
	window.open('index_admin.php?id='+id+'&ptype=3','_self');
}
function viewImage(path)
{
	window.open(path,'_new');
}
function delAdmin(id)
{
	var con=confirm("Are You Sure You Want to Delete ?");
	if(con)
	{
		window.open('deleteAdmin.php?id='+id,'_self');
		//window.open('index_admin.php?id='+id+'&ptype=4','_self');
	}
}
function editcat(id)
{
	window.open('editCategory.php?id='+id,'_self');
}
function delcat(id)
{
	var con=confirm("Are You Sure You Want to Delete ?");
	if(con)
	{
		window.open('delDetail.php?id='+id,'_self');
	}
}
function editPrice(id)
{
	window.open('index_admin.php?id='+id+'&ptype=6','_self');
}
function editTheme(id)
{
	window.open('index_admin.php?id='+id+'&ptype=8','_self');
}
function editCategory(id)
{
	//window.location('index_admin.php?id='+id+'&ptype=10','_self');
	window.location('index_admin.php','_self');
}
function editUser(id)
{
	window.open('index_admin.php?id='+id+'&ptype=','_self');
}
function editRecord(id)
{
	window.open('index_admin.php?id='+id+'&ptype=13','_self');
}
function moreImages(id)
{
	window.open('index_admin.php?id='+id+'&ptype=14','_self');
}
function videos(id)
{
	window.open('index_admin.php?id='+id+'&ptype=15','_self');
}
function validatePic()
{
	if(document.moreImg.imgType.value == "I" && document.moreImg.uploadedfile.value != "")
	{
	if(document.moreImg.uploadedfile.value.lastIndexOf(".jpg")>-1 || document.moreImg.uploadedfile.value.lastIndexOf(".jpeg")>-1
	|| document.moreImg.uploadedfile.value.lastIndexOf(".gif")>-1 || document.moreImg.uploadedfile.value.lastIndexOf(".png")>-1) 		 	{
	   return true;
	}
		else
		{
			alert("Please upload only (.jpg,.jpeg,.gif,.png) extention file");
		   return false;
		}
	}
	else if(document.moreImg.imgType.value == "V")
	{
	if(document.moreImg.uploadedfile.value.lastIndexOf(".avi")>-1 || document.moreImg.uploadedfile.value.lastIndexOf(".flv")>-1
	|| document.moreImg.uploadedfile.value.lastIndexOf(".mov")>-1)
	{
	   return true;
	}
		else
		{
			alert("Please upload only (.avi,.flv,.mov) extention file");
		   return false;
		}		
	}
}

function viewReview(revId)
{
	window.open('viewReview.php?revId='+revId,'_new');
}
function dissubmenu(i, nr)
{
	
	for(var j=1;j<=nr;j++)
	{
var divdis="men"+j;	
		if(j==i)
		{
			
			if(document.getElementById(divdis).style.display=="none")
			{
				document.getElementById(divdis).style.display="block";
			}
			else
			{
				document.getElementById(divdis).style.display="none";
			}
			
		}
		else
		{
			document.getElementById(divdis).style.display="none";	
		}
		
	}
	
}
function functionchkall(nr)
{
	if(document.getElementById("chkall").checked==true)
	{
		for(var i=1; i<=nr; i++)
		{
			
				document.getElementById("apv_rev["+i+"]").checked=true;
		}
	}
	else if(document.getElementById("chkall").checked==false)
	{
		for(var i=1; i<=nr; i++)
		{
				document.getElementById("apv_rev["+i+"]").checked=false;
		}	
	}
	
	
}