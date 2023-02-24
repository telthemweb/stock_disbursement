<div class="container-fluid px-xl-5 mt-lg-5">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                          <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($goodreceived->depot->name); ?></span><small class="px-1 float-lg-right"><?php  echo "<b>GRV Number #".$goodreceived->docnumber."</b>"; ?></small></h6>
                            </div>

                            <div class="py-1">
                           <form action="<?php route('/dispatchprocess/u/'.$goodreceived->id); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">

                   
                        
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                            <div class="rounded">
                                    <select class="form-control selectpicker" name="product_id"  data-live-search="true" data-live-search-style="begins" title="Select Product...">
                                         <option value="" disabled selected><?php echo $goodreceived->product->name; ?></option>
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
                                    <select class="form-control selectpicker" name="depot_id"  data-live-search="true" data-live-search-style="begins" title="Select depot...">
                                        <option value="" disabled selected><?php echo $goodreceived->depot->name; ?></option>
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
                                <input type="number" class="form-control pl-3" name="quantity" value="<?php echo $goodreceived->quantity; ?>"  id="quantity">
                            </div>                     
                            </div>
                             </div>
                               <div class="col-md-6">
                                <div class="form-group">
                                <div class="rounded">
                                <label for="">Product Quantity Alert</label>
                                <input type="number" class="form-control pl-3" name="stock_alert_quantity" value="<?php echo $goodreceived->stock_alert_quantity; ?>" readonly>
                            </div>                     
                            </div>
                               </div>
                         </div>

                        
                        
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-success login-btn btn-block rounded-0">Update Transfer</button>
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

    