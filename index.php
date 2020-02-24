<?php
require_once 'vendor/autoload.php';
 
$ob=new App\classes\Category();
$category=$ob->allactiveCategory();
$post=$ob->allactivepost();

 ?>
<?php require_once 'header.php';?>


  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        
        <?php 
        if (isset($_GET['search'])) {
          $test=$_GET['search'];
          $search=$ob->searchPost($test);
          if (mysqli_num_rows($search)>0) {
            
          
          while ($data=mysqli_fetch_assoc($search)) {?>
              <div class="card mb-4">
          <img class="card-img-top"   src="uploads/<?=$data['photo'] ?>" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"><?=$data['title'] ?></h2>
            <p class="card-text"><?php echo substr($data['content'],1,250);?>....</p>
            <a href="post.php?id=<?=$data['id']?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
           Posted on <?= date('d M Y',strtotime($data['createtime'])) ?>
            by <a href="#"><?=$data['name'] ?></a>
          </div>
        </div>
              <?php
          }
        }
        else
        {
          echo "<h1>Not Found </h1>";
        }
        }
        else{ ?>

         
        
        <!-- Blog Post -->
        
        <?php foreach ($post as $data) 
          
        { ?>
        <div class="card mb-4">
          <img class="card-img-top"   src="uploads/<?=$data['photo'] ?>" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"><?=$data['title'] ?></h2>
            <p class="card-text"><?php echo htmlspecialchars_decode($data['content']);?>....</p>
            <a href="post.php?id=<?=$data['id']?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
           Posted on <?= date('d M Y',strtotime($data['createtime'])) ?>
            by <a href="#"><?=$data['name'] ?></a>
          </div>
        </div>
<?php } ?>
 <?php } ?>
        <!-- Blog Post -->
        

        <!-- Pagination -->
      <!--   <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
          </li>
        </ul> -->

      </div>

      <!-- Sidebar Widgets Column -->
     <?php require_once 'widget.php' ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
<?php require_once 'footer.php' ?>