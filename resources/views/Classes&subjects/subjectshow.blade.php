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
  <div class="container mt-4">
  <form class="g-2" method="GET" action="search.php">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by category, class" aria-label="Recipient's username with two button addons">
                <select name="filter" class="form-select">
                    <option value="name">Category</option>
                    <option value="class">Class</option>
                    
                </select>
            <button class="btn btn-warning " type="button">Search</button>
        </div>
    
    
  </form>
</div class="card p-5  m-5 ">

   <table class=" table table-responsive caption-top table-striped table-light shadow-lg ms-4 me-4">
   
  <caption>Subject List</caption>
  <a href="subjectform" class="btn btn-warning ms-4 mt-2">Add new Subject</a>
  <thead>
    <tr>
        <th scope="col">Subject</th>
        <th scope="col">Category</th>
        <th scope="col">Head of Department</th>
        
        <th scope="col">Classes</th>
       
        <th scope="col">Actions</th>

        
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      
      <td>Otto</td>
      <td>@mdo</td>
      
      <td>@mdo</td>
      <td>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Choose Action
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a href="singlesubject" class="dropdown-item">View</a></li>
              <li><a href="editsubject" class="dropdown-item ">Edit</a></li>
              <li> <a href="#" class="dropdown-item">Delete</a></li>
            </ul>
        </div>
      </td>
      
      
    </tr>
    <tr>
      <th scope="row">2</th>
      
      <td>Thornton</td>
      <td>@fat</td>
      
      <td>@mdo</td>
      <td>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Choose Action
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a href="#" class="dropdown-item ">View</a></li>
              <li><a href="#" class="dropdown-item  ">Edit</a></li>
              <li> <a href="#" class="dropdown-item ">Delete</a></li>
            </ul>
        </div>
      </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      
      <td>@twitter</td>
      
      <td>@mdo</td>
      <td>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Choose Action
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a href="#" class="dropdown-item ">View</a></li>
              <li><a href="#" class="dropdown-item ">Edit</a></li>
              <li> <a href="#" class="dropdown-item ">Delete</a></li>
            </ul>
        </div>
      </td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>Larry</td>
      
      <td>@twitter</td>
      
      <td>@mdo</td>
      <td>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Choose Action
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a href="#" class="dropdown-item btn btn-outline-success ">View</a></li>
              <li><a href="#" class="dropdown-item btn btn-outline-secondary ">Edit</a></li>
              <li> <a href="#" class="dropdown-item btn btn-outline-danger ">Delete</a></li>
            </ul>
        </div>
      </td>
    </tr>
  </tbody>
</table>
 <form action="" method="post" class="ms-3">
    <input type="text" name="submit" class="ms-2 btn btn-outline-danger" value="Export to PDF">
  </form>
  
    





































  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>