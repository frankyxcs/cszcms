<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i><span class="glyphicon glyphicon-edit"></span></i> <?php echo  $this->lang->line('article_header') ?>
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="h2 sub-header"><?php echo  $this->lang->line('article_header') ?> <a role="button" href="<?php echo BASE_URL?>/admin/plugin/article/new" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> <?php echo  $this->lang->line('article_new_header') ?></a>  <a role="button" href="<?php echo BASE_URL?>/admin/plugin/article/newcat" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> <?php echo  $this->lang->line('category_new_header') ?></a> <a class="btn btn-default btn-sm" href="<?php echo $this->csz_referrer->getIndex(); ?>"><span class="glyphicon glyphicon-arrow-left"></span> <?php echo $this->lang->line('btn_back'); ?></a></div>
        <form action="<?php echo BASE_URL . '/admin/users/'; ?>" method="get">
            <div class="control-group">
                <label class="control-label" for="search"><?php echo $this->lang->line('search'); ?>: <input type="text" name="search" id="search" class="form-control-static" value="<?php echo $this->input->get('search');?>"></label> &nbsp;&nbsp;&nbsp; 
                <label class="control-label" for="category"><?php echo $this->lang->line('category_header'); ?>:
                    <select name="category" id="category">
                        <option value=""><?php echo $this->lang->line('option_all'); ?></option>
                        <?php
                        if($category !== FALSE){
                            foreach ($category as $c) { ?>
                                <option value="<?php echo $c['catagory_id'] ?>"<?php echo ($this->input->get('category') == $c['catagory_id'])?' selected="selected"':''?>><?php echo $c['category_name'] ?></option>
                        <?php }
                        }
                        ?>
                    </select>	
                </label> &nbsp;&nbsp;&nbsp; 
                <input type="submit" name="submit" id="submit" class="btn btn-default" value="<?php echo $this->lang->line('search'); ?>">
            </div>
        </form>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="10%" class="text-center"><?php echo $this->lang->line('user_status'); ?></th>
                        <th width="20%" class="text-center"><?php echo $this->lang->line('user_name'); ?></th>
                        <th width="30%" class="text-center"><?php echo $this->lang->line('user_email'); ?></th>
                        <th width="15%" class="text-center"><?php echo $this->lang->line('user_new_type'); ?></th>
                        <?php if($this->session->userdata('admin_type') == 'admin'){ ?>
                        <th width="25%"></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($article === FALSE) { ?>
                        <tr>
                            <td colspan="5" class="text-center"><span class="h6 error"><?php echo  $this->lang->line('data_notfound') ?></span></td>
                        </tr>                           
                    <?php } else { ?>
                        <?php
                        foreach ($article as $u) {
                            if(!$u['active']){
                                $inactive = ' style="vertical-align: middle;color:red;text-decoration:line-through;"';
                                $status = '<span style="color:red;">Deactivated</span>';
                            }else{
                                $inactive = '';
                                $status = '<span style="color:green;">Activated</span>';
                            }
                            if($u['user_admin_id'] == 1){
                                $default_txt = ' <i class="glyphicon glyphicon-lock"></i>';
                            }else{
                                $default_txt = '';
                            }
                            if($u['user_type'] != 'member'){
                                $admin_color = ' style="color:blue;font-weight:bold;"';
                            }else{
                                $admin_color = '';
                            }
                            echo '<tr>';
                            echo '<td'.$inactive.' class="text-center">' . $status . '</td>';
                            echo '<td'.$inactive.'><span'.$admin_color.'>' . $u['name'] . ''.$default_txt.'</span></td>';
                            echo '<td'.$inactive.'><span'.$admin_color.'>' . $u['email'] . '</span></td>';
                            echo '<td'.$inactive.' class="text-center"><span'.$admin_color.'>' . ucfirst($u['user_type']) . '</span></td>';
                            if($this->session->userdata('admin_type') == 'admin'){
                                echo '<td class="text-center"><a href="'.BASE_URL.'/admin/users/view/' . $u['user_admin_id'] . '" class="btn btn-primary btn-sm" role="button"><i class="glyphicon glyphicon-eye-open"></i> '.$this->lang->line('btn_view').'</a> &nbsp;&nbsp; <a href="'.BASE_URL.'/admin/users/edit/' . $u['user_admin_id'] . '" class="btn btn-default btn-sm" role="button"><i class="glyphicon glyphicon-pencil"></i> '.$this->lang->line('user_edit_btn').'</a> &nbsp;&nbsp; <a role="button" class="btn btn-danger btn-sm" role="button" onclick="return confirm(\''.$this->lang->line('user_delete_message').'\')" href="'.BASE_URL.'/admin/users/delete/'.$u['user_admin_id'].'"><i class="glyphicon glyphicon-remove"></i> '.$this->lang->line('user_delete_btn').'</a></td>';
                            }
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->pagination->create_links(); ?> <b><?php echo $this->lang->line('total').' '.$total_row.' '.$this->lang->line('records');?></b>
        <!-- /widget-content --> 
        <br><br>
        <span class="warning"><i class="glyphicon glyphicon-lock"></i> <?php echo  $this->lang->line('default_data_remark') ?></span>
    </div>
</div>