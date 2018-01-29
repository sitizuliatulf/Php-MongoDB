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
        <form action="<?php echo base_url().$this->url.'/delete' ?>" method="post">
        <div class="box-body">
          <div class="col-md-12 no-padding" style="margin: 10px 0px;">
            <a href="<?php echo base_url().$this->url.'/add_new' ?>" class="btn btn-default">
              <i class="fa fa-plus"></i> <?php echo $this->lang->line('new_data') ?>
            </a>
            <button class="btn btn-danger">
              <i class="fa fa-trash-o"></i> <?php echo $this->lang->line('has_been_choose') ?>
            </button>
          </div>
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th><input type="checkbox" id="check-all"></th>
                  <th><?php echo $this->lang->line('no.') ?></th>
                  <?php
                    // munculkan nama kolomnya
                    if (isset($this->fields) && 
                    is_array($this->fields) && 
                    count($this->fields) > 0) {
                      foreach ($this->fields as $f_k => $f_v) {
                  ?>
                    <th><?php echo $this->lang->line($f_v->name) ?></th>
                  <?php
                      }
                    }
                  ?>
                  <th class="text-center">#</th>
                </tr>
                  <?php
                    //munculkan data di tabel
                    if (isset($data) &&
                    is_array($data) &&
                    count($data) > 0) {
                      foreach ($data as $d_k => $d_v) {
                  ?>
                    <tr>
                    <td>
                      <input type="checkbox" name="delete_all[]" value="<?php echo $d_v['_id'] ?>" />
                    </td>
                    <td><?php echo $d_k + 1 ?></td>
                        <?php
                          if (isset($this->fields) && 
                          is_array($this->fields) && 
                          count($this->fields) > 0) {
                            foreach ($this->fields as $f_k => $f_v) {
                        ?>
                            <td><?php echo $d_v[$f_v->name] ?></td>
                        <?php
                            }  
                          }
                        ?>
                        <td class="text-center">
                        <?php
                          //munculkan button action di tabel header
                          if (isset($this->custom_action) &&
                          is_array($this->custom_action) &&
                          count($this->custom_action) > 0) {
                            foreach ($this->custom_action as $k => $v) {
                        ?>     
                            <a href="<?php echo base_url($this->url).'/'.$v->function_name.'/'.$d_v['_id']->{'$id'} ?>" class="btn btn-sm btn-<?php echo $v->button_style ?>">
                              <i class="<?php echo $v->icon_name ?>"></i>
                              <?php echo ucfirst($v->name) ?>
                            </a>
                        <?php  
                            }
                          }
                          ?>
                        </td>
                      </tr>
                  <?php
                      }
                    } 
                  ?>
                </tr>
              </tbody>
            </table>
        </div>
        </form>
        <div class="box-footer clearfix">
          <div class="col-md-6 text-left">
            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
              <?php
              $offset = empty($this->uri->segment(3)) ? 0 : $this->uri->segment(3);
              echo 'Tampilkan data dari '.$offset.' sampai '.($this->limit + $offset);
              ?>
            </div>
          </div>
          <div class="col-md-6 text-right">
            <?php echo $this->pagination->create_links() ?>
          </div>
        </div>
      </div>
    </div>
  </div>      
</section>