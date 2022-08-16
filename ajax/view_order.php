<?php 
/*
* Code by DTT ( https://www.facebook.com/207DTT.MMO1 )
* Create date : 28/9/2020
*/
$t = s($_GET['t']);
$code = s($_GET['code']);
if (empty($code)) {
	exit();
}

$lists = $db->rawQuery("SELECT service.id AS service_id, order_service.*, data_service.*, service.name, service.type FROM order_service INNER JOIN data_service ON (data_service.id = order_service.ref_id) INNER JOIN service ON (service.id = data_service.type_id) WHERE order_service.code = '$code' AND order_service.uid = '{$me->uid}'");

$total_buy = count($lists);

$auth = $lists[0];

if (empty($auth)) {
	exit();
}

$custom_lists = array();

if ($t == 'download_backup') {
    if ($auth['type'] == 'via') {
        $data_backup = '';
        $uid = s($_GET['uid']);
        if (!empty($uid) && is_numeric($uid) && in_array($uid, array_column($lists, 'user_id'))) {
            $glob = glob('files/service/backup_folder/*.html');
            foreach ($glob as $xs) {
                if (strpos($xs, $uid, 0) !== false) {
                    $data_backup = @file_get_contents($xs);
                }
            }
        }
        $files = "files/service/backup-$uid.html";
        $fp = fopen($files, 'w');
        fwrite($fp, $data_backup);
        fclose($fp);
        custom_download($files);
        @unlink($files);
        exit();
    }
}

if ($t == 'download') {
	if ($auth['type'] == 'bm') {
		foreach ($lists as $x) {
			$custom_lists[] = ($x['bm_id'] . '|' . $x['bm_link']);
		}
		$files = "files/service/bm.txt";
		$fp = fopen($files, 'w');
		fwrite($fp, implode("\n", $custom_lists));
		fclose($fp);
		$zip_files = "files/service/{$total_buy}-bm-loai-{$auth['service_id']}-{$code}.zip";
		$zip = new ZipArchive();
		$zip->open($zip_files, ZipArchive::CREATE);
		$zip->addFile($files, basename($files));
		$zip->close();
		@unlink($files);
		custom_download($zip_files);
		@unlink($zip_files);
		exit();
	}
	if ($auth['type'] == 'clone' || $auth['type'] == 'via') {
		foreach ($lists as $x) {
			$custom_lists[] = ($x['user_id'] . '|' . $x['password'] . '|' . $x['email'] . '|' . $x['password_email'] . '|' . $x['2fa']);
		}
		$files = "files/service/{$auth['type']}.txt";
		$fp = fopen($files, 'w');
		fwrite($fp, implode("\n", $custom_lists));
		fclose($fp);
		$zip_files = "files/service/{$total_buy}-{$auth['type']}-loai-{$auth['service_id']}-{$code}.zip";
		$zip = new ZipArchive();
		$zip->open($zip_files, ZipArchive::CREATE);
		$zip->addFile($files, basename($files));
		$zip->close();
		@unlink($files);
		custom_download($zip_files);
		@unlink($zip_files);
		exit();
	}
}
?>


<?php if ($t == 'view') { ?>

<?php if ($auth['type'] == 'clone' || $auth['type'] == 'via') { ?>
<table class="table table-hover table-bordered table-vcenter">
    <thead>
        <tr>
            <th class="d-sm-table-cell text-center" style="width: 5%;">#</th>
            <th class="d-sm-table-cell text-center">Backup file</th>
            <th class="d-sm-table-cell text-center">UID</th>
            <th class="d-sm-table-cell text-center">Info <?= mb_strtoupper($auth['type']); ?></th>
        </tr>
    </thead>
    <tbody class="bm-list-data">
    	<?php foreach ($lists as $k => $x) { ?>
        <tr>
            <td><?= ($k + 1); ?></td>
            <td><a href="/api/view_order?t=download_backup&code=<?= $code; ?>&uid=<?= $x['user_id']; ?>">Tải xuống</a>
            </td>
            <td><?= $x['user_id']; ?></td>
            <td><?= ($x['user_id'] . '|' . $x['password'] . '|' . $x['email'] . '|' . $x['password_email'] . '|' . $x['2fa']); ?></td>
        </tr>
    	<?php } ?>
    </tbody>
</table>
<?php } ?>

<?php if ($auth['type'] == 'bm') { ?>
<table class="table table-hover table-bordered table-vcenter">
    <thead>
        <tr>
            <th class="d-sm-table-cell text-center" style="width: 5%;">#</th>
            <th class="d-sm-table-cell text-center">BMID</th>
            <th class="d-sm-table-cell text-center">Link</th>
            <th class="d-sm-table-cell text-center">Info BM</th>
        </tr>
    </thead>
    <tbody class="bm-list-data">
    	<?php foreach ($lists as $k => $x) { ?>
        <tr>
            <td><?= ($k + 1); ?></td>
            <td><?= $x['bm_id']; ?></td>
            <td><?= $x['bm_link']; ?></td>
            <td><?= ($x['bm_id'] . '|' . $x['bm_link']); ?></td>
        </tr>
    	<?php } ?>
    </tbody>
</table>
<?php } ?>

<?php } ?>