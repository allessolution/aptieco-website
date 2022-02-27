<!-- session check -->
<?php 
  session_start();
  if (empty($_SESSION['user'])) {
    header('location:./');
  }
?>
<?php include "include/header.php"?>
<body>
<?php include "include/nav.php"?>
<!-- php code -->
<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
  include 'include/functions.php';
  $target_dir = "../assets/image/courses/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $c_heading=$_POST['c_heading'];
  $c_crfee=$_POST['c_rfee'];
  $c_cfee=$_POST['c_fee'];
  $c_desc=$_POST['c_desc'];
  $seo_desc=$_POST['seo_desc'];
  $c_duration=$_POST['c_duration'];
  $c_addedby=$_SESSION['username'];
  $date=date("Y-m-d H:i:s");
  $image=$_FILES["fileToUpload"]["name"];
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (empty($c_heading) or empty($c_crfee) or empty($c_cfee) or empty($c_duration) or empty($image)  ) {
    alert2('All fields are required','danger');
    $error[]=1;
  }
  // Check if file already exists
  else if (file_exists($target_file)) {
    alert2("Sorry, file of this name already exists .",'danger');
    $uploadOk = 0;
    $error[]=1;
  }

  // Check file size
  else if ($_FILES["fileToUpload"]["size"] > 2000000) {
   alert2("File size should be less than 2mb.",'danger');
    $uploadOk = 0;
    $error[]=1;
  }

  // Allow certain file formats
  else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && $imageFileType != "webp" ) {
    alert2("Sorry, only JPG, JPEG, PNG, WEBP & GIF files are allowed.",'danger');
    $uploadOk = 0;
    $error[]=1;
  }
  // Check if $uploadOk is set to 0 by an error
  else if ($uploadOk == 0) {
    alert2("Sorry, your file was not uploaded.",'danger');
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      require_once('include/db.php');
      $query=$db->prepare('INSERT INTO courses (c_heading, c_rfee, c_fee, c_desc, c_duration, c_addedby, date, image, seo_desc) VALUES (?,?,?,?,?,?,?,?,?);');
      $query->execute(array(
        $c_heading,
        $c_crfee,
        $c_cfee,
        $c_desc,
        $c_duration,
        $c_addedby,
        $date,
        $image,
        $seo_desc
      ));
      alert2('Course Added Sucessfully','success');
      header( "refresh:1;url=courses.php" );
    } else {
      alert2("Sorry, there was an error in uploading data",'danger');
      $error[]=1;
    }
  }
}
?>
  <!-- tiny mce script embedded -->
    <script>
        var useDarkMode = window.matchMedia('(prefers-color-scheme: light)').matches;
        tinymce.init({
            selector: '#mytextarea',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [
                { title: 'My page 1', value: 'https://www.tiny.cloud' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_list: [
                { title: 'My page 1', value: 'https://www.tiny.cloud' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_class_list: [
                { title: 'None', value: '' },
                { title: 'Some class', value: 'class-name' }
            ],
            importcss_append: true,
            file_picker_callback: function (callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            templates: [
                    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });

    </script>
    <!-- tiny mce ended -->

  <div class="add-course">
    <h2 class="text-center">Add Course</h2>
    <form action="add_course.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="formFile" class="form-label">Featured Image</label>
        <input class="form-control" name="fileToUpload" type="file">
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_heading" value="<?php if(isset($error)){ echo $_POST['c_heading'];}?>" placeholder="Course Heading">
        <label for="floatingInput">Course Heading</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_rfee" value="<?php if(isset($error)){ echo $_POST['c_rfee'];}?>" placeholder="Course Registration Fee">
        <label for="floatingInput">Course Registration Fee <i class="fa-solid fa-indian-rupee-sign"></i></label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_fee" value="<?php if(isset($error)){ echo $_POST['c_fee'];}?>" placeholder="Course Fee">
        <label for="floatingInput">Course Fee <i class="fa-solid fa-indian-rupee-sign"></i></label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="seo_desc" value="<?php if(isset($error)){ echo $_POST['seo_desc'];}?>" placeholder="SEO Description">
        <label for="floatingInput">SEO Description</label>
      </div>
      <div class="form-floating mb-3">
        <textarea class="form-control" name="c_desc" id="mytextarea" placeholder="Course Description" style="height: 350px"><?php if(isset($error)){ echo $_POST['c_desc'];}?></textarea>
        <label for="floatingTextarea">Course Description</label>
      </div>
      <div class="form-floating mb-3">
        <select class="form-select" name="c_duration" id="floatingSelect" aria-label="Floating label select example">
          <option selected>Select</option>
          <option value="1">One Month</option>
          <option value="2">Two Months</option>
          <option value="3">Three Months</option>
          <option value="4">Four Months</option>
          <option value="5">Five Months</option>
          <option value="6">Six Months</option>
        </select>
        <label for="floatingSelect">Course Duration</label>
      </div>
      <button type="submit" class="btn"><i class="fa-solid fa-circle-plus"></i> Submit</button>
    </form>
  </div>
  <?php include 'include/footer.php';?>