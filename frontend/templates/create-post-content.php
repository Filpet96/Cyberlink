<?php
require $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
try {
    $stmt = $pdo->prepare('SELECT postID, userid, postTitle, postCont, postDate, postUrl, postImage FROM posts WHERE postID = :postID');
    $stmt->execute(array(':postID' => $_POST['id']));
    $row = $stmt->fetch();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

        <?php
        if (isset($_POST['edit_post'])) {
            ?>
            <h1>Edit post</h1>
          <form class="editpost_container" action="backend/posts/edit-post.php" method="POST">
      		    <div class="form-group has-error">
      		        <label for="title">Title <span class="require">*</span> <small></small></label>
      		        <input type="text" class="form-control" name="title" value="<?php echo $row['postTitle']?>" required/>
      		    </div>
      		    <div class="form-group">
      		        <label for="url">Url <span class="require">*</span></label>
      		        <input type="url" class="form-control" name="url" value="<?php echo $row['postUrl']?>" required />
      		    </div>
      		    <div class="form-group">
      		        <label for="description">Description</label>
      		        <textarea rows="2" class="form-control" name="content"><?php echo $row['postCont']?></textarea>
      		    </div>
      		    <div class="form-group">
      		        <p><span class="require">*</span> - required fields</p>
      		    </div>
      		    <div class="form-group">
      		        <button type="submit" class="btn btn-primary">
      		            Edit Post
      		        </button>
                  <input type="hidden" name="postID" value="<?php echo $row['postID']?>">
      		    </div>
      		</form>
          <?php
        } else {
            ?>
            <h1 class="create_post_text">Create post</h1>
          <form class="createpost_container" action="backend/posts/create-post.php" method="POST">
      		    <div class="form-group has-error">
      		        <label for="title">Title <span class="require">*</span> <small></small></label>
      		        <input type="text" class="form-control" name="title"  required/>
      		    </div>
      		    <div class="form-group">
      		        <label for="url">Url <span class="require">*</span></label>
      		        <input type="url" class="form-control" name="url" required />
      		    </div>
      		    <div class="form-group">
      		        <label for="description">Description</label>
      		        <textarea rows="2" class="form-control" name="content" ></textarea>
      		    </div>
      		    <div class="form-group">
      		        <p><span class="require">*</span> - required fields</p>
      		    </div>
      		    <div class="form-group">
      		        <button type="submit" class="btn btn-primary">
      		            Create
      		        </button>
      		    </div>
      		</form>
          <?php
        }
         ?>
