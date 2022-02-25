<!-- session check -->
<?php 
  session_start();
  if (empty($_SESSION['user']) || $_SESSION['user']=='editor') {
    header('location:./');
  }
include 'include/header.php';
?>
<?php 
require_once 'include/db.php';
$query=$db->query('SELECT * from admin');
?>
<script>
    function edit(sno) {
        window.location.href="edit_admin.php?edit="+sno
    }
    function del(sno) {
        if (confirm('Do you Really Want to delete?')) {
            window.location.href="view_editors.php?del="+sno
        }
    }
</script>
<?php 
    if (isset($_GET['del'])) {
        $query=$db->prepare('DELETE from admin where id=?');
        $query->execute(array(
            $_GET['del']
        ));
        header('location:view_editors.php');
    }
?>
<body>
    <?php include 'include/nav.php';?>
    <center>
            <h2>All Editors</h2>
            <a href="add_editor.php"><button class="btn"><i class="fa-solid fa-circle-plus"></i> Add New Editor</button></a>
        </center>
    <div class="table-responsive custom-table">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">S.no</th>
                <th scope="col">Username</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno=0;
                while ($data=$query->fetch()) { ?>
                    <tr>
                    <?php if ($data['id']!=1) { ?>
                        <th scope="row"><?php echo $sno; ?></th>
                        <td><?php echo $data['username'] ?></td>
                        <td><?php echo $data['type'] ?></td>        
                        <td>
                            <a style="font-size:1.6rem; color:red; cursor:pointer;" onclick=del(<?php echo $data['id'] ?>)><i class="fa-solid fa-trash"></i></a>
                        </td>
                    <?php }?>
                    </tr>
                <?php $sno=$sno+1; }?>
            </tbody>
        </table>
    </div>
    <?php include 'include/footer.php';?>