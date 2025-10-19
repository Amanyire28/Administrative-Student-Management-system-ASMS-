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
  
</div class="card p-5  m-5 ">

   <table class=" table table-responsive caption-top table-striped table-light shadow-lg ms-4 me-4">
   
  <caption>Class List</caption>
  <a href="classform" class="btn btn-warning ms-4 mt-2">Add new Class</a>
  <thead>
    <tr>
        <th scope="col">Class</th>
        <th scope="col">Total Students</th>
        <th scope="col">Total Teachers</th>
        
        <th scope="col">Total Subjects</th>
       
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
              <li><a href="singleclass" class="dropdown-item">View</a></li>
              <li><a href="classedit" class="dropdown-item ">Edit</a></li>
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