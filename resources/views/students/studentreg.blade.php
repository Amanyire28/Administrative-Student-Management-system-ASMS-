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
    <form action="" enctype="multipart/form-data" class="p-5">
        <h2 class="text-center border-bottom mb-4">STUDENT INFORMATION</h2>
        <div class="row">
            <div class="col-6">
                
                 <label for="imageUpload" class="form-label fw-bold">Upload Student Photo</label>
                        <input class="form-control" type="file" id="imageUpload" name="image">
                        

                    <div id="imagePreview" class="mt-3">
                        <img id="previewImg" alt="Preview" style="max-width:150px; display:none;">
                        <div id="previewInfo" class="mt-2 small text-muted"></div>               <button type="button" id="removeImage" class="btn btn-sm btn-outline-danger mt-2" style="display:none;">Remove</button>
                    </div>
            
            </div>
                        
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Full Name:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">DOB:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Home Address:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="mb-3">
                         <select class="form-select" aria-label="Default select example">
                        <option selected>Choose Class</option>
                        <option value="1">Senior One</option>
                        <option value="2">Senior Two</option>
                        <option value="3">Senior Three</option>
                         <option value="1">Senior Four</option>
                        <option value="2">Senior Five</option>
                        <option value="3">Senior Six</option>
                        </select>
                    </div>
                   <div class="mb-3">
                        <select class="form-select " aria-label="Default select example">
                        <option selected>Choose Stream</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        </select>
                   </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example">
                        <option selected>Choose House</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        </select>
                    </div>
                    
                </div>






                
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card border-success mb-3" style="max-width: 35rem;">
        <div class="card-header bg-transparent border-success text-center">PARENT/GUARDIAN 1</div>
  <div class="card-body text-success">
     <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Full Name:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">PHONE:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">EMAIL:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>


            </div>
            
            </div>

                </div>
                <div class="col-6">
                    <div class="card border-success mb-3" style="max-width: 35rem;">
        <div class="card-header bg-transparent border-success text-center">PARENT/GUARDIAN 2</div>
  <div class="card-body text-success">
     <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Full Name:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">PHONE:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">EMAIL:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>


            </div>
            
            </div>

                </div>
            </div>
            <div class="card border-success  " style="max-width: 73rem;">
        <div class="card-header bg-transparent border-success text-center">EMERGENCY CONTACT</div>
  <div class="card-body text-success">
     <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Full Name:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">PHONE:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">EMAIL:</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>


            </div>
            
            </div>

            <a href="studentshow" class="mt-2 p-2 btn  btn-outline-success text-center">Register</a>
             <a href="studentshow" class="btn btn-outline-warning m-2">View Students</a>
            
    </form>
    

    

    




















    <script>
document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('imageUpload');
  const previewImg = document.getElementById('previewImg');
  const previewInfo = document.getElementById('previewInfo');
  const removeBtn = document.getElementById('removeImage');
  const MAX_SIZE = 2 * 1024 * 1024; // 2 MB, adjust as needed

  function resetPreview(){
    input.value = '';
    previewImg.src = '';
    previewImg.style.display = 'none';
    previewInfo.textContent = '';
    removeBtn.style.display = 'none';
  }

  input.addEventListener('change', () => {
    const file = input.files && input.files[0];
    if (!file) return resetPreview();

    if (!file.type.startsWith('image/')) {
      alert('Please select an image file.');
      return resetPreview();
    }
    if (file.size > MAX_SIZE) {
      alert('Image too large. Max 2 MB.');
      return resetPreview();
    }

    const reader = new FileReader();
    reader.onload = e => {
      previewImg.src = e.target.result;
      previewImg.style.display = 'block';
      previewInfo.textContent = `${file.name} — ${(file.size/1024).toFixed(0)} KB`;
      removeBtn.style.display = 'inline-block';
    };
    reader.readAsDataURL(file);
  });

  removeBtn.addEventListener('click', resetPreview);
});
</script>

</body>
</html>







