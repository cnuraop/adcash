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
        <div class="col-md-12 search-panel">
            <!-- Search form -->
            <form method="post">
                <div class="input-group mb-3">
                    <select name="searchcriteria" class="form-control">
                      <option value="all">All of them</option>
                      <option value="lastseven">Last 7 days</option>
                      <option value="today">Today</option>
                    </select>
                    <input type="text" name="searchKeyword" class="form-control" placeholder="Search by keyword..." value="<?php echo $searchKeyword; ?>">
                    <div class="input-group-append">
                        <input type="submit" name="submitSearch" class="btn btn-outline-secondary" value="Search">
                        <input type="submit" name="submitSearchReset" class="btn btn-outline-secondary" value="Reset">
                    </div>
                </div>
            </form>
            
            <!-- Add link -->
            <div class="float-right">
                <a href="<?php echo site_url('members/add/'); ?>" class="btn btn-success"><i class="plus"></i> New Order</a>
            </div>
        </div>
        
        <!-- Data list table --> 
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Action</th>                    
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($members)){ foreach($members as $row){ ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->user; ?></td>
                    <td><?php echo $row->product; ?></td>
                    <td><?php echo $row->price; ?></td>
                    <td><?php echo $row->quantity; ?></td>
                    <?php 
                     $total = $row->price*$row->quantity; 
                    if($row->product == 'Pepsi' && $row->quantity >= 3) {
                      $total = $total-$total * (20/100);
                    } ?>
                    <td><?php echo $total; ?></td>
                    <td><?php echo $row->modified; ?></td>
                    <td>
                        <a href="<?php echo site_url('members/view/'.$row->id); ?>" class="btn btn-primary">view</a>
                        <a href="<?php echo site_url('members/edit/'.$row->id); ?>" class="btn btn-warning">edit</a>
                        <a href="<?php echo site_url('members/delete/'.$row->id); ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">delete</a>
                    </td>
                </tr>
                <?php } }else{ ?>
                <tr><td colspan="7">No member(s) found...</td></tr>
                <?php } ?>
            </tbody>
        </table>
    
        <!-- Display pagination links -->
        <div class="pagination pull-right">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
<!-- members/view.php
This view is loaded by the view() function of members controller. The specific member details are displayed in the Bootstrap card view.

<div class="container">
    <h2><?php echo $title; ?></h2>
    <div class="col-md-6">
        <div class="card" style="width:400px">
            <div class="card-body">
                <h4 class="card-title"><?php echo $member['first_name'].' '.$member['last_name']; ?></h4>
                <p class="card-text"><b>Email:</b> <?php echo $member['email']; ?></p>
                <p class="card-text"><b>Gender:</b> <?php echo $member['gender']; ?></p>
                <p class="card-text"><b>Country:</b> <?php echo $member['country']; ?></p>
                <p class="card-text"><b>Created:</b> <?php echo $member['created']; ?></p>
                <a href="<?php echo site_url('members'); ?>" class="btn btn-primary">Back To List</a>
            </div>
        </div>
    </div>
</div> -->