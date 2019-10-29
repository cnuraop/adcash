<div class="container">
    <h2><?php echo $title; ?></h2>
    
    <!-- Display status message -->
    <?php if(!empty($success_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    </div>
    <?php }elseif(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    </div>
    <?php } ?>
    
    <div class="row">
        <div class="col-md-6">
            <form method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="user" placeholder="Enter name" value="<?php echo !empty($member['user'])?$member['user']:''; ?>" >
                        <?php echo form_error('name','<div class="invalid-feedback">','</div>'); ?>
                    </div>
                    <!-- <div class="form-group">
                        <label>Product</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Enter last name" value="<?php echo !empty($member['last_name'])?$member['last_name']:''; ?>" >
                        <?php echo form_error('last_name','<div class="invalid-feedback">','</div>'); ?>
                </div> -->
                <label>Product</label> 
                <select class="form-control" name="product">
            <?php

            foreach($groups as $row)
            { 
              $selected = '' ;
              if($row->product_name == $member['product'])  { $selected = 'selected="selected"';}
              echo '<option value="'.$row->product_name.'" '.$selected.'>'.$row->product_name.'</option>';

            }
            ?>
            </select>


                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Enter Price" value="<?php echo !empty($member['price'])?$member['price']:''; ?>" >
                    <?php echo form_error('price','<div class="invalid-feedback">','</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control" name="quantity" placeholder="Enter Quantity" value="<?php echo !empty($member['quantity'])?$member['quantity']:''; ?>" >
                    <?php echo form_error('country','<div class="invalid-feedback">','</div>'); ?>
                </div>
                <a href="<?php echo site_url('members'); ?>" class="btn btn-secondary">Back</a>
                <input type="submit" name="memSubmit" class="btn btn-success" value="Submit">
            </form>
        </div>
    </div>
</div>