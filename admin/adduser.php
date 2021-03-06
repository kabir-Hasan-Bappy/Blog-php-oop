<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
<?php 
 if (!Session::get('userRole') == '0') {
  echo "<script>window.location = 'index.php'</script>";
}
?>
<div class="grid_10">

  <div class="box round first grid">
    <h2>Add New User</h2>
    <div class="block copyblock">
     <?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $username = $fm->validation($_POST['username']);
      $password = $fm->validation(md5($_POST['password']));
      $role     = $fm->validation($_POST['role']);
      $email    = $fm->validation($_POST['email']);

      $username = mysqli_real_escape_string($db->link, $username);
      $password = mysqli_real_escape_string($db->link, $password);
      $role     = mysqli_real_escape_string($db->link, $role);
      $email    = mysqli_real_escape_string($db->link, $email);

      $permited  = array('jpg', 'jpeg', 'png', 'gif');
         $file_name = $_FILES['image']['name'];
         $file_size = $_FILES['image']['size'];
         $file_temp = $_FILES['image']['tmp_name'];

         $div = explode('.', $file_name);
         $file_ext = strtolower(end($div));
         $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
         $uploaded_image = "upload/user/".$unique_image;

         if (empty($username) || empty($password) || empty($email) || empty($role) || empty($uploaded_image)) {
            echo "<span class='failmsg'>Field must not be empty!</span>";
        }elseif ($file_size >1048567) {
           echo "<span class='error'>Image Size should be less then 1MB!
           </span>";
       } elseif (in_array($file_ext, $permited) === false) {
           echo "<span class='error'>You can upload only:-"
           .implode(', ', $permited)."</span>";
       } else{
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $mailcheck = $db->select($query);
        if ($mailcheck != false ) {
          echo "<span class='failmsg'>Email Already Exist !</span>";
        }else{
           move_uploaded_file($file_temp, $uploaded_image);
          $query = "INSERT INTO users (username, password, email, role, profile_image) VALUES ('$username', '$password', '$email', '$role', '$uploaded_image')";
          $insetuser = $db->insert($query);
          if ($insetuser) {
            echo "<span class='successmsg'>User created Successfully!</span>";
          }else{
            echo "<span class='failmsg'>User Not created!</span>";
          }
        }

      }
    }
    ?> 
    <form action="" method="post" enctype="multipart/form-data">
      <table class="form">					
        <tr>
          <td>
            <label for="username">Username</label>
          </td>
          <td>
            <input type="text" name="username" placeholder="Enter username Name..." class="medium" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="password">Password</label>
          </td>
          <td>
            <input type="password" name="password" placeholder="Enter password Name..." class="medium" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="email">Email</label>
          </td>
          <td>
            <input type="email" name="email" placeholder="Enter valid Email Address..." class="medium" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="username">User Role</label>
          </td>
          <td>
            <select name="role" id="select">
              <option>Select User Role</option>
              <option value="0">Admin</option>
              <option value="1">Author</option>
              <option value="2">Editor</option>
            </select>
          </td>
        </tr>
        <tr>
                <td>
                    <label>Upload Image</label>
                </td>
                <td>
                    <input type="file" name="image" />
                </td>
            </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" name="submit" Value="Create" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
<?php include 'inc/a_footer.php'; ?>   