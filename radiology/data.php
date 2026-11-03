<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/function_radiology.php';

$uid = $_GET['uid'] ?? '';
include_once __DIR__ . '/head.php';
$username = $_SESSION['username'] ?? '';
$keyword = $_GET["keyword"] ?? '';

$safe_keyword = mysqli_real_escape_string($conn, $keyword);
$safe_username = mysqli_real_escape_string($conn, $username);

$query = "SELECT * FROM xray_template WHERE title LIKE '%$safe_keyword%' AND username = '$safe_username'";
$result = mysqli_query($conn, $query);
echo "<table border='1' id='mytemplate' class='type-choice mytemplate'>";
if ($result && mysqli_num_rows($result) > 0) { ?>
	<?php while ($row = mysqli_fetch_assoc($result)) : ?>
		<thead> 
		<td class="td1">
			<?php echo htmlspecialchars($uid); ?>
		<a class="href_template" href="worklist.php?uid=<?= urlencode($uid); ?>&amp;template_id=<?= urlencode($row['template_id'] ?? ''); ?>" onclick="return confirm('Apakah yakin ingin ditiban?');"><?= htmlspecialchars($row['title'] ?? ''); ?></a>
	<?php endwhile; ?>
	</td>
	</thead>
	</table>
<?php } ?>