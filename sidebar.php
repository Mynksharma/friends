<div class="content-left"  id="sidebar" style="position:fixed;background-color:#C0C0C7;border-radius:5px;"><ul><li><a class="sidea" href="profile.php?id=<?php echo $_SESSION['id'];?>">
    <img src="static_images\default.png" style="border-radius:50%;height:20px;width:auto;" />
    <b> 
    <?php echo $namf." ".$naml;?></b></a></li><li><a href="main.php">
        <img src="static_images\newsfeed.jfif" style="border-radius:50%;height:20px;width:auto;" />
        <b> News Feed</b></a></li><!--<li><a href="messanger.php">
            <img src="uploads\messenger.png" style="border-radius:50%;height:20px;width:auto;" />
            <b> Messanger</b></a></li><li><a href="pages.php">
    <img src="uploads\page.png" style="border-radius:50%;height:20px;width:auto;" />
    <b> Pages</b></a></li>--><li><a href="friendlist.php?id=<?php echo $us; ?>" class="sidea">
        <img src="static_images\friendlist.jfif" style="border-radius:50%;height:20px;width:auto;" />
        <b> My Friends' list</b></a></li><li><a href="add_friends.php" class="sidea">
            <img src="static_images\addfriends.svg" style="border-radius:50%;height:20px;width:auto;" />
        <b> Add Friends</b></a></li><li><a href="logout.php"><img src="static_images\logout.png" style="border-radius:50%;height:20px;width:auto;"/><b> Logout</b></a></li></ul></div>
        <script>
            if(!navigator.onLine){
              for(let i=0;i<3;i++){
                  document.getElementsByClassName('sidea')[i].setAttribute('href','offline.html');
              }
            }
            </script>
        