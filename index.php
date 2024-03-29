<!DOCTYPE html>
<html>
 <head>
  <title>Build your files structure</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
  <style>
  </style>
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">Build your files structure</h2>
   <br /><br />
   <div class="row">
    <div class="col-md-6">
     <h3 align="center"><u>Add Files</u></h3>
     <br />
     <form method="post" id="treeview_form">
      <div class="form-group">
       <label>Select Parent</label>
       <select name="pid" id="pid" class="form-control">
       
       </select>
      </div>


	  <div class="form-group">
       <label>Select Type</label>
       <select name="type" id="type" class="form-control">
	   <option value"File">File</option>

       <option value"Folder" onclick="">Folder</option>
       </select>
      </div>




      <div class="form-group">
       <label>Enter Subfoldes/files</label>
       <input type="text" name="name" id="name" class="form-control">
      </div>

	  <div class="form-group">
	  <textarea row="50" cols"90" type="text" name="fileC" id="fileC" class="form-control"></textarea>
	  
	  </div>




      <div class="form-group">
       <input type="submit" name="action" id="action" value="Add" class="btn btn-info" />
      </div>
     </form>
    </div>
    <div class="col-md-6">
     <h3 align="center"><u>Your File structure</u></h3>
     <br />
     <div id="treeview"></div>
	<div>
       <button onclick="filesSubmit()" type="submit" class="btn btn-info">Submit Folders</button>
     </div>
    </div>
   </div>
  </div>
  <script>


 $(document).ready(function(){
  fill_parent_category();

  fill_treeview();
 
  
  function fill_treeview()
  {
   $.ajax({
    url:"fetch.php",
    dataType:"json",
    success:function(data){
	console.log(data.hasOwnProperty('nodes'));
	console.log(data.constructor===Array);

	function process(key,value) {
    console.log(key + " : "+value);
}
	function traverse(data,func) {
    for (var i in data) {
        func.apply(this,[i,data[i]]);  
        if (data[i] !== null && typeof(data[i])=="object") {
            //going one step down in the object tree!!
            traverse(data[i],func);
        }
    }
}


traverse(data,process);



     $('#treeview').treeview({
      data:data
     });
    }
   })
  }

  

 
  


	function fill_parent_category()
  {
   $.ajax({
    url:'fill_parent_category.php',
    success:function(data){
     $('#pid').html(data);
     
    }
   });
   
  }

  $('#treeview_form').on('submit', function(event){
   event.preventDefault();
   $.ajax({
    url:"add.php",
    method:"POST",
    data:$(this).serialize(),
    success:function(data){
     fill_treeview();
     fill_parent_category();
     $('#treeview_form')[0].reset();
     alert(data);
    }
   })
  }); 
 });






</script>
 </body>
</html>



