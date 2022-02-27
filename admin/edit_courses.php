<!-- session check -->
<?php 
  session_start();
  if (empty($_SESSION['user'])) {
    header('location:./');
  }
?>
<?php include "include/header.php"?>
<body>
<?php include "include/nav.php";
if (isset($_GET['edit'])) {
    $id=$_GET['edit'];
}
else{
    $id=$_POST['edit'];
}
require_once('include/db.php');
$query=$db->prepare('SELECT * from courses where id=?');
$query->execute(array(
    $id
));
$data=$query->fetch();
if ($_SERVER['REQUEST_METHOD']=='POST') {
  include 'include/functions.php';
  $c_heading=$_POST['c_heading'];
  $c_crfee=$_POST['c_rfee'];
  $c_cfee=$_POST['c_fee'];
  $seo_desc=$_POST['seo_desc'];
  $c_desc=$_POST['c_desc'];
  $c_duration=$_POST['c_duration'];
  $c_addedby=$_SESSION['username'];
  $date=date("Y-m-d H:i:s");
  if (empty($c_heading) or empty($c_crfee) or empty($c_cfee) or empty($c_duration)  ) {
    alert2('All fields are required','danger');
    $error[]=1;
  }
  else {
      require_once('include/db.php');
      $query=$db->prepare('UPDATE courses SET c_heading=?, c_rfee=?, c_fee=?, c_desc=?, c_duration=?, c_addedby=?,seo_desc=?, date=? WHERE id=?');
      $query->execute(array(
        $c_heading,
        $c_crfee,
        $c_cfee,
        $c_desc,
        $c_duration,
        $c_addedby,
        $seo_desc,
        $date,
        $id
      ));
      alert2('Course Updated Sucessfully','success');
      header( "refresh:1;url=courses.php" );
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
    <form action="edit_courses.php" method="POST" enctype="multipart/form-data">
        <input type="text" name='edit' value='<?php echo $data['id']; ?>' hidden>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_heading" value="<?php echo $data['c_heading'];?>" placeholder="Course Heading">
        <label for="floatingInput">Course Heading</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_rfee" value="<?php echo $data['c_rfee'];?>" placeholder="Course Registration Fee">
        <label for="floatingInput">Course Registration Fee <i class="fa-solid fa-indian-rupee-sign"></i></label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_fee" value="<?php echo $data['c_fee'];?>" placeholder="Course Fee">
        <label for="floatingInput">Course Fee <i class="fa-solid fa-indian-rupee-sign"></i></label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="seo_desc" value="<?php echo $data['seo_desc'];?>" placeholder="SEO Description">
        <label for="floatingInput">SEO Description</label>
      </div>
      <div class="form-floating mb-3">
        <textarea class="form-control" name="c_desc" id="mytextarea" placeholder="Course Description" style="height: 350px"><?php echo $data['c_desc'];?></textarea>
        <label for="floatingTextarea">Course Description</label>
      </div>
      <div class="form-floating mb-3">
        <select class="form-select" name="c_duration" id="floatingSelect" aria-label="Floating label select example">
            <?php if ($data['c_duration']==0) {?>
                <option selected>Select</option>
                <option value="1">One Month</option>
                <option value="2">Two Months</option>
                <option value="3">Three Months</option>
                <option value="4">Four Months</option>
                <option value="5">Five Months</option>
                <option value="6">Six Months</option>
            <?php } ?>
            <?php if ($data['c_duration']==1) {?>
                <option value="1" selected>One Month</option>
                <option value="2">Two Months</option>
                <option value="3">Three Months</option>
                <option value="4">Four Months</option>
                <option value="5">Five Months</option>
                <option value="6">Six Months</option>
            <?php } ?>
            <?php if ($data['c_duration']==2) {?>
                <option value="1">One Month</option>
                <option value="2" selected>Two Months</option>
                <option value="3">Three Months</option>
                <option value="4">Four Months</option>
                <option value="5">Five Months</option>
                <option value="6">Six Months</option>
            <?php }?>
            <?php if ($data['c_duration']==3) {?>
                <option value="1">One Month</option>
                <option value="2">Two Months</option>
                <option value="3" selected>Three Months</option>
                <option value="4">Four Months</option>
                <option value="5">Five Months</option>
                <option value="6">Six Months</option>
            <?php } ?>
            <?php if ($data['c_duration']==4) {?>
                <option value="1">One Month</option>
                <option value="2">Two Months</option>
                <option value="3">Three Months</option>
                <option value="4" selected>Four Months</option>
                <option value="5">Five Months</option>
                <option value="6">Six Months</option>
            <?php } ?>
            <?php if ($data['c_duration']==5) {?>
                <option value="1">One Month</option>
                <option value="2">Two Months</option>
                <option value="3">Three Months</option>
                <option value="4">Four Months</option>
                <option value="5" selected>Five Months</option>
                <option value="6">Six Months</option>
            <?php } ?>
            <?php if ($data['c_duration']==6) {?>
                <option value="1">One Month</option>
                <option value="2">Two Months</option>
                <option value="3">Three Months</option>
                <option value="4">Four Months</option>
                <option value="5">Five Months</option>
                <option value="6" selected>Six Months</option>
            <?php } ?>
          ?>
        </select>
        <label for="floatingSelect">Course Duration</label>
      </div>
      <button type="submit" class="btn"><i class="fa-solid fa-circle-plus"></i> Sumbit</button>
    </form>
  </div>
  <?php include 'include/footer.php';?>