<div class="container-fluid px-xl-5 mt-lg-2">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($product->name); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            
                <form action="<?php route('/product/u/'.$product->id); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="barcode" value="<?php echo $product->barcode; ?>" id="barcode" readonly>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="name" value="<?php echo $product->name; ?>">
                            </div>
                        </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                            <div class="rounded">
                                  <select class="form-control" name="category_id" id="category_id">
                                    <option value="" disabled selected><?php echo $product->category->name; ?></option>
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
                                    <option value="" disabled selected><?php echo $product->supplier->name; ?></option>
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
                                <input type="text" class="form-control pl-3" name="desc" placeholder="Product Description"  id="desc" value="<?php echo $product->desc; ?>">
                            </div>
                            </div>
                           </div>
                       </div>

                         <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Quantity</label>
                                <input type="number" class="form-control pl-3" name="quantity" placeholder="Product Quantity"  id="quantity" value="<?php echo $product->quantity; ?>">
                            </div>                     
                            </div>
                             </div>
                               <div class="col-md-6">
                                <div class="form-group">
                                <div class="rounded">
                                     <label for="">Expiry Date</label>
                                    <input type="date" class="form-control pl-3" name="bestbefore" placeholder="Expiry Date"  id="bestbefore" value="<?php echo $product->bestbefore; ?>">
                                </div>
                                </div>
                               </div>
                         </div>

                        <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Quantity Alert</label>
                                <input type="number" class="form-control pl-3" name="stock_alert_quantity" placeholder="Product Quantity Alert"  id="stock_alert_quantity" value="<?php echo $product->stock_alert_quantity; ?>">
                            </div>                     
                            </div>
                             </div>

                             <div class="col-md-6">
                             <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Code</label>
                                <input type="text" class="form-control pl-3" name="product_code" placeholder="Product Code"  id="product_code" value="<?php echo $product->product_code; ?>" readonly>
                            </div>                     
                            </div>
                             </div>
                               
                               
                         </div>

                         <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <div class="rounded">
                                <label for="">Measurement Unit</label>
                                <input type="text" class="form-control pl-3" name="unitmeasure" placeholder="Measurement Unit"  id="unitmeasure" value="<?php echo $product->unitmeasure; ?>">
                            </div>                     
                            </div>
                             </div>   
                               
                         </div>

                        
                        
                        
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-success login-btn btn-block rounded-0">Update</button>
                            </div>
                        </div>
                    </form>
                            </div>


                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    