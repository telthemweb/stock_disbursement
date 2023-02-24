<div class="container-fluid px-xl-5 mt-lg-5">
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Category <i class="fa fa-folder"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>CATEGORIES LIST</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="max-width">Name</th>
                                            <th class="max-width">Date Created</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php  if(count($categories)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($categories as $cat): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $cat->name; ?></td>
                                               
                                                <td><?php echo $cat->created_at ; ?></td>
                                                <td class="text-center">
                                                   <a href="<?php route('/category/e/'.$cat->id); ?>"><i class="fa fa-edit mr-3 text-green"></i></a>
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a href="<?php route('/cat/delete/'.$cat->id); ?>"><i class="fa fa-trash mr-3 text-danger"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="3" class="text-danger text-center"><b>No Category found</b></td>
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





     <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">CREATE CATEGORY</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/category/add'); ?>" method="POST">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3 rounded-0" name="name" placeholder="Category Name"
                                       required="required" id="name">
                            </div>
                        </div>
                       
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-success rounded-0 login-btn btn-block">Add</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>