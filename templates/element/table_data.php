<?php if (isset($data) && !empty($data)) {
    foreach ($data as $date => $list) {
        foreach ($list as $k => $v) { ?>
            <tr>
                <td><?php echo date('Y-m-d h:i:s A', strtotime($date)); ?></td>
                <td>
                    <?php if($type == 'Allowed'){ echo "<i data-feather='check'></i> "; }
                    elseif($type == 'Blocked'){ echo "<i data-feather='x'></i>";}?>
                    <?php echo $type; ?></td>
                <td><?php echo $k; ?></td>
            </tr>
<?php }
    }
} ?>