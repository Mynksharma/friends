<div class="content-left" style="position:fixed;"><ul><li><a href="profile.php?id=<?php echo $_SESSION['id']; ?>">
    <img src="uploads\default.png" style="border-radius:50%;height:20px;width:auto;" />
    <b> <?php echo $namf." ".$naml;?></b></a></li><li><a href="main.php">
        <img src="uploads\newsfeed.jfif" style="border-radius:50%;height:20px;width:auto;" />
        <b> News Feed</b></a></li><!--<li><a href="messanger.php">
            <img src="uploads\messenger.png" style="border-radius:50%;height:20px;width:auto;" />
            <b> Messanger</b></a></li><li><a href="pages.php">
    <img src="uploads\page.png" style="border-radius:50%;height:20px;width:auto;" />
    <b> Pages</b></a></li>--><li><a href="friendlist.php?id=<?php echo $us; ?>">
        <img src="uploads\friendlist.jfif" style="border-radius:50%;height:20px;width:auto;" />
        <b> My Friends' list</b></a></li><li><a href="add_friends.php">
            <img src="uploads\addfriends.svg" style="border-radius:50%;height:20px;width:auto;" />
        <b> Add Friends</b></a></li><li><a href="logout.php"><img src="uploads\logout.png" style="border-radius:50%;height:20px;width:auto;"/><b> Logout</b></a></li></ul></div>
        