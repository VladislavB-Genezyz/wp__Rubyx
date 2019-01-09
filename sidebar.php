<div id="col" class="noprint">
  <div id="col-in">
    <h3><span><a href="http://web-mastery.info/">About Me</a></span></h3>
    <div id="about-me">
      <p><img src="<?php echo get_template_directory_uri()?>/img/tmp_photo.gif" id="me" alt="Yeah, it´s me!" /> <strong>Jane Doe</strong><br />
        Age: 26<br />
        Dallas, TX<br />
        <a href="#">Profile on MySpace</a></p>
      </div>
      <hr class="noscreen" />
      
      <?php 
        if(is_active_sidebar( 'sidebar-1' )){
          dynamic_sidebar('sidebar-1');
        }
      ?>
<!--       <h3 ><span>Category</span></h3>
      <ul id="category">
        <li id="category-active"><a href="http://web-mastery.info/">Selected category</a></li>
        <li><a href="#">Category</a></li>
        <li><a href="#">Category</a></li>
        <li><a href="#">Category</a></li>
        <li><a href="#">Category</a></li>
      </ul>
      <hr class="noscreen" /> -->
      <h3><span>Archive</span></h3>
      <ul id="archive">
        <li><a href="#">January 2007</a></li>
        <li><a href="#">December 2006</a></li>
        <li><a href="#">November 2006</a></li>
        <li><a href="#">October 2006</a></li>
        <li><a href="#">September 2006</a></li>
        <li id="archive-active"><a href="http://web-mastery.info/">August 2006</a></li>
        <li><a href="#">July 2006</a></li>
        <li><a href="#">June 2006</a></li>
        <li><a href="#">May 2006</a></li>
        <li><a href="#">April 2006</a></li>
        <li><a href="#">March 2006</a></li>
        <li><a href="#">February 2006</a></li>
        <li><a href="#">January 2006</a></li>
      </ul>
      <hr class="noscreen" />
      <h3><span>Links</span></h3>
      <ul id="links">
        <li><a href="#">Something</a></li>
        <li><a href="#">Something</a></li>
        <li><a href="#">Something</a></li>
        <li><a href="#">Something</a></li>
        <li><a href="#">Something</a></li>
      </ul>
      <hr class="noscreen" />
    </div>
  </div>