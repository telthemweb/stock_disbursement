<div class="container-fluid px-xl-5 mt-lg-3">
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>Goods Read for disburse</span><small class="px-1"></small></h6>
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
                                            <th class="text-left">From Depot</th>
                                            <th class="text-left">Status</th>
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
                                                <td><?php echo $prod->product->unitmeasure; ?></td>
                                                <td><?php echo $prod->depot->name; ?></td>
                                                <td><?php echo $prod->status; ?></td>
                                                <td class="text-center">
                                                    <a class="text-success"  href="<?php route('/pos/'.$prod->id) ?>" >
                                                        <button class="btn btn-success float-right rounded-0">
                                                            Disburse <i class="fa fa-share"></i>
                                                        </button>
                                                    </a>
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