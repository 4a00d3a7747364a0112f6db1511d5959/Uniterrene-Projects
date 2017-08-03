<header class="journal-header-center">
    <div class="header">
    <div class="journal-top-header j-min z-1"></div>
    <div class="journal-menu-bg z-0"> </div>
    <div class="journal-center-bg j-100 z-0"> </div>

    <div id="header" class="journal-header z-2">

        <div class="header-assets top-bar">
            <div class="journal-links j-min xs-100 sm-100 md-50 lg-50 xl-50">
                <div class="links">
                    <ul class="top-menu">
                    <?php echo $this->journal2->settings->get('config_primary_menu'); ?>
                    </ul>
                </div>
            </div>

            <?php if ($language): ?>
            <div class="journal-language j-min">
                <?php echo $language; ?>
            </div>
            <?php endif; ?>

            <?php if ($currency): ?>
            <div class="journal-currency j-min">
                <?php echo $currency; ?>
            </div>
            <?php endif; ?>

            <div class="journal-secondary j-min xs-100 sm-100 md-50 lg-50 xl-50">
                <div class="links">
                    <ul class="top-menu">
                    <?php echo $this->journal2->settings->get('config_secondary_menu'); ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="header-assets">
            <div class="journal-search j-min xs-100 sm-50 md-25 lg-25 xl-25">
				
				
                <?php if (Front::$IS_OC2): ?>
                    <?php //echo $search; ?>
                    
                    <div class="custom-input-serach"><input name="search" value="" placeholder="Search our entire store..." autocomplete="off" class="form-control input-lg custom-input" autocomplete2="on" type="text"></div>
                    
                    <select name="category_id" class="form-control" id="custom-sec">
						<option selected="selected" disabled>All category</option>
				<?php
				$categories = $this->model_catalog_category->getCategories(0);
    foreach ($categories as $category) {
        if ($category['top']) {?>
             <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
            <?php
            // Level 2
            $children_data = array();
            $children = $this->model_catalog_category->getCategories($category['category_id']);
            foreach ($children as $child) {?>
            <option value="<?php echo $child['category_id']; ?>">&nbsp;&nbsp;&nbsp;<?php echo $child['name']; ?></option> 
            <?php $children_second = $this->model_catalog_category->getCategories($child['category_id']); ?>
           <?php foreach ($children_second as $child_second) {?>
                          <option value="<?php echo $child_second['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<?php echo $child_second['name']; ?></option> 
					  <?php } ?>
            <?php
            }
            
           
        }
    }
				?>
				</select>
				<div class="button-search j-min"><i></i></div>
                    
                <?php else: ?>
                    <div id="search" class="j-min">
                        <div class="button-search j-min"><i></i></div>
                        <?php if (isset($filter_name)): /* v1541 compatibility */ ?>
                            <?php if ($filter_name) { ?>
                                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" autocomplete="off" />
                            <?php } else { ?>
                                <input type="text" name="filter_name" value="<?php echo $text_search; ?>" autocomplete="off" onclick="this.value = '';" onkeydown="this.style.color = '#000000';" />
                            <?php } ?>
                        <?php else: ?>
                            <input type="text" name="search" placeholder="<?php echo $this->journal2->settings->get('search_placeholder_text'); ?>" value="<?php echo $search; ?>" autocomplete="off" />
                        <?php endif; /* end v1541 compatibility */ ?>
                        
                        
                        
                        
                        
                        
                    </div>
                <?php endif; ?>
            </div>

            <div class="journal-logo j-100 xs-100 sm-100 md-50 lg-50 xl-50">
                <?php if ($logo) { ?>
                    <div id="logo">
                        <a href="<?php echo str_replace('index.php?route=common/home', '', $home); ?>">
                            <?php echo Journal2Utils::getLogo($this->config); ?>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="journal-cart j-min xs-100 sm-50 md-25 lg-25 xl-25">
                <?php echo $cart; ?>
            </div>
        </div>

        <div class="journal-menu j-min xs-100 sm-100 md-100 lg-100 xl-100">
            <?php echo $this->journal2->settings->get('config_mega_menu'); ?>
        </div>
    </div>
    </div>
</header>
<script type="text/javascript">
jQuery('.button-search').bind('click', function() {
	var serach_val = jQuery('.custom-input').val();
	var cat_id = jQuery("#custom-sec option:selected").val();
	var url ="?route=product/search&search="+serach_val+"&category_id="+cat_id;
	//alert(url);
	location = url;
	});

</script>
