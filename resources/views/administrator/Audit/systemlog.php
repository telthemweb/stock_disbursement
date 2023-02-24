<div class="container-fluid px-xl-5 mt-lg-2">
       
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>SYSTEM LOGS</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="max-width">Name</th>
                                            <th class="max-width">TimeIn</th>
                                            <th class="max-width">TimeOut</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php  if(count($logs)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($logs as $cat): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $cat->admin->name.' '.$cat->admin->surname; ?></td>
                                                <td><?php echo $cat->timein; ?></td> 
                                               <td><?php echo $cat->timeout; ?></td>
                                               <td><?php echo date('d-M-Y',strtotime($cat->created_at)); ?></td> 
                                               <td><?php echo $cat->status; ?></td>
                                            
                                               
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="6" class="text-danger text-center"><b>No logs found</b></td>
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
   