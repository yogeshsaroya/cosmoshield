<?php $this->assign('title', 'Reports'); ?>
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Reports</h2>

                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12  ">
                <div class="form-group breadcrumb-right">
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->Paginator->sort('domain'); ?></th>
                                        <th><?php echo $this->Paginator->sort('reason'); ?></th>
                                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                                        <th><?php echo $this->Paginator->sort('status'); ?></th>
                                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $list) { ?>
                                            <tr>
                                                <td><?php echo $list->domain; ?></td>
                                                <td><?php echo $list->reason; ?></td>
                                                <td><?php echo $list->email; ?></td>
                                                <td><?= $this->Form->control('status', ['data-id' => $list->id, 'default' => $list->status, 'label' => false, 'options' => ['1' => 'In progress', '2' => 'Fraudulent', '3' => 'No fraud detected'], 'class' => 'form-control st']); ?></td>
                                                <td><?php echo $list->created->format('Y-m-d H:i:s'); ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                            <div class="card-header">
                                <?php echo $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}'); ?>
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    <ul class="pagination">
                                        <?php
                                        echo $this->Paginator->first(__('First', true), array('tag' => 'li', 'escape' => false), array('type' => "button", 'class' => "btn btn-default"));
                                        echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                        echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                                        echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                        echo $this->Paginator->last(__('Last', true), array('tag' => 'li', 'escape' => false), array('type' => "button", 'class' => "btn btn-default"));
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $('.st').change(function() {
        var st = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: '<?php echo SITEURL; ?>pages/update_status/',
            data: {
                status : st,id:id
            },
            success: function(data) {
                $("#cover").html(data);
            },
            error: function(comment) {
                $("#cover").html(comment);
            }
        });
    });
</script>