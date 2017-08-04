<div class="tinynav">
    <select name="select" id="select" onchange="location = this.options[this.selectedIndex].value;">
      <option>BROWSE GEAR</option>
        <?PHP
        $cats = $this->db_model->get_rows('categories',array('p_id'=>0));
        if($cats)
        {
            foreach($cats as $cat)
            {
            ?>
                <option value="<?PHP echo $this->categories_model->generate_url($cat->id);?>"><?PHP echo $cat->cat_name;?></option>
            <?PHP
            }
        }
        ?>
    </select>
  </div>