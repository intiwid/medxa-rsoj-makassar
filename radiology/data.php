<?php 
require 'function_radiology.php';

session_start();
@$uid = $_GET['uid'];
include('head.php');
$username = $_SESSION['username'];
@$keyword = $_GET["keyword"];


$query = "SELECT * FROM xray_template WHERE  title LIKE '%$keyword%' AND username = '$username'";
$result = mysqli_query($conn,$query);
echo "<table border='1' id='mytemplate' class='type-choice mytemplate'>";
if(mysqli_num_rows($result) > 0){ ?>

	<?php while($row = mysqli_fetch_assoc($result)) :?>
		<thead> 
		<td class="td1">
			<?php echo $uid; ?>
		<a class="href_template" href="worklist.php?uid=<?= $uid; ?>&amp;template_id=<?= $row['template_id']; ?>" onclick="return confirm('Apakah yakin ingin ditiban?');"><?= $row['title']; ?></a>
		</a>
	<?php endwhile; ?>
	</td>
	</thead>
	</table>
<?php } ?>