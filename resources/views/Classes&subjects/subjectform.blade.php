<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
    
    <div class="card shadow-lg m-5">
  <div class="card-header bg-secondary fw-bold text-center text-white">
    Upload Subject Details
  </div>
  <div class="card-body ">
   <form action="" class="">
        <h3></h3>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Choose Class</label>
            <select class="form-select" id="inputGroupSelect01">
                <!-- <option selected></option> -->
                <option value="1">Senior One</option>
                <option value="2">Senior Two</option>
                <option value="3">Senior Three</option>
                <option value="4">Senior Four</option>
                <option value="5">Senior Five</option>
                <option value="6">Senior Six</option>
            </select>
            
        </div>
            <label for="" class="form-label">Head of Department</label>
            <input class="form-control" type="text" placeholder="Mr Musoke Lawrence" aria-label="default input example"><br>
            <label for="formFile" class="form-label">Add Student List</label>
            <input class="form-control" type="file" id="formFile"><br>
            <label for="formFile" class="form-label">Add Teacher List</label>
            <input class="form-control" type="file" id="formFile"><br>
            

            <button class="btn btn-outline-success m-2">Add Subject Details</button>
    </form>
    <a href="subjectshow" class="btn btn-outline-warning m-2">View Subjects</a>
  </div>
  
  
</div>
</body>
</html>