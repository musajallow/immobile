<div class="col-md-5" style="">
<h2>Change Content on Index Page</h2>
<form method="post" name="newContentIndex" action="<?php echo URLrewrite::BaseURL()?>" enctype="multipart/form-data">
  <div class="form-row">

  <div class="form-group col-md-5">
      <label for="inputHeader">Header: </label>
      <input type="text" name="header_Title" class="form-control" id="inputHeader" placeholder="Subject">
    </div>

 
    <div class="form-group col-md-10">
    <label for="textArea">Body: </label>
    <textarea class="form-control rounded-0" name="header_Content" id="textArea" rows="3" placeholder="Write here :)"></textarea>
    </div>

<div class="form-group col-md-10">
<label for="textArea">Chosen Feature Product: </label>
<select name="chosen_Item">
    <!-- Display products to feature on idnex page/home view -->
      <?php
      foreach ($data as $post) {
          echo '<option name="'.$post["sku"].'" value="'.$post['sku'].'">'.$post['title'].' : '.$post['sku'].'</option>';
      }
      ?>
</select>
</div>


<button type="submit" class="btn btn-primary col-md-10" name="submit">Submit</button>

</form>
</div>
</div>


<!-- The second Div -->
<div class="col-md-6" style="float:right;">
<h2>Change Address on Contact Page</h2>
<form method="post" name="newContentContact" action="<?php echo URLrewrite::BaseURL().'/contactus'?>" enctype="multipart/form-data">
  <div class="form-row">
  <div class="form-group col-md-12">
      <label for="open[weekdays]">Weekday Opening Hours: </label>
      <select name="open[weekdays]">
      <option value="08:00-20:00">08:00-20:00</option>
      <option value="08:00-21:00">08:00-21:00</option>   
      <option value="08:00-22:00">08:00-22:00</option>  
      </select>

      <br>

      <label for="open[weekend]">Weekend Opening Hours: </label>
      <select name="open[weekend]">
      <option value="10:00-15:00">10:00-15:00</option>
      <option value="10:00-16:00">10:00-16:00</option>   
      <option value="10:00-17:00">10:00-17:00</option>  
      </select>
</div>

 
    <div class="form-group col-md-12">
    <label for="textArea">Comment: </label>
    <textarea class="form-control rounded-0" name="contact_list" id="textArea" rows="3" placeholder="Do you have new information you would like to share with your clients? :)"></textarea>
    </div>

<div class="form-group col-md-10">
<label for="upload">Upload a lovely picture of Us</label>
<input type="file" name="file" id="upload">
</div>


<button type="submit" class="btn btn-primary col-md-10" name="submitFor2">Submit</button>

</form>
</div>
</div>







