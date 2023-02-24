<div class="container-fluid px-xl-5 mt-lg-5">
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Stock Transfer <i class="fa fa-share"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>Stock Transfer</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-left">#</th>
                                            <th class="text-left">Name</th>
                                            <th class="text-left">Quantity</th>
                                            <th class="text-left">To Depot</th>
                                            <th class="text-left">Unit of Measure</th>
                                            <th class="text-left">Status</th>
                                            <?php if($_SESSION['role_id']==5):?>
                                            <th class="text-left">Distributed By</th>
                                            <?php endif; ?>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($goodreceiveds as $prod): $i++; ?>
                                            <tr>

                                             
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $prod->product->name; ?></td>
                                                <td><?php echo $prod->quantity; ?></td>
                                                <td><?php echo $prod->depot->name; ?></td>
                                                <td><?php echo $prod->product->unitmeasure; ?></td>
                                                <td><?php echo $prod->status; ?></td>
                                                <?php if($_SESSION['role_id']==5):?>
                                                <td><?php echo $prod->administrator->name." ".$prod->administrator->surname; ?></td>
                                                <?php endif; ?>
                                                <td class="text-center">
                                                    <a class="text-success"  href="<?php route('/dispatchprocess/e/'.$prod->id) ?>" >
                                                        <i class="fa fa-edit mr-3 text-green"></i>
                                                    </a>
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a class="text-danger"  href="<?php route('/dispatchprocess/delete/'.$prod->id) ?>" >
                                                        <i class="fa fa-trash mr-3 text-red"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                </td>
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
                <h5 class="modal-title text-white">Stock Transfer</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                 <form action="<?php route('/dispatchprocess/transfer'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">

                   
                        
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                            <div class="rounded">
                                    <select class="form-control selectpicker" name="product_id" required data-live-search="true" data-live-search-style="begins" title="Select Product...">
                                         <option value="" disabled selected>Select Product</option>
                                        <?php foreach ($products as $prod): ?>
                                            <?php if($prod->stockonhand<$prod->stock_alert_quantity): ?>
                                            <option value="<?php echo $prod->id ?>" class="text-danger">
                                            <?php echo $prod->name ." | Quantity " . $prod->stockonhand." | ".$prod->unitmeasure;?>
                                            </option>
                                        <?php else: ?> 
                                             <option value="<?php echo $prod->id ?>">
                                            <?php echo $prod->name ." | Quantity ".  $prod->stockonhand." | ".$prod->unitmeasure; ?>
                                            </option>
                                            <?php endif; ?> 
                                        <?php endforeach ?>
                                    </select>
                              
                            </div>
                        </div>
                        </div>
                       <div class="col-md-6">
                             <div class="form-group">
                            <div class="rounded">
                                    <select class="form-control selectpicker" name="depot_id" required data-live-search="true" data-live-search-style="begins" title="Select depot...">
                                        <option value="" disabled selected>Select depot</option>
                                        <?php foreach ($depots as $depot): ?>
                                            <option value="<?php echo $depot->id ?>"><?php echo $depot->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                              
                            </div>
                        </div>
                        </div>
                    </div>
                        

                      

                         <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Quantity</label>
                                <input type="number" class="form-control pl-3" name="quantity" placeholder="Product Quantity"  id="quantity">
                            </div>                     
                            </div>
                             </div>
                               <div class="col-md-6">
                                <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Quantity Alert</label>
                                <input type="number" class="form-control pl-3" name="stock_alert_quantity" placeholder="Product Quantity Alert"  id="stock_alert_quantity">
                            </div>                     
                            </div>
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
