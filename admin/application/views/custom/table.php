<section class="content">
  <div class="row">
      <div class="col-md-12">
        <div class="box box-solid collapsed-box">
            <div class="search-form box-header">
                <h3 class="box-title">
                <i class="fa fa-search"></i> <?php echo $this->lang->line('search') ?></h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-default btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="box-body" style="display: none;">
                  <form action="<?php echo base_url('search') ?>" method="post">
                      <div class="row">
                          <?php
                          // looping untuk pencarian bedasarkan kolom yang ingin di tampilkan
                          if (isset($column) && count($column) > 0) {  
                            foreach ($column as $column_key => $column_value) {
                          ?>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                <label class="control-label" for="title"><?php echo $this->lang->line($column_value['name']) ?></label>
                                  <div class="row">
                                      <div class="col-md-12">
                                      <?php 
                                      if ($column_value['type'] === 'string') {
                                        echo '<input name="'.$column_value['name'].'" id="'.$column_value['name'].'" type="text" class="form-control " value="" placeholder="'.$this->lang->line($column_value['name']).'">';
                                      } else if ($column_value['type'] === 'number') {
                                        echo '<input name="'.$column_value['name'].'" id="'.$column_value['name'].'" type="number" class="form-control " value="" placeholder="'.$this->lang->line($column_value['name']).'">';
                                      } else if ($column_value['type'] === 'date') {
                                        echo '<input name="'.$column_value['name'].'" id="'.$column_value['name'].'" type="text" class="form-control input-date " value="" placeholder="'.$this->lang->line($column_value['name']).'">';
                                      }
                                      ?>
                                      </div>
                                  </div>
                                </div>
                            </div>
                          <?php
                            }
                          }
                          ?>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <button class="btn btn-default" type="submit" name="search"><i class="fa fa-search"></i>  Search</button>
                              <button class="btn btn-default" type="submit" name="clear"><i class="fa fa-search-minus"></i> Clear</button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
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
                  <th><?php echo $this->lang->line($column_value['name']) ?></th>
                <?php
                    }
                  }
                ?>
                <th class="text-center">#</th>
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
                          <td><?php echo $data_value[$column_value['name']] ?></td>
                      <?php
                          }  
                        }
                      ?>
                      <td class="text-center">
                      <?php
                        if (isset($custom_action) && 
                        count($custom_action) > 0) {
                          foreach ($custom_action as $k => $v) {
                      ?>     
                              <a href="<?php echo base_url($v->link.'/'.$data_value['_id']->{'$id'}) ?>" class="btn btn-<?php echo $v->button_style ?>">
                                <i class="fa fa-<?php echo $v->icon_name ?>"></i>
                                <?php echo ucfirst($v->name) ?>
                              </a>
                      <?php  
                          }
                        }
                        ?>
                      </td>
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