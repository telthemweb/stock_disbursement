<div class="container-fluid px-xl-5 mt-lg-2">
       
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>AUDIT TRAIL</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="max-width">Name</th>
                                            <th class="max-width">New value</th>
                                            <th class="max-width">Old value</th>
                                            <th class="max-width">Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php  if(count($audits)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($audits as $cat): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $cat->admin->name.' '.$cat->admin->surname; ?></td>
                                               <td><?php echo $cat->newvalue ; ?></td>
                                               <td><?php 
                                               echo $cat->oldvalue
                                               ?></td>
                                               <td><?php echo date('d-M-Y',strtotime($cat->created_at)); ?></td> 
                                               <td><?php echo $cat->action ?></td> 
                                            
                                               
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="6" class="text-danger text-center"><b>No Category found</b></td>
                                        <?php endif; ?>
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
   