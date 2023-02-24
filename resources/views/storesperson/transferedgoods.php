<div class="container-fluid px-xl-5 mt-lg-3">
     <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Transfer <i class="fa fa-share"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span >You about to transfer <strong class="text-danger"><?php echo $goodreceiveds->product->name ?></strong></span><small class="px-1 float-lg-right text-success"><h3><?php echo "Available Quantity ". $goodreceiveds->quantity ?></h3></small></h6>
                            </div>

                            
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-left">#</th>
                                            <th class="text-left">Name</th>
                                            <th class="text-left">Quantity</th>
                                            <th class="text-left">Unit of Measure</th>
                                            <th class="text-left">From</th>
                                            <th class="text-left">To</th>
                                            <th class="text-left">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($transferedgoods as $prod): $i++; ?>
                                            <tr>

                                             
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $prod->product->name; ?></td>
                                                <td><?php echo $prod->quantity; ?></td>
                                                <td><?php echo $prod->product->unitmeasure; ?></td>
                                                <td><?php echo $prod->depot->name; ?></td>
                                                <td><?php echo $prod->CommonDisbusement->name; ?></td>
                                                <td><?php echo $prod->status; ?></td>
                                               
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Transfer <?php echo $goodreceiveds->product->name ?></h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                 <form action="<?php route('/store/transfer-cidpstore'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">

                   
                        
                     <div class="form-group">
                            <div class="rounded">
                                    <select class="form-control selectpicker" name="cidp_id" required data-live-search="true" data-live-search-style="begins" title="Select depot...">
                                        <option value="" disabled selected>Select CIDP</option>
                                        <?php foreach ($cidps as $depot): ?>
                                            <option value="<?php echo $depot->id ?>"><?php echo $depot->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                              
                            </div>
                        </div>

                        <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Quantity</label>
                                <input type="number" class="form-control pl-3" name="quantity" placeholder="Product Quantity"  id="quantity">
                                <input type="hidden" class="form-control pl-3" name="product_id" value="<?php echo $goodreceiveds->product_id ?>">
                                <input type="hidden" class="form-control pl-3" name="depot_id" value="<?php echo $goodreceiveds->depot_id ?>">
                                <input type="hidden" class="form-control pl-3" name="grv_id" value="<?php echo $goodreceiveds->id ?>">
                            </div>                     
                            </div>

                      

                         <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Quantity Alert</label>
                                <input type="number" class="form-control pl-3" name="stock_alert_quantity" placeholder="Product Quantity Alert"  id="stock_alert_quantity">
                            </div>                     
                            </div>

                        
                        
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-success login-btn btn-block rounded-0">Transfer</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>