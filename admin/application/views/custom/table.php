<?php 

?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th><?php echo $this->lang->line('no.') ?></th>
                <?php 
                  if (isset($column)) {
                    foreach ($column as $column_key => $column_value) {
                ?>
                  <th><?php echo $this->lang->line($column_value) ?></th>
                <?php
                    }
                  }
                ?>
                <th>#</th>
              </tr>
              <tr>
                <?php
                  if (isset($data['data']) &&
                  count($data['data']) > 0) {
                    foreach ($data['data'] as $data_key => $data_value) {
                ?>
                  <td><?php echo $data_key + 1 ?></td>
                      <?php
                        if (isset($column)) {
                          foreach ($column as $column_key => $column_value) {
                      ?>
                          <td><?php echo $data_value[$column_value] ?></td>
                      <?php
                          }  
                        }
                        print_r($data);
                        if (isset($data['custom_action']) && 
                        count($data['custom_action']) > 0) {
                          foreach ($data['custom_action'] as $k => $v) {
                      ?>     
                            <td>
                              <a href="<?php echo base_url($v->link.'/'.$column_value->id) ?>" class="btn btn-<?php echo $v->button_style ?>">
                                <?php echo ucfirst($v->name) ?>
                              </a>
                            </td>
                      <?php  
                          }
                        }
                      ?>
                <?php
                    }
                  } 
                ?>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="#">«</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">»</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>      
</section>