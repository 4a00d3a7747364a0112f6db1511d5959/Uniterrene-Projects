<?php echo $header; ?><?php echo $column_left; ?>
<?php  
   $webshopstatuses = '';   
    if (isset($statuses)) {
       $webshopstatuses = $statuses;
   }   
?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
       
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
          <input type="hidden" name="token" id="token" value="<?php echo $_GET['token'] ?>">
          <input type="hidden" name="httpreferer" value="<?php echo $_SERVER['HTTP_HOST'] ?>">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="order_sent_status" id="input-status" class="form-control">
                <?php if ($order_sent_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
              
            </div>
          </div>
          
          <div class="form-group">
             <label class="col-sm-2 control-label" for="input-status"><?php echo $text_invoicesystem; ?></label>
             <div class="col-sm-10">
                <select name="cloudinvoiceinvoicesystem" id="cloudinvoiceinvoicesystem" class="form-control">
                    <option value=""  <?php if ($cloudinvoiceinvoicesystem == '') { echo 'selected="selected"'; }?>>Kies een factuursysteem</option>
                    <option value="factuursturen"  <?php if ($cloudinvoiceinvoicesystem == 'factuursturen') { echo 'selected="selected"'; }?>>Factuursturen</option>
                    <option value="exactonline"  <?php if ($cloudinvoiceinvoicesystem == 'exactonline') { echo 'selected="selected"'; }?>>Exact Online</option>
                    <option value="reeleezee"  <?php if ($cloudinvoiceinvoicesystem == 'reeleezee') { echo 'selected="selected"'; }?>>Reeleezee</option>
                    <option value="moneybird"  <?php if ($cloudinvoiceinvoicesystem == 'moneybird') { echo 'selected="selected"'; }?>>MoneyBird</option>
                    <option value="twinfieldtransacties"  <?php if ($cloudinvoiceinvoicesystem == 'twinfieldtransacties') { echo 'selected="selected"'; }?>>Twinfield transacties</option>
                    <option value="twinfieldfacturen"  <?php if ($cloudinvoiceinvoicesystem == 'twinfieldfacturen') { echo 'selected="selected"'; }?>>Twinfield facturen</option>
                    <option value="yuki"  <?php if ($cloudinvoiceinvoicesystem == 'yuki') { echo 'selected="selected"'; }?>>Yuki</option>
                    <option value="eboekhouden"  <?php if ($cloudinvoiceinvoicesystem == 'eboekhouden') { echo 'selected="selected"'; }?>>e-Boekhouden.nl</option>
                    <option value="imuis"  <?php if ($cloudinvoiceinvoicesystem == 'imuis') { echo 'selected="selected"'; }?>>Muis</option>
                    <option value="octopus"  <?php if ($cloudinvoiceinvoicesystem == 'octopus') { echo 'selected="selected"'; }?>>Octopus</option>
                    <option value="cash"  <?php if ($cloudinvoiceinvoicesystem == 'cash') { echo 'selected="selected"'; }?>>Cash</option>
                    <option value="asperion"  <?php if ($cloudinvoiceinvoicesystem == 'asperion') { echo 'selected="selected"'; }?>>Asperion</option>
                </select>
             </div>
          </div>         

          <div class='form-group'> 
               <label class='col-sm-2 control-label'><?php echo $entry_key; ?></label> 
                <div class='col-sm-10'>
                    <input type="text" name="cloudinvoice_api_key" class="form-control" value="<?php echo $cloudinvoice_api_key; ?>" />
               </div>
          </div>
        
          <div class="form-group">
             <label class="col-sm-2 control-label" for="input-status"><?php echo $text_cloudinvoiceapikey; ?></label>
             <div class="col-sm-10">
                <input name="cloudinvoiceapikey" id="cloudinvoiceapikey" value="<?php echo $cloudinvoiceapikey ?>" class="form-control opencart_reeleezee opencart_moneybird opencart_factuursturen opencart_twinfield" />
             </div>
          </div>         
        
          <div id="cirows">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $text_cloudinvoiceurl; ?></label>
                <div class="col-sm-10">
                  <input name="cloudinvoiceurl" id="cloudinvoiceurl" value="<?php echo $cloudinvoiceurl?>" class="form-control opencart_reeleezee opencart_moneybird opencart_factuursturen opencart_twinfield" />
                </div>
              </div>
          
           </div> 
        </form>
      </div>            
    </div>
  </div>
</div>
<?php echo $footer; ?>
