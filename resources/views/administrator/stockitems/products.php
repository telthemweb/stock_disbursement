<div class="container-fluid px-xl-5 mt-lg-5">
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Product <i class="fa fa-shopping-bag"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>Stock Products</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-left">#</th>
                                            <th class="text-left">Image</th>
                                            <th class="text-left">Code</th>
                                            <th class="text-left">Barcode</th>
                                            <th class="text-left">Name</th>
                                            <th class="text-left">Quantity</th>
                                            <th class="text-left">On Hand</th>
                                            <th class="text-left">Expiry Date</th>
                                            <th class="text-left">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($products as $product): $i++; ?>
                                            <tr>

                                             
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><img src="<?php echo url($product->imageurl==null?'assets/img/logo.png':$product->imageurl); ?>" width="90" class="rounded-0"></td>
                                                <td><?php echo $product->product_code; ?></td>
                                                <td><?php echo $product->barcode; ?></td>
                                                <td><?php echo $product->name; ?></td>
                                                <td><?php echo $product->quantity; ?></td>
                                                <td><?php echo $product->stockonhand; ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($product->bestbefore)); ?></td>
                                                <td><?php echo $product->status; ?></td>
                                                
                                                <td class="text-center">
                                                    <a class="text-success"  href="<?php route('/product/e/'.$product->id) ?>" >
                                                        <i class="fa fa-edit mr-3 text-green"></i>
                                                    </a>
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a class="text-danger"  href="<?php route('/product/delete/'.$product->id) ?>" >
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
                <h5 class="modal-title text-white">CREATE PRODUCT</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/product/add'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="barcode" placeholder="Barcode" id="barcode">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="name" placeholder="Product Name"
                                       required="required" id="name">
                            </div>
                        </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                            <div class="rounded">
                                  <select class="form-control" name="category_id" id="category_id">
                                    <option value="" disabled selected>Select category</option>
                                     <?php foreach ($categories as $cat): ?>
                                            <option value="<?php echo $cat->id ?>"><?php echo $cat->name ?></option>
                                        <?php endforeach ?>
                                  </select>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="rounded">
                              <select class="form-control" name="supplier_id" id="supplier_id">
                                    <option value="" disabled selected>Select Supplier</option>
                                     <?php foreach ($suppliers as $sup): ?>
                                            <option value="<?php echo $sup->id ?>"><?php echo $sup->name ?></option>
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
                                 <label for="">Product Image</label>
                                <input type="file" class="form-control pl-3" name="imageurl" placeholder="Product Image" id="imageurl">
                            </div>
                        </div>
                           </div>
                           <div class="col-md-6">
                            <div class="form-group">
                            <div class="rounded">
                                 <label for="">Product Description</label>
                                <input type="text" class="form-control pl-3" name="desc" placeholder="Product Description"  id="desc">
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
                                     <label for="">Expiry Date</label>
                                    <input type="date" class="form-control pl-3" name="bestbefore" placeholder="Expiry Date"  id="bestbefore">
                                </div>
                                </div>
                               </div>
                         </div>

                        <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Quantity Alert</label>
                                <input type="number" class="form-control pl-3" name="stock_alert_quantity" placeholder="Product Quantity Alert"  id="stock_alert_quantity">
                            </div>                     
                            </div>
                             </div>

                             <div class="col-md-6">
                             <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Code</label>
                                <input type="text" class="form-control pl-3" name="product_code" placeholder="Product Code"  id="product_code">
                            </div>                     
                            </div>
                             </div>
                               
                               
                         </div>

                         <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <div class="rounded">
                                <label for="">Measurement Unit</label>
                                <input type="text" class="form-control pl-3" name="unitmeasure" placeholder="Measurement Unit"  id="unitmeasure">
                            </div>                     
                            </div>
                             </div>

                            
                               
                               
                         </div>

                        
                        
                        
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-success login-btn btn-block rounded-0">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
