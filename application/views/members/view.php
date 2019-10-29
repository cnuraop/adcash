<div class="container">
    <h2><?php echo $title; ?></h2>
    <div class="col-md-6">
        <div class="card" style="width:400px">
            <div class="card-body">
                <h4 class="card-title"><?php echo $member['user']; ?></h4>
                <p class="card-text"><b>Product:</b> <?php echo $member['product']; ?></p>
                <p class="card-text"><b>Price:</b> <?php echo $member['price']; ?></p>
                <p class="card-text"><b>Quantity:</b> <?php echo $member['quantity']; ?></p>
                <p class="card-text"><b>Created:</b> <?php echo $member['created']; ?></p>
                <a href="<?php echo site_url('members'); ?>" class="btn btn-primary">Back To List</a>
            </div>
        </div>
    </div>
</div>