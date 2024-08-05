

<?php
include('connect.php');

function getIPAddress() {  
    //whether ip is from the share internet  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
  //whether ip is from the remote address  
    else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
  }  
  


function getcategories(){
  global $con;
    $select_categories="Select * from `category`";
    $result_categories=mysqli_query($con,$select_categories);

    while($row_data=mysqli_fetch_assoc($result_categories)){
      $category_title=$row_data['category_title'];
      $category_id=$row_data['category_id'];
      echo "<a href='index.php?category=$category_id'>$category_title</a>";
    }
}


function getContent(){
  global $con;
    $select_video="Select * from `insert_video`";
    $result_video=mysqli_query($con,$select_video);

    while($row_data=mysqli_fetch_assoc($result_video)){
      $Title=$row_data['Title'];
      $Heading=$row_data['Heading'];
      $Thumbnail=$row_data['Thumbnail'];
      $video_id=$row_data['video_id']; // Ensure you have the video_id here
      $Date=$row_data['Date'];
      $keywords=$row_data['keywords'];
      $category_id=$row_data['category_id'];

      echo "<div class='container' id='display_video' onclick=\"location.href='video.php?video_id=$video_id'\">
        <div class='thumbnail'>
          <img src='images/$Thumbnail'/>
        </div>
        <div class='video-info'>
          <div>
            <img src='images/t1.jpg' class='t1' />
          </div>
          <div class='content'>
            <p class='head'>$Heading</p>
            <p class='channel'>$Title</p>
            <p class='views'>3.4 Million views &#183; $Date</p>
          </div>
        </div>
      </div>";
    }
}




function getContent_side(){
    global $con;
      $select_video="Select * from `insert_video`";
      $result_video=mysqli_query($con,$select_video);
  
      while($row_data=mysqli_fetch_assoc($result_video)){
        $Title=$row_data['Title'];
        $Heading=$row_data['Heading'];
        $Thumbnail=$row_data['Thumbnail'];
        $video_id=$row_data['video_id']; // Ensure you have the video_id here
        $Date=$row_data['Date'];
        $keywords=$row_data['keywords'];
        $category_id=$row_data['category_id'];
  
        echo "<div class='side_b' id='display_video' onclick=\"location.href='video.php?video_id=$video_id'\">
                <div class='sub_i'>
                    <img src='images/$Thumbnail' style='width:160px;'>
                </div>
                <div>
                    <p style='font-size:15px;margin-top:3px;margin-bottom:6px;'>$Heading</p>
                    <p style='font-size:12px; color:grey;margin-bottom:5px'>$Title</p>
                    <p style='font-size:12px; color:grey;'>3.4 Million views  &#183 4 days ago </p>
                </div>
            </div>";
      }
  }
?>

<?php
function search_video(){
    global $con;
    if(isset($_GET['search_content'])){
        $search_data_value = $_GET['searched'];

        $search_query = "SELECT * FROM `insert_video` WHERE keywords LIKE '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);

        $num_of_rows = mysqli_num_rows($result_query);
        if($num_of_rows == 0){
            echo "<h2 style='color:white'>No videos found in this category!</h2>";
        }
        while($row = mysqli_fetch_assoc($result_query)){
            $Title = $row['Title'];
            $Heading = $row['Heading'];
            $Thumbnail = $row['Thumbnail'];
            $video = $row['video'];
            $Date = $row['Date'];
            $keywords = $row['keywords'];
            $category_id = $row['category_id'];

            echo "<div class='container'>
                <div class='thumbnail'>
                    <img src='images/$Thumbnail'/>
                </div>
                <div class='video-info'>
                    <div>
                        <img src='images/t1.jpg' class='t1' />
                    </div>
                    <div class='content'>
                        <p class='head'>$Heading</p>
                        <p class='channel'>$Title</p>
                        <p class='views'>3.4 Million views &#183; $Date</p>
                    </div>
                </div>
            </div>";
        }
    }
}
?>


<?php

function get_unique_categories(){
  global $con;

  if(isset($_GET['category'])){
      $category_id=$_GET['category'];

  $select_query="Select * from `insert_video` where category_id=$category_id ";
  $result_query=mysqli_query($con,$select_query);

  $num_of_rows=mysqli_num_rows($result_query);
  if($num_of_rows==0){
      echo "<h2 style='color:white'>No videos for this category</h2>";
  }

  while($row = mysqli_fetch_assoc($result_query)){
    $Title = $row['Title'];
    $Heading = $row['Heading'];
    $Thumbnail = $row['Thumbnail'];
    $video_id=$row['video_id']; // Ensure you have the video_id here
    $Date = $row['Date'];
    $keywords = $row['keywords'];
    $category_id = $row['category_id'];

    echo "<div class='container' onclick=\"location.href='video.php?video_id=$video_id'\">
        <div class='thumbnail'>
            <img src='images/$Thumbnail'/>
        </div>
        <div class='video-info'>
            <div>
                <img src='images/t1.jpg' class='t1' />
            </div>
            <div class='content'>
                <p class='head'>$Heading</p>
                <p class='channel'>$Title</p>
                <p class='views'>3.4 Million views &#183; $Date</p>
            </div>
        </div>
    </div>";
  }
}
}


?>

<?php

function display()
{
    global $con;
    if (isset($_GET['video_id'])) {
        $videoId = $_GET['video_id'];

        $select_query = "Select * from `insert_video` where video_id=$videoId";
        $result_query = mysqli_query($con, $select_query);

        while ($row = mysqli_fetch_assoc($result_query)) {
            $Title = $row['Title'];
            $Heading = $row['Heading'];
            $Thumbnail = $row['Thumbnail'];
            $video = $row['video'];
            $category_id = $row['category_id'];

            echo "
            <div class='video_container'>
                <video controls>
                    <source src='images/$video' type='video/mp4'>
                    Your browser does not support the video tag.
                </video>
                <div>
                    <p style='color:white'>$Heading</p>
                    <div class='vid_container'>
                        <div>
                            <img src='images/t1.jpg' class='t11'>
                        </div>
                        <div class='c_content'>
                            <p class='c_name'>$Title</p>
                            <p class='subs'>123K Subscribers</p>
                        </div>

                        <div>
                            <button>Subscribe</button>
                        </div>

                        <div class='sub'>
                            <button style='background-color:grey;border-radius:50px;color:white;padding-bottom:4px;padding-top:4px;' class='text'><img src='images/like.png' class='likes'> 345</button>
                        </div>

                        <div class='sub1'>
                            <button style='background-color:grey;border-radius:50px;color:white;padding-bottom:4px;padding-top:4px;'><img src='images/dislike.png' class='likes'> 567</button>
                        </div>

                        <div class='sub2'>
                            <button style='background-color:grey;border-radius:50px;color:white; padding-bottom:4px;padding-top:4px;'><img src='images/share.png' class='likes'>Share</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class='side'>
            ";
            
            // Call the getContent_side function
            getContent_side();

            echo "</div>";
        }
    }
}
?>


